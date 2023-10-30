import 'package:flutter/material.dart';
import '../../common/theme.dart';
import '../../routes/route.dart';

class AddItem extends StatelessWidget {
  const AddItem({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    final screenSize = MediaQuery.of(context).size;
    final cardHeight = screenSize.height * 0.20;

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
              'Add Item',
              style: TextStyle(
                fontWeight: FontWeight.bold,
                fontSize: 20,
              ),
            ),
          ),
          ListTile(
            onTap: () {
              Navigator.of(context).pushReplacementNamed(RouteList.addItem);
            },
            title: const Text('Register new items'),
            leading: Icon(
              Icons.playlist_add,
              color: Colors.blue[800],
              size: 30,
            ),
            trailing: const Icon(
              Icons.arrow_forward_ios_rounded,
            ),
          ),
          ListTile(
            onTap: () {
              // Add your action for the second list item here
              print('Item 2 tapped');
            },
            title: const Text('Register by Excel File'),
            leading: Icon(
              Icons.file_open,
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
