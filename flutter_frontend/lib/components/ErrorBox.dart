import 'package:flutter/material.dart';

class ErrorBox extends StatelessWidget {
  final String message;
  final String content;

  const ErrorBox({
    super.key,
    required this.message,
    required this.content,
  });

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: Text(
        message,
        style: const TextStyle(
          fontSize: 20,
          color: Colors.red,
          fontWeight: FontWeight.bold,
        ),
      ),
      content: Text(
        content,
      ),
      actions: <Widget>[
        TextButton(
          child: const Text('OK'),
          onPressed: () {
            Navigator.of(context).pop();
          },
        ),
      ],
    );
  }
}
