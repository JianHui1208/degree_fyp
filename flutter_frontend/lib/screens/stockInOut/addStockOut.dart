import 'package:flutter/material.dart';
import 'LongTextDialog.dart';
import 'dart:convert';
import '../../providers/api.dart';
import '../../routes/route.dart';
import 'addItemList.dart';
import '../../models/stock_history_model.dart';
import '../../components/ErrorBox.dart';
import '../../models/supplier_model.dart';

class AddStockOut extends StatefulWidget {
  const AddStockOut({Key? key}) : super(key: key);

  @override
  _AddStockOutState createState() => _AddStockOutState();
}

class _AddStockOutState extends State<AddStockOut> {
  final _formKey = GlobalKey<FormState>();
  List<Item> modifiedItems = []; // List to track modified items
  List<Supplier> buyerObjects = [];
  List<StockHistoryItem> stockHistoryItems = [];
  String? selectedOption;
  String? description;

  void submitStockOut() async {
    BuildContext dialogContext = context;
    int countTotalQuantity = 0;
    if (_formKey.currentState!.validate()) {
      _formKey.currentState!.save();

      for (var i = 0; i < modifiedItems.length; i++) {
        stockHistoryItems.add(
          StockHistoryItem(
            itemId: modifiedItems[i].id,
            oldQuantity: modifiedItems[i].oldQuantity,
            newQuantity: modifiedItems[i].oldQuantity +
                modifiedItems[i].currentAddQuantity,
            currentAddQuantity: modifiedItems[i].currentAddQuantity,
          ),
        );

        countTotalQuantity += modifiedItems[i].currentAddQuantity;
      }

      StockHistory stockHistory = StockHistory(
        inOrOut: '0',
        totalQuantity: countTotalQuantity.toString(),
        description: description ??= '',
        stockItems: stockHistoryItems,
      );

      String response = await storeStockIn(stockHistory.toJson());
      dynamic jsonData = jsonDecode(response);

      if (jsonData['status'] == 1154) {
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            backgroundColor: Theme.of(context).secondaryHeaderColor,
            duration: const Duration(seconds: 2),
            content: Container(
              padding: const EdgeInsets.all(8),
              child: const Text(
                'Stock Out Record Added Successfully',
                style: TextStyle(
                  color: Colors.white,
                  fontSize: 18,
                ),
              ),
            ),
          ),
        );
        Future.delayed(const Duration(seconds: 3), () {
          Navigator.of(context).pushReplacementNamed(RouteList.dashboard);
        });
      } else {
        Future.delayed(Duration.zero, () {
          showDialog(
            context: dialogContext,
            builder: (BuildContext context) {
              return const ErrorBox(
                message: 'Stock Out Record Save Failed',
                content:
                    'There was a problem with the System. Please try again later.',
              );
            },
          );
        });
      }
    }
  }

  Future<String?> showLongTextDialog(BuildContext context,
      {String? initialDescription}) async {
    return await showDialog(
      context: context,
      builder: (context) =>
          LongTextDialog(initialDescription: initialDescription),
    );
  }

  String _truncateDescription(String description) {
    const int maxVisibleChars =
        10; // Adjust the number of visible characters to your preference.
    return (description.length <= maxVisibleChars)
        ? description
        : '${description.substring(0, maxVisibleChars)}...';
  }

  // Item Category
  List<String> suppliers = [
    'Option 1',
    'Option 2',
    'Option 3',
    'Option 4',
  ];

  @override
  Widget build(BuildContext context) {
    List<dynamic> jsonData = json.decode(buyListJson);
    buyerObjects = (jsonData).map((json) => Supplier.fromJson(json)).toList();

    return Scaffold(
      appBar: AppBar(
        leading: IconButton(
          icon: const Icon(
            Icons.close,
            size: 30.0,
          ),
          onPressed: () => Navigator.of(context).pop(),
        ),
        centerTitle: true,
        backgroundColor: Colors.red,
        title: const Text('Stock Out'),
      ),
      body: Stack(
        children: [
          Column(
            children: [
              Form(
                key: _formKey,
                child: Container(
                  padding: const EdgeInsets.all(20.0),
                  child: SingleChildScrollView(
                    child: Column(
                      // Change Row to Column
                      children: [
                        Row(
                          children: const [
                            Text(
                              'Stock Out',
                              style: TextStyle(
                                color: Colors.red,
                                fontSize: 20.0,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                          ],
                        ),
                        const SizedBox(height: 10),
                        Container(
                          height: 3,
                          color: Colors.red,
                        ),
                        const SizedBox(height: 20),
                        Row(
                          children: [
                            const Expanded(
                              child: Text('Customer'),
                            ),
                            const SizedBox(width: 10),
                            Expanded(
                              flex: 2,
                              child: DropdownButtonFormField<String>(
                                menuMaxHeight: 300,
                                value: selectedOption,
                                items: buyerObjects.map((Supplier option) {
                                  // Update this line
                                  return DropdownMenuItem<String>(
                                    value: option.name,
                                    child: Text(option.name),
                                  );
                                }).toList(),
                                onChanged: (String? newValue) {
                                  setState(() {
                                    selectedOption = newValue;
                                    print(selectedOption);
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
                        const SizedBox(height: 20),
                        Row(
                          children: [
                            const Expanded(
                              child: Text('Item'),
                            ),
                            const SizedBox(width: 10),
                            TextButton(
                              onPressed: () {
                                Navigator.of(context)
                                    .pushNamed(RouteList.addItemQuantityList,
                                        arguments: 'stockOut')
                                    .then(
                                      (result) => {
                                        if (result != null &&
                                            result is List<Item>)
                                          {
                                            setState(() {
                                              modifiedItems = result;
                                              print(modifiedItems);
                                            })
                                          }
                                      },
                                    );
                              },
                              child: const Text(
                                'Item List',
                              ),
                            ),
                          ],
                        ),
                        const SizedBox(height: 20),
                        Row(
                          children: [
                            const Expanded(
                              child: Text('Description'),
                            ),
                            const SizedBox(width: 10),
                            TextButton(
                              onPressed: () async {
                                String? newDescription =
                                    await showLongTextDialog(
                                  context,
                                  initialDescription: description,
                                );

                                if (newDescription != null) {
                                  setState(() {
                                    description = newDescription;
                                  });
                                }
                              },
                              child: (description != null)
                                  ? Text(
                                      _truncateDescription(description!),
                                      overflow: TextOverflow.ellipsis,
                                      maxLines: 3,
                                    )
                                  : const Text('Write'),
                            ),
                          ],
                        ),
                        const SizedBox(height: 15),
                        Container(
                          height: 3,
                          color: Colors.red,
                        ),
                        const SizedBox(height: 10),
                        Row(
                          children: const [
                            Text('Item Quantity Change'),
                          ],
                        ),
                        const SizedBox(height: 10),
                        Container(
                          height: 3,
                          color: Colors.red,
                        ),
                        const SizedBox(height: 15),
                        modifiedItems.isEmpty
                            ? const SizedBox(
                                height: 200,
                                child: Center(
                                  child: Text('No items selected'),
                                ),
                              )
                            : SizedBox(
                                height: 370,
                                child: ListView.builder(
                                  itemCount: modifiedItems.length,
                                  itemBuilder:
                                      (BuildContext context, int index) {
                                    return ListTile(
                                      contentPadding: const EdgeInsets.all(10),
                                      leading: Image.network(
                                        'https://cdn.vectorstock.com/i/preview-1x/65/30/default-image-icon-missing-picture-page-vector-40546530.jpg',
                                      ),
                                      title: Text(modifiedItems[index].name),
                                      trailing: Text(
                                        '- ${modifiedItems[index].currentAddQuantity.toString()}',
                                        style:
                                            const TextStyle(color: Colors.red),
                                      ),
                                    );
                                  },
                                ),
                              ),
                        const SizedBox(height: 10),
                      ],
                    ),
                  ),
                ),
              ),
            ],
          ),
          Positioned(
            bottom: 10, // Padding from the bottom
            left: 10, // Padding from the left
            right: 10, // Padding from the right
            child: ElevatedButton(
              style: ElevatedButton.styleFrom(
                primary: Colors.red,
                padding: const EdgeInsets.symmetric(
                  horizontal: 50,
                  vertical: 20,
                ),
                textStyle: const TextStyle(
                  fontSize: 25,
                  // fontWeight: FontWeight.bold,
                ),
              ),
              onPressed: () {
                submitStockOut();
                // Navigator.of(context).pop();
              },
              child: const Text('Submit'),
            ),
          ),
        ],
      ),
    );
  }
}
