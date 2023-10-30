import 'dart:convert';
import '../../components/loading.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';

import '../../providers/api.dart';
import '../../common/theme.dart';
import '../../gen/assets.gen.dart';
import '../../routes/route.dart';
import '../../widgets/bottom_navigation.dart';
import '../../widgets/custom_scaffold.dart';

class ItemCategory extends StatefulWidget {
  const ItemCategory({super.key});

  @override
  State<ItemCategory> createState() => _ItemCategoryState();
}

class _ItemCategoryState extends State<ItemCategory> {
  bool isLoading = true;
  List<ItemCategoryType> itemCategoryList = [];

  void getItemCategory() async {
    String itemCategoryString = await getItemCategoryGroupByItem();
    dynamic itemCategoryObj = jsonDecode(itemCategoryString);

    setState(() {
      isLoading = false;
    });

    for (var i = 0;
        i < itemCategoryObj['response']['itemCategories'].length;
        i++) {
      ItemCategoryType object = ItemCategoryType(
        itemCategoryObj['response']['itemCategories'][i]['id'],
        itemCategoryObj['response']['itemCategories'][i]['name'],
        itemCategoryObj['response']['itemCategories'][i]['status'],
        itemCategoryObj['response']['itemCategories'][i]['items_count'],
        itemCategoryObj['response']['itemCategories'][i]['total_quantity'],
        itemCategoryObj['response']['itemCategories'][i]['image_preview'],
        itemCategoryObj['response']['itemCategories'][i]['image_url'],
        itemCategoryObj['response']['itemCategories'][i]['image_thumbnail'],
      );

      itemCategoryList.add(object);
    }
  }

  void _showCreateDialog() {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: const Text(
            'Create',
            style: TextStyle(
              fontSize: 20,
              fontWeight: FontWeight.bold,
            ),
          ),
          content: SingleChildScrollView(
            child: ListBody(
              children: <Widget>[
                _createListItem(
                  icon: Icons.add_circle,
                  text: 'Create Item',
                  onTap: () {
                    Navigator.of(context).pop();
                    Navigator.of(context).pushNamed(RouteList.addItem);
                  },
                ),
                _createListItem(
                  icon: Icons.add_circle,
                  text: 'Create Item Category',
                  onTap: () {
                    Navigator.of(context).pop();
                    Navigator.of(context).pushNamed(RouteList.addItemCategory);
                  },
                ),
                const SizedBox(height: 10),
                _createListItem(
                  icon: Icons.cancel,
                  text: 'Cancel',
                  onTap: () {
                    Navigator.of(context).pop();
                  },
                ),
              ],
            ),
          ),
        );
      },
    );
  }

  Widget _createListItem(
      {IconData? icon, required String text, required VoidCallback onTap}) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8.0),
      child: GestureDetector(
        onTap: onTap,
        child: Row(
          children: [
            Icon(icon),
            const SizedBox(width: 10),
            Text(text),
          ],
        ),
      ),
    );
  }

  @override
  void initState() {
    super.initState();
    getItemCategory();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          'Category',
          style: Theme.of(context).textTheme.bodyLarge,
        ),
        backgroundColor: Theme.of(context).primaryColorLight,
        actions: [
          IconButton(
            splashRadius: 20,
            icon: const Icon(Icons.add, color: Colors.grey),
            onPressed: () {
              _showCreateDialog();
            },
          ),
        ],
      ),
      bottomNavigationBar: const BottomNavigation(currentIndex: 1),
      body: SingleChildScrollView(
        physics: const BouncingScrollPhysics(),
        child: Column(
          children: [
            isLoading
                ? const Loading()
                : ListView.builder(
                    shrinkWrap: true,
                    physics: const NeverScrollableScrollPhysics(),
                    itemCount: itemCategoryList.length,
                    itemBuilder: (itemBuilder, index) {
                      return itemList(itemCategoryList[index]);
                    },
                  ),
          ],
        ),
      ),
    );
  }

  Widget itemList(ItemCategoryType data) {
    return Container(
      margin: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        borderRadius: const BorderRadius.only(
          topLeft: Radius.circular(20.0),
          topRight: Radius.circular(20.0),
          bottomLeft: Radius.circular(20.0),
          bottomRight: Radius.circular(20.0),
        ),
        color: Theme.of(context).primaryColorLight,
        boxShadow: const [boxShadow],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          InkWell(
            // after click show booking detail screen
            onTap: () {
              Navigator.of(context)
                  .pushNamed(RouteList.itemList, arguments: data.id);
            },
            child: Container(
              padding: const EdgeInsets.all(15.0),
              child: Column(
                children: [
                  Row(
                    children: [
                      Expanded(
                        child: Text(
                          data.name,
                          style: const TextStyle(
                            fontSize: 25,
                            color: Colors.black,
                            fontWeight: FontWeight.bold,
                            letterSpacing: 1.5,
                          ),
                        ),
                      ),
                      Padding(
                        padding: const EdgeInsets.only(right: 13),
                        child: Container(
                          decoration: BoxDecoration(
                            shape: BoxShape.circle,
                            border: Border.all(
                              color: Colors.blue,
                              width: 2,
                            ),
                          ),
                          child: CircleAvatar(
                            backgroundColor: Theme.of(context).primaryColorDark,
                            radius: 20,
                            child: ClipRRect(
                              borderRadius: BorderRadius.circular(50),
                              child: Image.network(
                                data.imageUrl ??
                                    'https://cdn.vectorstock.com/i/preview-1x/65/30/default-image-icon-missing-picture-page-vector-40546530.jpg',
                                width: 50,
                                height: 50,
                                fit: BoxFit.cover,
                              ),
                            ),
                          ),
                        ),
                      ),
                    ],
                  ),
                  Padding(
                    padding: const EdgeInsets.fromLTRB(5, 17, 5, 5),
                    child: Row(
                      children: [
                        const Padding(
                          padding: EdgeInsets.only(right: 10),
                          child: Icon(
                            Icons.list_alt,
                            color: Colors.blue,
                            size: 20,
                          ),
                        ),
                        Text(
                          '${data.itemCount}',
                          style: const TextStyle(
                            color: Colors.black,
                            fontSize: 20,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        Text(
                          ' Items',
                          style: Theme.of(context).textTheme.titleMedium,
                        ),
                      ],
                    ),
                  ),
                  Padding(
                    padding: const EdgeInsets.fromLTRB(5, 17, 5, 5),
                    child: Row(
                      children: [
                        const Padding(
                          padding: EdgeInsets.only(right: 10),
                          child: Icon(
                            Icons.numbers,
                            color: Colors.green,
                            size: 20,
                          ),
                        ),
                        Text(
                          '${data.totalQuantity}',
                          style: const TextStyle(
                            color: Colors.black,
                            fontSize: 20,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        Text(
                          ' Quantity',
                          style: Theme.of(context).textTheme.titleMedium,
                          // style: TextStyle(
                          //   color: Color.fromARGB(255, 170, 170, 170),
                          //   fontSize: 16,
                          //   fontWeight: FontWeight.w500,
                          // ),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}

class ItemCategoryType {
  final int id;
  final String name;
  final int status;
  final int itemCount;
  final int totalQuantity;
  final String? imageUrl;
  final String? imagePreview;
  final String? imageThumbnail;

  ItemCategoryType(
    this.id,
    this.name,
    this.status,
    this.itemCount,
    this.totalQuantity,
    this.imagePreview,
    this.imageUrl,
    this.imageThumbnail,
  );
}
