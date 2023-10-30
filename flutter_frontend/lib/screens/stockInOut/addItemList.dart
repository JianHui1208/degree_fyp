import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:inventory_management/components/loading.dart';
import 'QuantityDialog.dart';
import '../../providers/api.dart';

class AddItemQuantityList extends StatefulWidget {
  final String inOrOut;

  const AddItemQuantityList({super.key, required this.inOrOut});

  @override
  _AddItemQuantityListState createState() => _AddItemQuantityListState();
}

class _AddItemQuantityListState extends State<AddItemQuantityList> {
  List<Item> items = [];
  bool _isLoading = true;

  void _getItemOfStock() async {
    String response = await getItemOfStockApi();
    dynamic jsonData = jsonDecode(response);

    for (var i = 0; i < jsonData['response']['items'].length; i++) {
      items.add(Item(
        id: jsonData['response']['items'][i]['id'],
        name: jsonData['response']['items'][i]['name'],
        oldQuantity: jsonData['response']['items'][i]['quantity'],
        imageUrl: jsonData['response']['items'][i]['image_url'],
      ));
    }

    setState(() {
      _isLoading = false;
    });
  }

  @override
  void initState() {
    super.initState();
    _getItemOfStock();
  }

  List<Item> modifiedItems = []; // List to track modified items

  void _showQuantityDialog(BuildContext context, Item item) async {
    int oldQuantity = item.oldQuantity;
    int currentAddQuantity = item.currentAddQuantity;
    int newQuantity;
    if (widget.inOrOut == 'stockIn') {
      newQuantity = oldQuantity + currentAddQuantity;
    } else if (widget.inOrOut == 'stockOut') {
      newQuantity = oldQuantity - currentAddQuantity;
    } else {
      newQuantity = currentAddQuantity;
    }

    int? newAddQuantity = await showDialog<int>(
      context: context,
      builder: (BuildContext context) {
        return QuantityDialog(
          currentAddQuantity: currentAddQuantity,
          oldQuantity: oldQuantity,
          newQuantity: newQuantity,
        );
      },
    );

    if (newAddQuantity != null) {
      setState(() {
        item.currentAddQuantity = newAddQuantity;
        if (!modifiedItems.contains(item)) {
          modifiedItems.add(item); // Add the modified item to the list
        }
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    print(widget.inOrOut);
    return Scaffold(
      appBar: AppBar(
        title: const Text('Select Item'),
        leading: IconButton(
          icon: const Icon(Icons.keyboard_arrow_left),
          onPressed: () {
            Navigator.pop(context, modifiedItems);
          },
        ),
      ),
      body: _isLoading
          ? const Loading()
          : ListView.builder(
              itemCount: items.length,
              itemBuilder: (BuildContext context, int index) {
                Color textColor;
                String currentQuantity;
                int newQuantity;

                if (widget.inOrOut == 'stockIn') {
                  textColor = Colors.blue;
                  currentQuantity =
                      '+ ${items[index].currentAddQuantity.toString()}';
                  newQuantity = items[index].oldQuantity +
                      items[index].currentAddQuantity;
                } else if (widget.inOrOut == 'stockOut') {
                  textColor = Colors.red;
                  currentQuantity =
                      '- ${items[index].currentAddQuantity.toString()}';
                  newQuantity = items[index].oldQuantity -
                      items[index].currentAddQuantity;
                } else {
                  textColor = Colors.green;
                  currentQuantity = items[index].currentAddQuantity.toString();
                  newQuantity = items[index].currentAddQuantity;
                }
                return ListTile(
                  contentPadding: const EdgeInsets.all(15),
                  leading: Image.network(
                    items[index].imageUrl ??
                        'https://cdn.vectorstock.com/i/preview-1x/65/30/default-image-icon-missing-picture-page-vector-40546530.jpg',
                    width: 50,
                    height: 50,
                  ),
                  title: Text(items[index].name),
                  onTap: () {
                    _showQuantityDialog(context, items[index]);
                  },
                  trailing: Text(
                    currentQuantity,
                    style: TextStyle(color: textColor),
                  ),
                  subtitle: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'Old Quantity: ${items[index].oldQuantity.toString()}',
                      ),
                      Text(
                        'New Quantity: ${newQuantity.toString()}',
                      ),
                    ],
                  ),
                );
              },
            ),
    );
  }
}

class Item {
  int id;
  String name;
  String? imageUrl;
  int oldQuantity;
  int currentAddQuantity;

  Item({
    required this.id,
    required this.name,
    required this.oldQuantity,
    this.imageUrl,
    this.currentAddQuantity = 0,
  });
}
