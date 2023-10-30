import 'package:flutter/material.dart';

class ElevatedBtn extends StatelessWidget {
  final void Function() onPressed;
  final String btnText;
  final bool btnColorWhite;

  const ElevatedBtn({
    required this.onPressed,
    required this.btnText,
    this.btnColorWhite = true,
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return ElevatedButton(
      onPressed: onPressed,
      style: ElevatedButton.styleFrom(
        // if button no color white show color red
        backgroundColor: (btnColorWhite)
            ? Theme.of(context).primaryColor
            : Theme.of(context).focusColor,
        minimumSize: const Size.fromHeight(60),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(15.0),
        ),
      ),
      child: Text(
        btnText,
        style: const TextStyle(
          fontWeight: FontWeight.bold,
        ),
      ),
    );
  }
}
