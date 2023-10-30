import 'package:flutter/material.dart';
import '../../providers/api.dart';
import '../../models/stock_list.dart';
import '../../gen/assets.gen.dart';
import '../../common/theme.dart';
import '../../routes/route.dart';
import '../../widgets/bottom_navigation.dart';
import '../../components/loading.dart';
import 'dart:convert';

Future<StockHistoryResponse> getStockInoutList() async {
  final responseString = await getStockInOutList();
  final decodedData = json.decode(responseString);
  final stockHistoryResponse =
      StockHistoryResponse.fromJson(decodedData['response']);
  return stockHistoryResponse;
}

class StockInOutList extends StatefulWidget {
  const StockInOutList({Key? key}) : super(key: key);

  @override
  _StockInOutListState createState() => _StockInOutListState();
}

class _StockInOutListState extends State<StockInOutList> {
  bool isLoading = false;
  late Future<StockHistoryResponse> stockHistoryResponseFuture;

  @override
  void initState() {
    super.initState();
    stockHistoryResponseFuture = getStockInoutList();
    stockHistoryResponseFuture.then((value) {
      setState(() {
        isLoading = false;
      });
    });
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
                  text: 'Create Stock In',
                  onTap: () {
                    Navigator.of(context).pop();
                    Navigator.of(context).pushNamed(RouteList.addStockIn);
                  },
                ),
                _createListItem(
                  icon: Icons.remove_circle,
                  text: 'Create Stock Out',
                  onTap: () {
                    Navigator.of(context).pop();
                    Navigator.of(context).pushNamed(RouteList.addStockOut);
                  },
                ),
                _createListItem(
                  icon: Icons.settings,
                  text: 'Create Adjust',
                  onTap: () {
                    Navigator.of(context).pop();
                    Navigator.of(context).pushNamed(RouteList.adjustStock);
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
  Widget build(BuildContext context) {
    return Scaffold(
      bottomNavigationBar: const BottomNavigation(currentIndex: 3),
      appBar: AppBar(
        backgroundColor: Colors.white,
        title: Text(
          'Stock In/Out',
          style: Theme.of(context).textTheme.bodyLarge,
        ),
        actions: [
          IconButton(
            splashRadius: 20,
            icon: const Icon(Icons.add, color: Colors.grey),
            onPressed: () {
              _showCreateDialog();
            },
          ),
          // IconButton(
          //   splashRadius: 20,
          //   icon: const Icon(Icons.filter_list_alt, color: Colors.grey),
          //   onPressed: () {
          //     Navigator.of(context).pushReplacementNamed(RouteList.booking);
          //   },
          // ),
        ],
      ),
      body: LayoutBuilder(
        builder: (BuildContext context, BoxConstraints constraints) {
          return isLoading
              ? const Loading()
              : FutureBuilder<StockHistoryResponse>(
                  future: stockHistoryResponseFuture,
                  builder: (context, snapshot) {
                    if (snapshot.connectionState == ConnectionState.waiting) {
                      return const Loading();
                    } else if (snapshot.hasError) {
                      return Center(
                        child: Column(
                          children: const [
                            SizedBox(height: 20),
                            CircularProgressIndicator(),
                            SizedBox(height: 20),
                            Text('Waiting for data...'),
                          ],
                        ),
                      );
                    } else if (snapshot.hasData) {
                      return ListView.builder(
                        itemCount: 1,
                        itemBuilder: (context, index) {
                          return StockHistoryWidget(
                            stockHistoryResponse: snapshot.data!,
                            containerWidth: constraints.maxWidth,
                          );
                        },
                      );
                    } else {
                      return const Text('No data available');
                    }
                  },
                );
        },
      ),
    );
  }
}

class StockHistoryWidget extends StatelessWidget {
  final StockHistoryResponse stockHistoryResponse;
  final double containerWidth;

  const StockHistoryWidget({
    Key? key,
    required this.stockHistoryResponse,
    required this.containerWidth,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    double itemWidth = containerWidth * 0.8;

    return SizedBox(
      height: MediaQuery.of(context).size.height * 0.85,
      child: ListView.builder(
        itemCount: stockHistoryResponse.stockHistory.length,
        itemBuilder: (context, index) {
          final stockList =
              stockHistoryResponse.stockHistory.values.elementAt(index);
          final isLastStockList =
              index == stockHistoryResponse.stockHistory.length - 1;
          return StockListWidget(
            stockList: stockList,
            isLastStockList: isLastStockList,
            containerWidth: containerWidth,
            itemWidth: itemWidth,
          );
        },
      ),
    );
  }
}

class StockListWidget extends StatelessWidget {
  final StockList stockList;
  final bool isLastStockList;
  final double containerWidth;
  final double itemWidth;

  const StockListWidget({
    Key? key,
    required this.stockList,
    required this.isLastStockList,
    required this.containerWidth,
    required this.itemWidth,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      width: itemWidth,
      padding: const EdgeInsets.only(top: 15.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Padding(
            padding: const EdgeInsets.only(left: 12.0),
            child: Text(stockList.date,
                style: Theme.of(context).textTheme.bodyLarge),
          ),
          ListView.builder(
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            itemCount: stockList.stockOrder.length,
            itemBuilder: (context, index) {
              final stockOrder = stockList.stockOrder[index];
              return StockListItemWidget(
                  stockOrder: stockOrder, itemWidth: itemWidth);
            },
          ),
          if (!isLastStockList)
            const Divider()
          else
            Column(
              children: const [
                SizedBox(height: 10),
                Center(
                  child: Text('No more stock history'),
                ),
                SizedBox(height: 50),
              ],
            )
        ],
      ),
    );
  }
}

class StockListItemWidget extends StatelessWidget {
  final StockOrder stockOrder;
  final double itemWidth;

  const StockListItemWidget({
    Key? key,
    required this.stockOrder,
    required this.itemWidth,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      width: itemWidth,
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
              Navigator.of(context).pushNamed(
                RouteList.stockDetail,
                arguments: stockOrder.id,
              );
            },
            child: Container(
              padding: const EdgeInsets.all(15.0),
              child: Column(
                children: [
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Expanded(
                        child: Text(
                          stockOrder.inOrOut == 0
                              ? 'Stock Out'
                              : stockOrder.inOrOut == 1
                                  ? 'Stock In'
                                  : stockOrder.inOrOut == 2
                                      ? 'Adjust'
                                      : 'Unknown',
                          style: const TextStyle(
                            fontSize: 25,
                            color: Colors.black,
                            fontWeight: FontWeight.bold,
                            // letterSpacing: 1.5,
                          ),
                        ),
                      ),
                      Text(
                        stockOrder.inOrOut == 0
                            ? 'Buyer'
                            : stockOrder.inOrOut == 1
                                ? 'Supplier'
                                : stockOrder.inOrOut == 2
                                    ? ''
                                    : 'Unknown',
                      ),
                    ],
                  ),
                  const SizedBox(height: 15),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Row(
                        children: [
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
                                  '${stockOrder.itemCount}',
                                  style: const TextStyle(
                                    color: Colors.black,
                                    fontSize: 20,
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                                Text(
                                  ' Items',
                                  style:
                                      Theme.of(context).textTheme.titleMedium,
                                ),
                              ],
                            ),
                          ),
                        ],
                      ),
                      Container(
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
                            child: Assets.images.people.image(
                              width: 50,
                              height: 50,
                              fit: BoxFit.cover,
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
                            Icons.bar_chart,
                            color: Colors.blue,
                            size: 20,
                          ),
                        ),
                        Text(
                          stockOrder.totalQuantity,
                          style: const TextStyle(
                            color: Colors.black,
                            fontSize: 20,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        Text(
                          ' Total Item Quantity',
                          style: Theme.of(context).textTheme.titleMedium,
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
