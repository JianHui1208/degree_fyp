import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:inventory_management/screens/item/image_input.dart';
import '../../providers/api.dart';
import '../../routes/route.dart';
import '../../components/switch.dart';
import 'package:shared_preferences/shared_preferences.dart';

class AddItemCategory extends StatefulWidget {
  const AddItemCategory({Key? key}) : super(key: key);

  @override
  State<AddItemCategory> createState() => _AddItemCategoryState();
}

class _AddItemCategoryState extends State<AddItemCategory> {
  final _formKey = GlobalKey<FormState>();
  String name = '';
  String status = '1';
  int companyIDJson = 0;
  int selectedImageId = 0;

  @override
  void initState() {
    super.initState();
    getUserData();
  }

  Future<void> getUserData() async {
    final prefs = await SharedPreferences.getInstance();
    String userInfo = prefs.getString('user_data') ?? '';
    dynamic userObj = jsonDecode(userInfo);

    setState(() {
      companyIDJson = userObj['response']['user']['company_id'];
    });
  }

  void submitForm() async {
    if (_formKey.currentState!.validate()) {
      _formKey.currentState!.save();

      ItemCategoryType itemCategoryType = ItemCategoryType(
        name: name,
        status: status,
        companyID: companyIDJson,
        imageID: selectedImageId,
      );

      String response = await addItemCategory(itemCategoryType.toJson());
      dynamic responseObj = jsonDecode(response);

      if (responseObj['status'] == 1051) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            backgroundColor: Theme.of(context).secondaryHeaderColor,
            duration: const Duration(seconds: 2),
            content: Container(
              padding: const EdgeInsets.all(8),
              child: Text(
                'Item Category Create Successfully',
                style: Theme.of(context).textTheme.labelLarge,
              ),
            ),
          ),
        );
        Navigator.of(context).pushReplacementNamed(RouteList.itemCategory);
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            backgroundColor: Colors.red,
            duration: const Duration(seconds: 2),
            content: Container(
              padding: const EdgeInsets.all(8),
              child: const Text(
                'Item Category Name Already Exist',
                style: TextStyle(
                  color: Colors.white,
                  fontSize: 18.0,
                  fontWeight: FontWeight.bold,
                ),
              ),
            ),
          ),
        );
      }
    }
  }

  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        leading: IconButton(
          onPressed: () {
            Navigator.of(context).pushReplacementNamed(RouteList.itemCategory);
          },
          icon: const Icon(
            Icons.close,
            size: 30.0,
          ),
        ),
        title: const Text(
          'Add Item Category',
          style: TextStyle(
            fontSize: 20.0,
            letterSpacing: 2,
          ),
        ),
        centerTitle: true,
      ),
      body: Form(
        key: _formKey,
        child: Container(
          padding: const EdgeInsets.all(15),
          child: SingleChildScrollView(
            child: Column(
              children: [
                ImageInput(
                  onImageSelected: (imageId) => {
                    setState(() {
                      selectedImageId = imageId;
                    })
                  },
                ),
                const SizedBox(height: 35),
                Row(
                  children: [
                    const Expanded(
                      child: Text('Item Category Name'),
                    ),
                    const SizedBox(width: 10),
                    Expanded(
                      flex: 2,
                      child: TextFormField(
                        decoration: const InputDecoration.collapsed(
                          hintText: "Input item category name",
                          hintStyle: TextStyle(color: Colors.grey),
                        ),
                        onSaved: (value) {
                          name = value!;
                        },
                        strutStyle: const StrutStyle(height: 1.5),
                        validator: (value) {
                          if (value == null || value.isEmpty) {
                            return 'Please enter item category name';
                          }
                          return null;
                        },
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 15),
                Container(
                  height: 1,
                  color: Colors.grey[350],
                ),
                const SizedBox(height: 30),
                Row(
                  children: [
                    const Expanded(
                      child: Text('Status'),
                    ),
                    const SizedBox(width: 10),
                    Expanded(
                      flex: 2,
                      child: Container(
                        padding: const EdgeInsets.symmetric(
                            vertical: 5, horizontal: 25),
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(8),
                          color: Colors.white,
                        ),
                        child: Row(
                          children: const [
                            SwitchApp(comeInValue: false),
                          ],
                        ),
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 30),
                TextButton(
                  style: TextButton.styleFrom(
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(30.0),
                    ),
                    backgroundColor: Colors.blue[800],
                    padding: const EdgeInsets.symmetric(vertical: 10.0),
                  ),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: const <Widget>[
                      Padding(
                          padding: EdgeInsets.only(top: 20.0, bottom: 20.0),
                          child: Text(
                            'Submit',
                            style: TextStyle(
                              color: Colors.white,
                              fontSize: 20.0,
                              fontWeight: FontWeight.bold,
                            ),
                          )),
                    ],
                  ),
                  onPressed: () {
                    submitForm();
                  },
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}

class ItemCategoryType {
  final String name;
  final String status;
  final int companyID;
  final int imageID;

  const ItemCategoryType({
    required this.name,
    required this.status,
    required this.companyID,
    required this.imageID,
  });

  Map<String, dynamic> toJson() {
    return {
      'name': name,
      'status': status,
      'company_id': companyID,
      'image_id': imageID,
    };
  }
}
