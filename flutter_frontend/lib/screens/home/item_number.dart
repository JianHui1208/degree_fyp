import 'package:flutter/material.dart';
import '../../providers/api.dart';
import 'dart:convert';

class ItemNumber extends StatefulWidget {
  const ItemNumber({Key? key}) : super(key: key);

  @override
  _ItemNumberState createState() => _ItemNumberState();
}

class _ItemNumberState extends State<ItemNumber> {
  late Future<ItemQuantity> itemQuantity = fetchItemQuantity();
  @override
  void initState() {
    super.initState();
    itemQuantity = fetchItemQuantity(); // Fetch data during initialization
  }

  @override
  Widget build(BuildContext context) {
    // Responsive
    final screenSize = MediaQuery.of(context).size;
    final cardWidth = screenSize.width * 0.94;
    final cardHeight = screenSize.height * 0.225;

    // Get the date
    DateTime currentDate = DateTime.now();
    String formattedDate =
        "${_getMonthName(currentDate.month)} ${currentDate.day}";

    return FutureBuilder<ItemQuantity>(
        future: itemQuantity,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const CircularProgressIndicator(); // Display loading indicator
          } else if (snapshot.hasError) {
            return Center(
              child: Column(
                children: const [
                  CircularProgressIndicator(),
                  SizedBox(height: 20),
                  Text('Waiting for data...'),
                ],
              ),
            );
          } else {
            final data = snapshot.data!;
            return Column(
              crossAxisAlignment: CrossAxisAlignment.center,
              children: [
                SizedBox(
                  height: cardHeight,
                  width: cardWidth,
                  child: Card(
                    color: Colors.blue[800],
                    semanticContainer: true,
                    clipBehavior: Clip.antiAliasWithSaveLayer,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(15.0),
                    ),
                    margin: const EdgeInsets.all(6),
                    child: Container(
                      padding: const EdgeInsets.all(16.0),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.stretch,
                        children: [
                          Row(
                            children: [
                              const Text(
                                'Today',
                                style: TextStyle(
                                  color: Colors.white,
                                  fontWeight: FontWeight.bold,
                                  letterSpacing: 1.5,
                                ),
                              ),
                              const SizedBox(width: 20),
                              Text(
                                formattedDate,
                                style: const TextStyle(
                                  color: Colors.grey,
                                ),
                              ),
                            ],
                          ),
                          const SizedBox(height: 50),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.spaceBetween,
                            children: [
                              Row(
                                mainAxisAlignment:
                                    MainAxisAlignment.spaceBetween,
                                children: [
                                  Container(
                                    padding: const EdgeInsets.only(
                                        left: 5, right: 35.0),
                                    decoration: const BoxDecoration(
                                      border: Border(
                                        right: BorderSide(
                                          width: 1.0,
                                          color: Colors.grey,
                                        ),
                                      ),
                                    ),
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Text(
                                          data.totalQuantity.toString(),
                                          style: const TextStyle(
                                            fontSize: 25,
                                            color: Colors.white,
                                            fontWeight: FontWeight.bold,
                                            letterSpacing: 1.5,
                                          ),
                                        ),
                                        const SizedBox(height: 30),
                                        const Text(
                                          'Total',
                                          style: TextStyle(
                                            color: Colors.grey,
                                          ),
                                        ),
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  Container(
                                    padding: const EdgeInsets.only(right: 35.0),
                                    decoration: const BoxDecoration(
                                      border: Border(
                                        right: BorderSide(
                                          width: 1.0,
                                          color: Colors.grey,
                                        ),
                                      ),
                                    ),
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Text(
                                          data.stockInQuantity.toString(),
                                          style: const TextStyle(
                                            fontSize: 25,
                                            color: Colors.white,
                                            fontWeight: FontWeight.bold,
                                            letterSpacing: 1.5,
                                          ),
                                        ),
                                        const SizedBox(height: 30),
                                        const Text(
                                          'Stock In',
                                          style: TextStyle(
                                            color: Colors.grey,
                                          ),
                                        ),
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                              Row(
                                children: [
                                  Container(
                                    padding: const EdgeInsets.only(right: 15.0),
                                    child: Column(
                                      crossAxisAlignment:
                                          CrossAxisAlignment.start,
                                      children: [
                                        Text(
                                          data.stockOutQuantity.toString(),
                                          style: const TextStyle(
                                            fontSize: 25,
                                            color: Colors.white,
                                            fontWeight: FontWeight.bold,
                                            letterSpacing: 1.5,
                                          ),
                                        ),
                                        const SizedBox(height: 30),
                                        const Text(
                                          'Stock Out',
                                          style: TextStyle(
                                            color: Colors.grey,
                                          ),
                                        ),
                                      ],
                                    ),
                                  ),
                                ],
                              ),
                            ],
                          )
                        ],
                      ),
                    ),
                  ),
                ),
              ],
            );
          }
        });
  }
}

class ItemQuantity {
  final int totalQuantity;
  final int stockOutQuantity;
  final int stockInQuantity;

  ItemQuantity({
    required this.totalQuantity,
    required this.stockOutQuantity,
    required this.stockInQuantity,
  });
}

Future<ItemQuantity> fetchItemQuantity() async {
  final response = await getItemQuantity();
  final data = json.decode(response);

  return ItemQuantity(
    totalQuantity: data['response']['items_quantity'],
    stockOutQuantity: data['response']['stockOut_quantity'],
    stockInQuantity: data['response']['stockIn_quantity'],
  );
}

String _getMonthName(int month) {
  switch (month) {
    case 1:
      return 'Jan';
    case 2:
      return 'Feb';
    case 3:
      return 'Mar';
    case 4:
      return 'Apr';
    case 5:
      return 'May';
    case 6:
      return 'Jun';
    case 7:
      return 'Jul';
    case 8:
      return 'Aug';
    case 9:
      return 'Sep';
    case 10:
      return 'Oct';
    case 11:
      return 'Nov';
    case 12:
      return 'Dec';
    default:
      return 'Unknown';
  }
}
