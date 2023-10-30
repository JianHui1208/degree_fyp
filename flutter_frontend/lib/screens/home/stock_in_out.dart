import 'package:flutter/material.dart';
import '../../common/theme.dart';
import '../../routes/route.dart';

class StockInOut extends StatelessWidget {
  const StockInOut({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    final screenSize = MediaQuery.of(context).size;
    final cardHeight = screenSize.height * 0.26;

    return Container(
      height: cardHeight,
      width: double.infinity,
      margin: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: Theme.of(context).primaryColorLight,
        boxShadow: const [boxShadow],
        borderRadius: const BorderRadius.all(Radius.circular(15)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            margin: const EdgeInsets.only(top: 20, left: 15, bottom: 10),
            child: const Text(
              'Stock In / Out',
              style: TextStyle(
                fontWeight: FontWeight.bold,
                fontSize: 20,
              ),
            ),
          ),
          ListTile(
            onTap: () {
              Navigator.of(context).pushNamed(RouteList.addStockIn);
            },
            title: const Text('Stock In'),
            leading: Icon(
              Icons.save_alt,
              color: Colors.blue[800],
              size: 30,
            ),
            trailing: const Icon(
              Icons.arrow_forward_ios_rounded,
            ),
          ),
          ListTile(
            onTap: () {
              Navigator.of(context).pushNamed(RouteList.addStockOut);
            },
            title: const Text('Stock Out'),
            leading: Icon(
              Icons.ios_share,
              color: Colors.blue[800],
              size: 30,
            ),
            trailing: const Icon(
              Icons.arrow_forward_ios_rounded,
            ),
          ),
          ListTile(
            onTap: () {
              Navigator.of(context).pushNamed(RouteList.adjustStock);
            },
            title: const Text('Adjust'),
            leading: Icon(
              Icons.swap_vert,
              color: Colors.blue[800],
              size: 30,
            ),
            trailing: const Icon(
              Icons.arrow_forward_ios_rounded,
            ),
          ),
        ],
      ),
    );
  }
}
