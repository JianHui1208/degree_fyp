import 'package:flutter/material.dart';
import '../../routes/route.dart';

import 'item_number.dart';
import 'search_bar.dart';
import 'add_item.dart';
import 'stock_in_out.dart';
import '../../widgets/bottom_navigation.dart';

class Dashboard extends StatefulWidget {
  const Dashboard({super.key});

  @override
  DashboardState createState() => DashboardState();
}

class DashboardState extends State<Dashboard> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      bottomNavigationBar: const BottomNavigation(currentIndex: 0),
      appBar: AppBar(
        backgroundColor: Colors.white,
        title: Text(
          'Home',
          style: Theme.of(context).textTheme.bodyLarge,
        ),
        actions: [
          IconButton(
            splashRadius: 20,
            icon: const Icon(Icons.notifications, color: Colors.grey),
            onPressed: () {
              Navigator.of(context)
                  .pushReplacementNamed(RouteList.notificationList);
            },
          ),
        ],
      ),
      body: SingleChildScrollView(
        child: Container(
          padding: const EdgeInsets.only(top: 20),
          color: Theme.of(context).scaffoldBackgroundColor,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.center,
            children: const [
              ItemNumber(),
              SearchBar(),
              AddItem(),
              StockInOut(),
            ],
          ),
        ),
      ),
    );
  }
}
