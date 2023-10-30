import 'package:flutter/material.dart';
import 'image_input.dart';
import '../../routes/route.dart';
import '../../components/ErrorBox.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'dart:convert';
import 'dart:math';
import 'package:flutter_barcode_scanner/flutter_barcode_scanner.dart';
import '../../providers/api.dart';
import 'package:flutter/services.dart';

class ItemCategoryType {
  final String id;
  final String name;

  ItemCategoryType({required this.id, required this.name});
}

class ItemInputType {
  final String itemName;
  final String barCode;
  final int quantity;
  final double cost;
  final double price;
  final int itemCategoryId;
  final bool status;
  final int imageID;
  final int companyID;

  ItemInputType({
    required this.itemName,
    required this.barCode,
    required this.quantity,
    required this.cost,
    required this.price,
    required this.itemCategoryId,
    required this.status,
    required this.imageID,
    required this.companyID,
  });

  Map<String, dynamic> toJson() {
    return {
      'name': itemName,
      'barcode': barCode,
      'quantity': quantity,
      'cost': cost,
      'price': price,
      'status': status,
      'item_category_id': itemCategoryId,
      'image_id': imageID,
      'company_id': companyID,
    };
  }
}

class AddItem extends StatefulWidget {
  const AddItem({Key? key}) : super(key: key);

  @override
  State<AddItem> createState() => AddItemState();
}

class AddItemState extends State<AddItem> {
  final _formKey = GlobalKey<FormState>();
  final List<ItemCategoryType> itemCategory = [];
  String? barcodeString = '';
  String? selectedOption;
  int companyIDJson = 0;
  bool isLoading = true;

  // ItemInputType
  String itemName = '';
  String barCode = '';
  int quantity = 0;
  double cost = 0;
  double price = 0;
  int itemCategoryId = 0;
  int selectedImageId = 1;

  Future<void> getUserData() async {
    final prefs = await SharedPreferences.getInstance();
    String userInfo = prefs.getString('user_data') ?? '';

    dynamic userObj = jsonDecode(userInfo);

    setState(() {
      companyIDJson = userObj['response']['user']['company_id'];
    });
  }

  @override
  void initState() {
    super.initState();
    getUserData();
    getItemCategory();
  }

  void getItemCategory() async {
    String response = await getItemCategoryByCompanyId();
    dynamic responseObj = jsonDecode(response);

    for (var i = 0; i < responseObj['response']['itemCategories'].length; i++) {
      ItemCategoryType object = ItemCategoryType(
        id: responseObj['response']['itemCategories'][i]['id'].toString(),
        name: responseObj['response']['itemCategories'][i]['name'],
      );

      itemCategory.add(object);
    }
    setState(() {
      isLoading = false;
    });
  }

  // Generate random number for barcode
  String generateRandomNumber() {
    Random random = Random();
    String randomNumber = '';

    for (int i = 0; i < 13; i++) {
      randomNumber += random.nextInt(10).toString();
    }

    return randomNumber;
  }

  // Barcode scanner
  Future<void> scanBarcode() async {
    String barcodeScanRes = await FlutterBarcodeScanner.scanBarcode(
        '#ff6666', 'Cancel', true, ScanMode.BARCODE);

    if (barcodeScanRes != '-1') {
      setState(() {
        barcodeString = barcodeScanRes;
      });
    } else {
      AlertDialog(
        title: const Text('Scan Canceled'),
        content: SingleChildScrollView(
          child: ListBody(
            children: const <Widget>[
              Text('Barcode scanning was canceled.'),
            ],
          ),
        ),
      );
    }
  }

  void _submitForm() async {
    BuildContext dialogContext = context;

    if (_formKey.currentState!.validate()) {
      _formKey.currentState!.save();
      ItemInputType formData = ItemInputType(
        itemName: itemName,
        barCode: barCode,
        quantity: quantity,
        cost: cost,
        price: price,
        itemCategoryId: int.parse(selectedOption ?? '0'),
        status: false,
        imageID: selectedImageId,
        companyID: companyIDJson,
      );

      String response = await addItem(formData.toJson());
      dynamic responseObj = jsonDecode(response);

      if (responseObj['status'] == 422) {
        checkValidation('Item Bar Code already exists');
      } else if (responseObj['status'] == 1101) {
        // Create a dialog to let user choose want continue add item or not
        Future.delayed(Duration.zero, () {
          showDialog(
            context: context,
            builder: (BuildContext context) {
              return AlertDialog(
                title: const Text(
                  'Item Create Success',
                  style: TextStyle(
                    color: Colors.blue,
                    fontWeight: FontWeight.bold,
                    letterSpacing: 1.5,
                  ),
                ),
                content: SingleChildScrollView(
                  child: ListBody(
                    children: const <Widget>[
                      Text(
                          'Do you need to continue creating items or exit the screen?'),
                    ],
                  ),
                ),
                actions: <Widget>[
                  TextButton(
                    onPressed: () {
                      Navigator.of(context)
                          .pushReplacementNamed(RouteList.dashboard);
                    },
                    child: const Text('Exit'),
                  ),
                  TextButton(
                    onPressed: () {
                      Navigator.of(context).pop();
                      setState(() {
                        barcodeString = '';
                        selectedOption = null;
                        selectedImageId = 0;
                        _formKey.currentState!.reset();
                      });
                    },
                    child: const Text('Add More'),
                  ),
                ],
              );
            },
          );
        });
      } else {
        Future.delayed(Duration.zero, () {
          showDialog(
            context: dialogContext,
            builder: (BuildContext context) {
              return const ErrorBox(
                message: 'Item Create Failed',
                content:
                    'There was a problem with the System. Please try again later.',
              );
            },
          );
        });
      }
    }
  }

  void checkValidation(text) {
    Future.delayed(Duration.zero, () {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          backgroundColor: Colors.red,
          duration: const Duration(seconds: 2),
          content: Container(
            padding: const EdgeInsets.all(8),
            child: Text(
              text,
              style: const TextStyle(
                fontSize: 18,
                color: Colors.white,
              ),
            ),
          ),
        ),
      );
    });
  }

  @override
  Widget build(BuildContext context) {
    void showBarcodeInputDialog(BuildContext context) {
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: const Text('Enter Barcode'),
            content: TextFormField(
              onChanged: (value) {
                setState(() {
                  barcodeString = value;
                });
              },
              decoration: const InputDecoration(
                labelText: 'Barcode',
              ),
            ),
            actions: <Widget>[
              TextButton(
                onPressed: () {
                  Navigator.of(context).pop();
                },
                child: const Text('Cancel'),
              ),
              TextButton(
                onPressed: () {
                  Navigator.of(context).pop();
                },
                child: const Text('Save'),
              ),
            ],
          );
        },
      );
    }

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
          'Add Item',
          style: TextStyle(
            fontSize: 20.0,
            letterSpacing: 2,
          ),
        ),
        centerTitle: true,
      ),
      body: isLoading
          ? Container()
          : Form(
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
                            child: Text('Item Name'),
                          ),
                          const SizedBox(width: 10),
                          Expanded(
                            flex: 2,
                            child: TextFormField(
                              onSaved: (newValue) {
                                itemName = newValue!;
                              },
                              validator: (value) {
                                if (value == null || value.isEmpty) {
                                  checkValidation('Item Name is required');
                                }
                                return null;
                              },
                              decoration: const InputDecoration.collapsed(
                                hintText: "Input item name",
                                hintStyle: TextStyle(color: Colors.grey),
                              ),
                              strutStyle: const StrutStyle(height: 1.5),
                            ),
                          ),
                        ],
                      ),
                      const SizedBox(height: 30),
                      Container(
                        height: 1,
                        color: Colors.grey[350],
                      ),
                      const SizedBox(height: 15),
                      Row(
                        children: [
                          const Expanded(
                            child: Text('Barcode'),
                          ),
                          const SizedBox(width: 10),
                          Expanded(
                            flex: 2,
                            child: Padding(
                              padding: const EdgeInsets.only(left: 15),
                              child: TextFormField(
                                onSaved: (newValue) {
                                  barCode = barcodeString!;
                                },
                                validator: (value) {
                                  if (value == null || value.isEmpty) {
                                    checkValidation(
                                        'Must select barcode input method');
                                  }
                                  return null;
                                },
                                readOnly: true,
                                controller:
                                    TextEditingController(text: barcodeString),
                                decoration: const InputDecoration.collapsed(
                                  hintText: "Select barcode input method",
                                  hintStyle: TextStyle(color: Colors.grey),
                                ),
                              ),
                            ),
                          ),
                          PopupMenuButton<String>(
                            splashRadius: 20,
                            onSelected: (value) {
                              if (value == '0') {
                                scanBarcode();
                              } else if (value == '1') {
                                showBarcodeInputDialog(context);
                              } else if (value == '2') {
                                setState(() {
                                  barcodeString = generateRandomNumber();
                                });
                              }
                              // else if (value == '3') {}
                            },
                            itemBuilder: (BuildContext context) => [
                              PopupMenuItem<String>(
                                value: '0',
                                child: Row(
                                  children: const [
                                    Icon(Icons.qr_code_scanner_sharp),
                                    SizedBox(width: 10),
                                    Text('Scan Input'),
                                  ],
                                ),
                              ),
                              PopupMenuItem<String>(
                                value: '1',
                                child: Row(
                                  children: const [
                                    Icon(Icons.keyboard),
                                    SizedBox(width: 10),
                                    Text('Manual Input'),
                                  ],
                                ),
                              ),
                              PopupMenuItem<String>(
                                value: '2',
                                child: Row(
                                  children: const [
                                    Icon(Icons.add_circle),
                                    SizedBox(width: 10),
                                    Text('Generate Barcode'),
                                  ],
                                ),
                              ),
                              // PopupMenuItem<String>(
                              //   value: '3',
                              //   child: Row(
                              //     children: const [
                              //       Icon(Icons.remove_circle),
                              //       SizedBox(width: 10),
                              //       Text('No Barcode'),
                              //     ],
                              //   ),
                              // ),
                              // Add more PopupMenuItem widgets as needed
                            ],
                            icon: const Icon(
                              Icons.more_vert,
                              color: Colors.grey,
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
                            child: Text('Quantity'),
                          ),
                          const SizedBox(width: 10),
                          Expanded(
                            flex: 2,
                            child: TextFormField(
                              onSaved: (newValue) {
                                quantity = int.parse(newValue!);
                              },
                              validator: (value) {
                                if (value == null || value.isEmpty) {
                                  checkValidation('Quantity is required');
                                }
                                return null;
                              },
                              keyboardType: TextInputType.number,
                              inputFormatters: [
                                FilteringTextInputFormatter.allow(
                                    RegExp(r'[0-9]')), // Allow only numbers
                              ],
                              decoration: const InputDecoration.collapsed(
                                hintText: "Item Quantity",
                                hintStyle: TextStyle(color: Colors.grey),
                              ),
                            ),
                          ),
                        ],
                      ),
                      const SizedBox(height: 30),
                      Container(
                        height: 1,
                        color: Colors.grey[350],
                      ),
                      const SizedBox(height: 30),
                      Row(
                        children: [
                          const Expanded(
                            child: Text('Cost'),
                          ),
                          const SizedBox(width: 10),
                          Expanded(
                            flex: 2,
                            child: TextFormField(
                              onSaved: (newValue) {
                                cost = double.parse(newValue!);
                              },
                              validator: (value) {
                                if (value == null || value.isEmpty) {
                                  checkValidation('Cost is required');
                                }
                                return null;
                              },
                              keyboardType:
                                  const TextInputType.numberWithOptions(
                                      decimal: true),
                              inputFormatters: [
                                FilteringTextInputFormatter.allow(
                                    RegExp(r'^\d+\.?\d{0,2}')),
                              ],
                              decoration: const InputDecoration.collapsed(
                                hintText: "Input cost (required)",
                                hintStyle: TextStyle(color: Colors.grey),
                              ),
                            ),
                          ),
                        ],
                      ),
                      const SizedBox(height: 30),
                      Container(
                        height: 1,
                        color: Colors.grey[350],
                      ),
                      const SizedBox(height: 30),
                      Row(
                        children: [
                          const Expanded(
                            child: Text('Price'),
                          ),
                          const SizedBox(width: 10),
                          Expanded(
                            flex: 2,
                            child: TextFormField(
                              onSaved: (newValue) {
                                price = double.parse(newValue!);
                              },
                              validator: (value) {
                                if (value == null || value.isEmpty) {
                                  checkValidation('Price is required');
                                }
                                return null;
                              },
                              keyboardType:
                                  const TextInputType.numberWithOptions(
                                      decimal: true),
                              inputFormatters: [
                                FilteringTextInputFormatter.allow(
                                    RegExp(r'^\d+\.?\d{0,2}')),
                              ],
                              decoration: const InputDecoration.collapsed(
                                hintText: "Input Price (required)",
                                hintStyle: TextStyle(color: Colors.grey),
                              ),
                            ),
                          ),
                        ],
                      ),
                      const SizedBox(height: 30),
                      Container(
                        height: 1,
                        color: Colors.grey[350],
                      ),
                      const SizedBox(height: 30),
                      Row(
                        children: [
                          const Expanded(
                            child: Text('Item Category'),
                          ),
                          const SizedBox(width: 10),
                          Expanded(
                            flex: 2,
                            child: DropdownButtonFormField<String>(
                              onSaved: (newValue) {
                                itemCategoryId = int.parse(newValue!);
                              },
                              validator: (value) {
                                if (value == null || value.isEmpty) {
                                  checkValidation(
                                      'Item Category Must be selected');
                                }
                                return null;
                              },
                              menuMaxHeight: 300,
                              value: selectedOption,
                              items: itemCategory
                                  .map((ItemCategoryType itemCategory) {
                                return DropdownMenuItem<String>(
                                  value: itemCategory.id,
                                  child: Text(itemCategory.name),
                                );
                              }).toList(),
                              onChanged: (String? newValue) {
                                setState(() {
                                  selectedOption = newValue;
                                });
                              },
                              decoration: const InputDecoration.collapsed(
                                hintText: "Select an option",
                                hintStyle: TextStyle(color: Colors.grey),
                              ),
                            ),
                          ),
                        ],
                      ),
                      const SizedBox(height: 30),
                      // Add Item Button
                      Container(
                        height: 1,
                        color: Colors.grey[350],
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
                                padding:
                                    EdgeInsets.only(top: 20.0, bottom: 20.0),
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
                          _submitForm();
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
