import 'package:flutter/material.dart';
import '../../routes/route.dart';

class Homeheader extends StatelessWidget {
  const Homeheader({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return AppBar(
      backgroundColor: Colors.white,
      title: Text(
        'Home',
        style: Theme.of(context).textTheme.bodyLarge,
      ),
      actions: [
        IconButton(
          icon: const Icon(Icons.notifications, color: Colors.grey),
          onPressed: () {
            Navigator.of(context).pushReplacementNamed(RouteList.booking);
          },
        ),
        IconButton(
          icon: const Icon(Icons.add, color: Colors.grey),
          onPressed: () {
            Navigator.of(context).pushReplacementNamed(RouteList.booking);
          },
        ),
      ],
    );
  }
}
