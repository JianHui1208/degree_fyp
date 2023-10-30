import 'package:flutter/material.dart';

class CustomDivider extends StatelessWidget {
  const CustomDivider({super.key});

  @override
  Widget build(BuildContext context) {
    return Divider(
      height: 30,
      thickness: 1,
      color: Theme.of(context).dividerColor,
    );
  }
}
