import 'package:flutter/material.dart';

class ScaffoldCustom extends StatelessWidget {
  final String text;
  final Widget body;
  final Widget? bottomNavigationBar;
  final bool? leadingButton;
  final Widget? actionButton;

  const ScaffoldCustom({
    required this.text,
    required this.body,
    this.bottomNavigationBar,
    this.leadingButton,
    this.actionButton,
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Theme.of(context).scaffoldBackgroundColor,
      appBar: AppBar(
        // if have leading button show icon
        leading: (leadingButton == false)
            ? Container()
            : IconButton(
                onPressed: () {
                  Navigator.of(context).pop();
                },
                icon: const Icon(
                  Icons.keyboard_arrow_left,
                  color: Colors.black,
                  size: 30.0,
                ),
              ),
        title: Text(
          text,
          style: Theme.of(context).textTheme.bodyLarge,
        ),
        centerTitle: true,
        backgroundColor: Theme.of(context).primaryColorLight,
        actions: [
          actionButton ?? Container(),
        ],
      ),
      body: body,
      bottomNavigationBar: bottomNavigationBar,
    );
  }
}
