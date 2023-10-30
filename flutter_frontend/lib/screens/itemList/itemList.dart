import 'dart:convert';

import 'package:flutter/material.dart';
import '../../components/loading.dart';

import '../../providers/api.dart';
import '../../common/theme.dart';
import '../../gen/assets.gen.dart';
import '../../widgets/custom_divider.dart';
import '../../widgets/custom_scaffold.dart';
import '../../common/theme.dart';
import '../../routes/route.dart';

class ItemList extends StatefulWidget {
  final int itemCategoryId;

  const ItemList({super.key, required this.itemCategoryId});

  @override
  State<ItemList> createState() => _ItemListState();
}

class _ItemListState extends State<ItemList> {
  bool isTapped = false;
  bool isEmpty = false;
  bool isLoading = true;
  List<Item> itemList = [];

  void getItemList() async {
    String itemString =
        await getItemByCategoryID(widget.itemCategoryId.toString());
    dynamic itemObj = jsonDecode(itemString);

    setState(() {
      isLoading = false;
    });

    if (itemObj['response']['items'].length == 0) {
      setState(() {
        isEmpty = true;
      });
    } else {
      for (var i = 0; i < itemObj['response']['items'].length; i++) {
        Item object = Item(
          itemObj['response']['items'][i]['id'],
          itemObj['response']['items'][i]['name'],
          itemObj['response']['items'][i]['quantity'],
          itemObj['response']['items'][i]['image_url'],
          itemObj['response']['items'][i]['image_thumbnail'],
          itemObj['response']['items'][i]['image_preview'],
        );

        itemList.add(object);
      }
    }
  }

  @override
  void initState() {
    super.initState();
    getItemList();
  }

  @override
  Widget build(BuildContext context) {
    return ScaffoldCustom(
      text: 'Item List',
      body: SingleChildScrollView(
        physics: const BouncingScrollPhysics(),
        child: Column(
          children: [
            isLoading
                ? const Loading()
                : isEmpty
                    ? Center(
                        child: Column(
                          children: const [
                            SizedBox(height: 50),
                            Text(
                              'No item found',
                              style: TextStyle(
                                fontSize: 20,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                          ],
                        ),
                      )
                    : ListView.builder(
                        shrinkWrap: true,
                        physics: const NeverScrollableScrollPhysics(),
                        itemCount: itemList.length,
                        itemBuilder: (BuildContext context, int index) {
                          return listUI(itemList[index]);
                        },
                      ),
          ],
        ),
      ),
    );
  }

  Widget listUI(Item item) {
    return InkWell(
      onTap: () {
        setState(() {
          isTapped = !isTapped;
        });
      },
      child: Container(
        margin: const EdgeInsets.all(20),
        decoration: BoxDecoration(
          borderRadius: const BorderRadius.only(
            topLeft: Radius.circular(20.0),
            topRight: Radius.circular(20.0),
            bottomLeft: Radius.circular(20.0),
            bottomRight: Radius.circular(20.0),
          ),
          // color: Color.fromRGBO(64, 75, 96, .9),
          color: isTapped ? Colors.white : Theme.of(context).primaryColorLight,
          boxShadow: const [boxShadow],
        ),
        child: ListTile(
          contentPadding: const EdgeInsets.symmetric(
            horizontal: 20.0,
            vertical: 10.0,
          ),
          leading: Container(
            padding: const EdgeInsets.only(right: 12.0),
            decoration: const BoxDecoration(
              border: Border(
                right: BorderSide(
                  width: 1.0,
                  color: Colors.black,
                ),
              ),
            ),
            child: Image.network(
              item.imageUrl ?? 'https://cdn.vectorstock.com/i/preview-1x/65/30/default-image-icon-missing-picture-page-vector-40546530.jpg',
              width: 100,
              height: 100,
            ),
          ),
          title: Text(
            item.name,
            style: const TextStyle(
              color: Colors.black,
              fontWeight: FontWeight.bold,
            ),
          ),
          subtitle: Text(
            "Quantity: ${item.quantity.toString()}",
            style: const TextStyle(
              color: Colors.black,
              fontStyle: FontStyle.italic,
            ),
          ),
          trailing: const Icon(
            Icons.keyboard_arrow_right,
            color: Colors.black,
            size: 30.0,
          ),
          onTap: () {
            Navigator.of(context)
                .pushNamed(RouteList.itemDetail, arguments: item.id);
          },
        ),
      ),
    );
  }
}

class Item {
  final int id;
  final String name;
  final int quantity;
  final String? imageUrl;
  final String? imageThumbnail;
  final String? imagePreview;

  const Item(
    this.id,
    this.name,
    this.quantity,
    this.imageUrl,
    this.imageThumbnail,
    this.imagePreview,
  );
}
