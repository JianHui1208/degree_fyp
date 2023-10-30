import 'package:flutter/material.dart';
import '../../common/theme.dart';
import '../../routes/route.dart';

class SearchBar extends StatelessWidget {
  const SearchBar({super.key});

  @override
  Widget build(BuildContext context) {
    final screenSize = MediaQuery.of(context).size;
    final cardHeight = screenSize.height * 0.08;

    return Container(
      height: cardHeight,
      margin: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: Theme.of(context).primaryColorLight,
        boxShadow: const [boxShadow],
        borderRadius: const BorderRadius.all(Radius.circular(15)),
      ),
      child: ElevatedButton(
        style: ElevatedButton.styleFrom(
          primary: Theme.of(context).primaryColorLight,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(15),
          ),
        ),
        onPressed: () {
          Navigator.of(context).pushReplacementNamed(RouteList.search);
        },
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Row(
              children: [
                const Icon(Icons.search, color: Colors.grey, size: 30),
                const SizedBox(width: 15),
                Text('Search...', style: Theme.of(context).textTheme.bodyLarge),
              ],
            ),
            Row(
              children: [
                Container(
                  height: 45.0,
                  padding: const EdgeInsets.only(left: 18),
                  decoration: const BoxDecoration(
                    border: Border(
                      left: BorderSide(
                        color: Colors.grey,
                        width: 1.0,
                      ),
                    ),
                  ),
                  child: Icon(Icons.qr_code_scanner,
                      color: Colors.blue[800], size: 30),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }
}
