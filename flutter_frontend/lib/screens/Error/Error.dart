import 'package:flutter/material.dart';
import '../../routes/route.dart';

class ErrorPage extends StatelessWidget {
  final String errorMessage;

  const ErrorPage({Key? key, this.errorMessage = 'An error occurred.'})
      : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Error'),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const Icon(
              Icons.error,
              size: 64,
              color: Colors.red,
            ),
            const SizedBox(height: 16),
            Text(
              errorMessage,
              style: const TextStyle(fontSize: 18),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 16),
            ElevatedButton(
              onPressed: () {
                // Handle the button press to navigate back or perform other actions
                Navigator.of(context).pushReplacementNamed(RouteList.dashboard);
              },
              child: const Text('Go Back'),
            ),
          ],
        ),
      ),
    );
  }
}
