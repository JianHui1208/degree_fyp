import 'package:flutter/material.dart';
import 'dart:convert';
import '../../providers/api.dart';
import '../../common/theme.dart';
import '../../widgets/custom_divider.dart';
import '../../widgets/custom_scaffold.dart';
import '../../components/loading.dart';
import '../../components/switch.dart';
import '../../components/ComfirmationBox.dart';
import '../../routes/route.dart';
import '../../components/ErrorBox.dart';

class ItemDetail extends StatefulWidget {
  final int itemID;

  const ItemDetail({super.key, required this.itemID});

  @override
  State<ItemDetail> createState() => _ItemDetailState();
}

class _ItemDetailState extends State<ItemDetail> {
  bool isLoading = true;
  int itemCategoryID = 0;
  Map<String, dynamic>? itemObj;

  void getItemDetail() async {
    String itemString = await getItemByItemID(widget.itemID.toString());
    itemObj = jsonDecode(itemString);

    setState(() {
      isLoading = false;
      itemCategoryID = itemObj!['response']['item']['item_category_id'] ?? 0;
    });
  }

  void deleteItemFunc() async {
    String itemString = await deleteItem(widget.itemID.toString());

    itemObj = jsonDecode(itemString);
    if (itemObj!['status'] == 1105) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          backgroundColor: Theme.of(context).secondaryHeaderColor,
          duration: const Duration(seconds: 2),
          content: Container(
            padding: const EdgeInsets.all(8),
            child: Text(
              'Item Delete Successfully',
              style: Theme.of(context).textTheme.labelLarge,
            ),
          ),
        ),
      );
      Navigator.of(context).pushReplacementNamed(RouteList.itemCategory,
          arguments: itemCategoryID);
    } else {
      const ErrorBox(
        message: 'Error',
        content: 'Item not deleted, wait for server response',
      );
    }

    setState(() {
      isLoading = false;
    });
  }

  @override
  void initState() {
    super.initState();
    getItemDetail();
  }

  @override
  Widget build(BuildContext context) {
    return ScaffoldCustom(
      text: 'Item Detail',
      body: SingleChildScrollView(
        physics: const BouncingScrollPhysics(),
        child: isLoading
            ? const Loading()
            : Container(
                margin: const EdgeInsets.all(20),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        Text(
                          "Item ID: ${itemObj!['response']['item']['id']}",
                          style: Theme.of(context).textTheme.bodyMedium,
                        ),
                        Container(
                          padding: const EdgeInsets.symmetric(
                              vertical: 5, horizontal: 25),
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(8),
                            color: Colors.white,
                          ),
                          child: Row(
                            children: [
                              const Text('Status: '),
                              itemObj!['response']['item']['status'] == 1
                                  ? const SwitchApp(comeInValue: true)
                                  : const SwitchApp(comeInValue: false),
                            ],
                          ),
                        ),
                      ],
                    ),
                    ContainerBoxShadow(
                      children: [
                        Text(
                          itemObj!['response']['item']['name'],
                          style: Theme.of(context).textTheme.labelLarge,
                        ),
                        const CustomDivider(),
                        Container(
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(20),
                            border: Border.all(
                              color: Colors
                                  .black, // Set the color of the border lines
                              width: 1, // Set the width of the border lines
                            ),
                          ),
                          child: ClipRRect(
                            borderRadius: BorderRadius.circular(20),
                            child: Image.network(
                              itemObj!['response']['item']['image_url'] ??
                                  'https://cdn.vectorstock.com/i/preview-1x/65/30/default-image-icon-missing-picture-page-vector-40546530.jpg',
                            ),
                          ),
                        ),

                        const SizedBox(height: 15),
                        itemBaseDetail(),
                        const CustomDivider(),
                        // table show payment status
                        itemCategoryDetail(),
                      ],
                    ),
                    const SizedBox(height: 15),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        ElevatedButton(
                          style: ElevatedButton.styleFrom(
                            backgroundColor: Colors.blue,
                            elevation: 0,
                            minimumSize: const Size(170, 80),
                          ),
                          onPressed: () {},
                          child: const Text("Update"),
                        ),
                        ElevatedButton(
                          style: ElevatedButton.styleFrom(
                            backgroundColor: Colors.red,
                            elevation: 0,
                            minimumSize: const Size(170, 80),
                          ),
                          onPressed: () {
                            showDialog(
                              context: context,
                              builder: (BuildContext context) =>
                                  DeleteConfirmationDialog(
                                title: 'Delete Item',
                                content:
                                    'Are you sure you want to delete this item?',
                                onConfirm: () {
                                  deleteItemFunc();
                                },
                              ),
                            );
                          },
                          child: const Text("Delete"),
                        ),
                      ],
                    ),
                  ],
                ),
              ),
      ),
    );
  }

  Widget itemBaseDetail() {
    return Table(
      defaultVerticalAlignment: TableCellVerticalAlignment.middle,
      columnWidths: const {
        0: FlexColumnWidth(3),
        1: FlexColumnWidth(1),
        2: FlexColumnWidth(3),
      },
      children: <TableRow>[
        TableRow(
          children: <Widget>[
            Text('Barcode', style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  itemObj!['response']['item']['barcode'],
                  style: Theme.of(context).textTheme.labelMedium,
                ),
              ],
            ),
          ],
        ),
        TableRow(
          children: <Widget>[
            Text('Cost', style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  itemObj!['response']['item']['cost'].toString(),
                  style: Theme.of(context).textTheme.labelMedium,
                ),
              ],
            ),
          ],
        ),
        TableRow(
          children: <Widget>[
            Text('Price', style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  itemObj!['response']['item']['price'].toString(),
                  style: Theme.of(context).textTheme.labelMedium,
                ),
              ],
            ),
          ],
        ),
        TableRow(
          children: <Widget>[
            Text('Quantity', style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  itemObj!['response']['item']['quantity'].toString(),
                  style: Theme.of(context).textTheme.labelMedium,
                ),
              ],
            ),
          ],
        ),
        TableRow(
          children: <Widget>[
            Text('Updated At', style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  itemObj!['response']['item']['updated_at'].toString(),
                  style: Theme.of(context).textTheme.labelMedium,
                ),
              ],
            ),
          ],
        ),
      ],
    );
  }

  Widget itemCategoryDetail() {
    return Table(
      defaultVerticalAlignment: TableCellVerticalAlignment.middle,
      columnWidths: const {
        0: FlexColumnWidth(3),
        1: FlexColumnWidth(1),
        2: FlexColumnWidth(3),
      },
      children: <TableRow>[
        TableRow(
          children: <Widget>[
            Text('Item Category',
                style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Text(itemObj!['response']['item']['item_category']['name'],
                style: Theme.of(context).textTheme.labelMedium),
          ],
        ),
      ],
    );
  }
}

class ContainerBoxShadow extends StatelessWidget {
  final List<Widget> children;

  const ContainerBoxShadow({
    required this.children,
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(15),
      margin: const EdgeInsets.only(top: 20),
      decoration: BoxDecoration(
        color: Theme.of(context).primaryColorLight,
        borderRadius: BorderRadius.circular(12),
        boxShadow: const [boxShadow],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: children,
      ),
    );
  }
}
