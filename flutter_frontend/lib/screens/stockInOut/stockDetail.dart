import 'package:flutter/material.dart';
import '../../components/loading.dart';
import '../../gen/assets.gen.dart';
import '../../models/stock_detail.dart';
import '../../providers/api.dart';
import 'dart:convert';
import 'package:intl/intl.dart';

class StockDetail extends StatefulWidget {
  final int stockID;

  const StockDetail({super.key, required this.stockID});

  @override
  _StockDetailState createState() => _StockDetailState();
}

Future<StockDetailType> getStockDetailById(stockID) async {
  final responseString = await getStockInOutDetail(stockID);
  final decodedData = json.decode(responseString);
  final stockDetail =
      StockDetailType.fromJson(decodedData['response']['stockHistory']);
  return stockDetail;
}

class _StockDetailState extends State<StockDetail> {
  bool isLoading = false;
  late Future<StockDetailType> futureStockDetail;

  @override
  void initState() {
    super.initState();
    futureStockDetail = getStockDetailById(widget.stockID.toString());
    futureStockDetail.then((value) {
      setState(() {
        isLoading = false;
      });
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        centerTitle: true,
        title: const Text(
          'History',
          style: TextStyle(
            color: Colors.black,
            letterSpacing: 1,
            fontWeight: FontWeight.bold,
          ),
        ),
        leading: IconButton(
          icon: const Icon(
            Icons.close,
            color: Colors.black,
          ),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
      ),
      body: LayoutBuilder(
        builder: (BuildContext context, BoxConstraints constraints) {
          return isLoading
              ? const Loading()
              : FutureBuilder<StockDetailType>(
                  future: futureStockDetail,
                  builder: (context, snapshot) {
                    if (snapshot.hasData) {
                      return StockDetailContent(
                        stockDetail: snapshot.data!,
                      );
                    } else if (snapshot.hasError) {
                      return Text('${snapshot.error}');
                    }
                    return const Loading();
                  },
                );
        },
      ),
    );
  }
}

class StockDetailContent extends StatelessWidget {
  final StockDetailType stockDetail;
  const StockDetailContent({Key? key, required this.stockDetail})
      : super(key: key);

  @override
  Widget build(BuildContext context) {
    var formatter = DateFormat('MMM d, y - h:mm a');
    String formattedDateTime =
        formatter.format(DateTime.parse(stockDetail.createdAt));

    return SingleChildScrollView(
      physics: const BouncingScrollPhysics(),
      child: Container(
        padding: const EdgeInsets.all(20),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              formattedDateTime,
              style: const TextStyle(
                fontSize: 13,
                color: Colors.grey,
              ),
            ),
            const SizedBox(height: 10),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  stockDetail.inOrOut == 0
                      ? 'Stock Out'
                      : stockDetail.inOrOut == 1
                          ? 'Stock In'
                          : stockDetail.inOrOut == 2
                              ? 'Adjust'
                              : 'Unknown',
                  style: TextStyle(
                    color: stockDetail.inOrOut == 0
                        ? Colors.red
                        : stockDetail.inOrOut == 1
                            ? Colors.blue
                            : stockDetail.inOrOut == 2
                                ? Colors.green
                                : Colors.black,
                    fontSize: 30,
                    fontWeight: FontWeight.bold,
                    letterSpacing: 1.5,
                  ),
                ),
                Text(
                  stockDetail.inOrOut == 0
                      ? 'Buyer: Ali'
                      : stockDetail.inOrOut == 1
                          ? 'Supplier: John'
                          : stockDetail.inOrOut == 2
                              ? ''
                              : 'Unknown',
                ),
              ],
            ),
            const SizedBox(height: 10),
            Divider(
              color: stockDetail.inOrOut == 0
                  ? Colors.red
                  : stockDetail.inOrOut == 1
                      ? Colors.blue
                      : stockDetail.inOrOut == 2
                          ? Colors.green
                          : Colors.black,
              thickness: 3,
            ),
            const SizedBox(height: 10),
            Container(
              padding: const EdgeInsets.only(left: 20, right: 20),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Column(
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: [
                      Text(
                        stockDetail.itemCount.toString(),
                        style: const TextStyle(
                          fontSize: 15,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      const SizedBox(height: 5),
                      const Text(
                        'Item',
                        style: TextStyle(
                          fontSize: 13,
                          color: Colors.grey,
                        ),
                      ),
                    ],
                  ),
                  Column(
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: [
                      Text(
                        stockDetail.totalQuantity.toString(),
                        style: const TextStyle(
                          fontSize: 15,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      const SizedBox(height: 5),
                      const Text(
                        'Quantity',
                        style: TextStyle(
                          fontSize: 13,
                          color: Colors.grey,
                        ),
                      ),
                    ],
                  ),
                  Column(
                    crossAxisAlignment: CrossAxisAlignment.center,
                    children: [
                      CircleAvatar(
                        backgroundColor: Theme.of(context).primaryColorDark,
                        radius: 20,
                        child: ClipRRect(
                          borderRadius: BorderRadius.circular(50),
                          child: Assets.images.people.image(
                            width: 50,
                            height: 50,
                            fit: BoxFit.cover,
                          ),
                        ),
                      ),
                      const SizedBox(height: 5),
                      const Text(
                        'William',
                        style: TextStyle(
                          fontSize: 13,
                          color: Colors.grey,
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),
            const SizedBox(height: 10),
            SizedBox(
              height: stockDetail.stockItems.length >= 4 ? 350 : null,
              child: ListView.builder(
                shrinkWrap: true,
                itemCount: stockDetail.stockItems.length,
                itemBuilder: (context, index) {
                  var stockOrder = stockDetail.stockItems[index];
                  return StockItemListTile(
                    inOrOut: stockDetail.inOrOut,
                    oldQuantity: stockOrder.oldQuantity,
                    newQuantity: stockOrder.newQuantity,
                    itemName: stockOrder.items.name,
                    itemImageUrl: stockOrder.items.imageUrl,
                  );
                },
              ),
            ),
            const SizedBox(height: 10),
            const Text(
              'Description',
              style: TextStyle(
                fontSize: 20,
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 10),
            Text(
              stockDetail.description,
            ),
          ],
        ),
      ),
    );
  }
}

class StockItemListTile extends StatelessWidget {
  final int inOrOut;
  final int oldQuantity;
  final int newQuantity;
  final String itemName;
  final String? itemImageUrl; // Nullable image URL

  const StockItemListTile({
    Key? key,
    required this.inOrOut,
    required this.oldQuantity,
    required this.newQuantity,
    required this.itemName,
    this.itemImageUrl,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    ImageProvider getImageProvider(String? imageUrl) {
      if (imageUrl != null) {
        return NetworkImage(imageUrl);
      } else {
        return const NetworkImage(
            'https://cdn.vectorstock.com/i/preview-1x/65/30/default-image-icon-missing-picture-page-vector-40546530.jpg');
      }
    }

    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(8),
      ),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          Container(
            width: 50,
            height: 50,
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(10),
              shape: BoxShape.rectangle,
              image: DecorationImage(
                image: getImageProvider(itemImageUrl),
                fit: BoxFit.cover,
              ),
            ),
          ),
          const SizedBox(width: 16),
          Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                children: [
                  Text(
                    itemName,
                    style: const TextStyle(
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 4),
              Row(
                children: [
                  Row(
                    children: [
                      Text('Quantity: $oldQuantity'),
                      const Icon(Icons.arrow_forward),
                      Text('$newQuantity'),
                    ],
                  ),
                  const SizedBox(width: 60),
                  Row(
                    children: [
                      inOrOut == 1
                          ? const Icon(
                              Icons.add,
                              color: Colors.blue,
                            )
                          : inOrOut == 0
                              ? const Icon(
                                  Icons.remove,
                                  color: Colors.red,
                                )
                              : inOrOut == 2
                                  ? const Icon(
                                      Icons.add,
                                      color: Colors.green,
                                    )
                                  : const Icon(
                                      Icons.cancel_outlined,
                                      color: Colors.black,
                                    ),
                      Text(
                        inOrOut == 0
                            ? (oldQuantity - newQuantity).toString()
                            : inOrOut == 1
                                ? (newQuantity - oldQuantity).toString()
                                : (newQuantity - oldQuantity).toString(),
                        style: TextStyle(
                          color: inOrOut == 0
                              ? Colors.red
                              : inOrOut == 1
                                  ? Colors.blue
                                  : inOrOut == 2
                                      ? Colors.green
                                      : Colors.black,
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ],
          ),
        ],
      ),
    );
  }
}
