import 'dart:convert';
import 'package:flutter/material.dart';
import '../../components/loading.dart';
import '../../gen/assets.gen.dart';
import '../../routes/route.dart';
import '../../providers/api.dart';

class SearchResult extends StatefulWidget {
  final String keyword;

  const SearchResult({super.key, required this.keyword});

  @override
  State<SearchResult> createState() => _SearchResultState();
}

class _SearchResultState extends State<SearchResult> {
  bool isEmpty = false;
  bool isLoading = true;
  final List<Item> items = [];

  void searchApi() async {
    String result = await searchItem(widget.keyword.toString());
    dynamic jsonResult = jsonDecode(result);

    if (jsonResult['status'] == 1110) {
      setState(() {
        isLoading = false;
        isEmpty = true;
      });
    } else {
      setState(() {
        isLoading = false;
      });
      for (var i = 0; i < jsonResult['response']['result'].length; i++) {
        Item object = Item(
          id: jsonResult['response']['result'][i]['id'],
          name: jsonResult['response']['result'][i]['name'],
          price: jsonResult['response']['result'][i]['price'],
          imageUrl: jsonResult['response']['result'][i]['image_url'] ?? '',
        );

        items.add(object);
      }
    }
  }

  @override
  void initState() {
    super.initState();
    searchApi();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
          title: const Text(
            'Search Result',
            style: TextStyle(color: Colors.black),
          ),
          backgroundColor: Colors.white,
          leading: IconButton(
            onPressed: () {
              Navigator.of(context).pushReplacementNamed(RouteList.search);
            },
            icon: const Icon(Icons.arrow_back_ios_rounded, color: Colors.black),
          )),
      body: isLoading
          ? const Loading()
          : Container(
              padding: const EdgeInsets.all(15),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text('Search Result for: ${widget.keyword}'),
                  const SizedBox(height: 15),
                  isEmpty
                      ? const EmptyList()
                      : Expanded(
                          child: ListView(
                            children: [
                              const SizedBox(height: 15),
                              GridView.builder(
                                gridDelegate:
                                    const SliverGridDelegateWithFixedCrossAxisCount(
                                  crossAxisCount:
                                      2, // Number of columns in the grid
                                ),
                                shrinkWrap:
                                    true, // Allow GridView to be scrollable inside ListView
                                physics:
                                    const NeverScrollableScrollPhysics(), // Disable GridView's scrolling
                                itemCount: items.length,
                                itemBuilder: (context, index) {
                                  return ItemCard(item: items[index]);
                                },
                              ),
                              const SizedBox(height: 15),
                              const Center(
                                child: Text('This is the last item'),
                              ),
                              const SizedBox(height: 15),
                            ],
                          ),
                        )
                ],
              ),
            ),
    );
  }
}

class EmptyList extends StatelessWidget {
  const EmptyList({super.key});

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Container(
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(20),
          ),
          child: ClipRRect(
            borderRadius: BorderRadius.circular(20),
            child: Image.network(
                'https://cdn.dribbble.com/users/888330/screenshots/2653750/empty_data_set.png'),
          ),
        ),
        const SizedBox(height: 20),
        const Center(
          child: Text(
            'No item found',
            style: TextStyle(fontWeight: FontWeight.bold),
          ),
        ),
      ],
    );
  }
}

class ItemCard extends StatelessWidget {
  final Item item;

  const ItemCard({super.key, required this.item});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () {
        Navigator.of(context)
            .pushNamed(RouteList.itemDetail, arguments: item.id);
      },
      child: Card(
        color: Colors.blue,
        child: Container(
          height: 180,
          padding: const EdgeInsets.all(12),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.center,
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              item.imageUrl != ''
                  ? Image.network(item.imageUrl!, fit: BoxFit.cover)
                  : Image.network(
                      'https://cdn.vectorstock.com/i/preview-1x/65/30/default-image-icon-missing-picture-page-vector-40546530.jpg',
                      height: 100,
                    ),
              const SizedBox(height: 10),
              Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  Text(
                    item.name,
                    style: const TextStyle(
                        fontSize: 16.0, fontWeight: FontWeight.bold),
                  ),
                  const SizedBox(height: 5),
                  Text(
                    '\$${item.price.toStringAsFixed(2)}',
                    style: const TextStyle(fontSize: 14.0, color: Colors.black),
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class Item {
  final int id;
  final String name;
  final double price;
  final String? imageUrl;

  Item(
      {required this.id,
      required this.name,
      required this.price,
      required this.imageUrl});
}
