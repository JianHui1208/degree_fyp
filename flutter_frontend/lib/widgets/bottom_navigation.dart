import 'package:flutter/material.dart';

import '../../routes/route.dart';
import '../common/theme.dart';

class BottomNavigation extends StatefulWidget {
  final int currentIndex;

  const BottomNavigation({
    Key? key,
    required this.currentIndex,
  }) : super(key: key);

  @override
  BottomNavigationStatus createState() => BottomNavigationStatus();
}

class BottomNavigationStatus extends State<BottomNavigation> {
  @override
  Widget build(BuildContext context) {
    return Container(
      height: 65,
      decoration: BoxDecoration(
        borderRadius: const BorderRadius.only(
          topLeft: Radius.circular(20.0),
          topRight: Radius.circular(20.0),
        ),
        color: Theme.of(context).primaryColorLight,
        boxShadow: const [boxShadow],
      ),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        children: [
          InkWell(
            onTap: () {
              Navigator.of(context).pushReplacementNamed(RouteList.dashboard);
            },
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Icon(
                  Icons.home_sharp,
                  color: widget.currentIndex == 0
                      ? Colors.blue[800]
                      : Theme.of(context).highlightColor,
                ),
                Text(
                  'Home',
                  style: TextStyle(
                    color: widget.currentIndex == 0
                        ? Colors.blue[800]
                        : Theme.of(context).highlightColor,
                  ),
                ),
              ],
            ),
          ),
          InkWell(
            onTap: () {
              Navigator.of(context).pushReplacementNamed(RouteList.itemCategory);
            },
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Icon(
                  Icons.inventory,
                  color: widget.currentIndex == 1
                      ? Colors.blue[800]
                      : Theme.of(context).highlightColor,
                ),
                Text(
                  'Items',
                  style: TextStyle(
                    color: widget.currentIndex == 1
                        ? Colors.blue[800]
                        : Theme.of(context).highlightColor,
                  ),
                ),
              ],
            ),
          ),
          // InkWell(
          //   onTap: () {
          //     Navigator.of(context).pushReplacementNamed(RouteList.booking);
          //   },
          //   child: Column(
          //     mainAxisAlignment: MainAxisAlignment.center,
          //     children: [
          //       Icon(
          //         Icons.circle_notifications,
          //         color: widget.currentIndex == 2
          //             ? Colors.blue[800]
          //             : Theme.of(context).highlightColor,
          //       ),
          //       Text(
          //         'Notification',
          //         style: TextStyle(
          //           color: widget.currentIndex == 2
          //               ? Colors.blue[800]
          //               : Theme.of(context).highlightColor,
          //         ),
          //       ),
          //     ],
          //   ),
          // ),
          InkWell(
            onTap: () {
              Navigator.of(context)
                  .pushReplacementNamed(RouteList.stockInOutList);
            },
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Icon(
                  Icons.swap_vert,
                  color: widget.currentIndex == 3
                      ? Colors.blue[800]
                      : Theme.of(context).highlightColor,
                ),
                Text(
                  'In / Out',
                  style: TextStyle(
                    color: widget.currentIndex == 3
                        ? Colors.blue[800]
                        : Theme.of(context).highlightColor,
                  ),
                ),
              ],
            ),
          ),
          InkWell(
            onTap: () {
              Navigator.of(context).pushReplacementNamed(RouteList.account);
            },
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Icon(
                  Icons.settings,
                  color: widget.currentIndex == 4
                      ? Colors.blue[800]
                      : Theme.of(context).highlightColor,
                ),
                Text(
                  'Settings',
                  style: TextStyle(
                    color: widget.currentIndex == 4
                        ? Colors.blue[800]
                        : Theme.of(context).highlightColor,
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
