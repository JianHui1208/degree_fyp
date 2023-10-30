import 'package:flutter/material.dart';

class SubscriptionScreen extends StatelessWidget {
  const SubscriptionScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Center(
      child: AlertDialog(
        title: const Text('Subscribe Now'),
        content: const Text(
            'Unlock premium features with our subscription package.'),
        actions: <Widget>[
          TextButton(
            child: const Text('Cancel'),
            onPressed: () {
              Navigator.of(context).pop();
            },
          ),
          TextButton(
            child: const Text('Subscribe'),
            onPressed: () {
              // Implement your subscription logic here
              // You can navigate to a subscription page or perform the necessary actions
              Navigator.of(context).pop();
            },
          ),
        ],
      ),
    );
  }
}
