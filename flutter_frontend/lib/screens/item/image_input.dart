import 'dart:io';
import 'dart:convert';
import 'package:flutter_dotenv/flutter_dotenv.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';

class ImageInput extends StatefulWidget {
  final Function(int imageId)? onImageSelected;

  const ImageInput({Key? key, this.onImageSelected}) : super(key: key);

  @override
  State<ImageInput> createState() => ImageInputState();
}

class ImageInputState extends State<ImageInput> {
  File? _selectedImage;

  void _takePicture(ImageSource source) async {
    final imagePicker = ImagePicker();
    final baseUrl = dotenv.env['BACKEND_URL'];
    final pickedImage =
        await imagePicker.pickImage(source: source, maxWidth: 600);

    if (pickedImage == null) {
      return;
    }

    // Create a multipart request for the API
    var request = http.MultipartRequest(
        'POST', Uri.parse('$baseUrl/api/system/image-store'));

    // Attach the image file to the request
    request.files
        .add(await http.MultipartFile.fromPath('document', pickedImage.path));

    // Add additional fields to the request body
    request.fields['title'] = 'Image';
    request.fields['type'] = '1';

    // Add Bearer token to the request headers
    final prefs = await SharedPreferences.getInstance();
    final userInfo = prefs.getString('user_data') ?? '';
    final userObj = jsonDecode(userInfo);

    String authToken = userObj['response']['token'];
    request.headers['Authorization'] = 'Bearer $authToken';
    request.headers['Content-Type'] = 'multipart/form-data';

    var response = await request.send();
    var responseBody = await response.stream.bytesToString();

    print('Response Body: $responseBody');
    if (response.statusCode == 200) {
      dynamic responseObj = jsonDecode(responseBody);
      int imageId = responseObj['response']['document_id'];
      widget.onImageSelected?.call(imageId);

      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          backgroundColor: Theme.of(context).secondaryHeaderColor,
          duration: const Duration(seconds: 2),
          content: Container(
            padding: const EdgeInsets.all(8),
            child: Text(
              'Image Uploaded Successfully',
              style: Theme.of(context).textTheme.labelLarge,
            ),
          ),
        ),
      );
      setState(() {
        _selectedImage = File(pickedImage.path);
      });
    } else {
      // Handle error cases
      print('Image upload failed with status code ${response.statusCode}');
    }
  }

  void _showImageSourceDialog() {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: const Text(
            'Select Image Source',
            style: TextStyle(
              fontSize: 20,
              fontWeight: FontWeight.bold,
            ),
          ),
          content: SingleChildScrollView(
            child: ListBody(
              children: <Widget>[
                Padding(
                  padding: const EdgeInsets.symmetric(vertical: 5.0),
                  child: GestureDetector(
                    child: const Text('Take a Picture'),
                    onTap: () {
                      Navigator.of(context).pop();
                      _takePicture(ImageSource.camera);
                    },
                  ),
                ),
                Padding(
                  padding: const EdgeInsets.symmetric(vertical: 8.0),
                  child: GestureDetector(
                    child: const Text('Select from Gallery'),
                    onTap: () {
                      Navigator.of(context).pop();
                      _takePicture(ImageSource.gallery);
                    },
                  ),
                ),
                const SizedBox(height: 10),
                Padding(
                  padding: const EdgeInsets.symmetric(vertical: 8.0),
                  child: GestureDetector(
                    child: const Text('Clear Selection'),
                    onTap: () {
                      Navigator.of(context).pop();
                      setState(() {
                        _selectedImage = null;
                      });
                    },
                  ),
                ),
              ],
            ),
          ),
        );
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    Widget content = TextButton.icon(
      onPressed: null,
      icon: const Icon(
        Icons.camera_alt,
        color: Colors.blue,
      ),
      label: const Text(
        'Take Picture or Select from Gallery',
        style: TextStyle(
          color: Colors.blue,
        ),
      ),
    );

    if (_selectedImage != null) {
      content = GestureDetector(
        onTap: _showImageSourceDialog,
        child: ClipRRect(
          borderRadius: BorderRadius.circular(10),
          child: Image.file(
            _selectedImage!,
            fit: BoxFit.cover,
            width: double.infinity,
            height: double.infinity,
          ),
        ),
      );
    }

    return GestureDetector(
      onTap: _showImageSourceDialog,
      child: Container(
        decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(10),
          border: Border.all(
            width: 1,
            color: Colors.blue,
          ),
        ),
        height: 250,
        alignment: Alignment.center,
        width: double.infinity,
        child: content,
      ),
    );
  }
}
