import 'package:flutter/material.dart';

import '../../routes/route.dart';
import '../gen/assets.gen.dart';

class SplashScreen extends StatefulWidget {
  const SplashScreen({super.key});

  @override
  State<SplashScreen> createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  void initState() {
    super.initState();
    initialization();
  }

  // delay for show splash screen
  initialization() async {
    await Future.delayed(const Duration(milliseconds: 3500), nextPage);
  }

  // after splash screen show
  void nextPage() {
    Navigator.of(context).pushReplacementNamed(RouteList.welcome);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Theme.of(context).primaryColorDark,
      body: Center(
        child: Column(
          children: [
            Expanded(
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Assets.images.logo.image(
                    width: MediaQuery.of(context).size.width / 1.7,
                  ),
                  Container(
                    padding: const EdgeInsets.symmetric(
                        horizontal: 60, vertical: 10),
                    child: LinearProgressIndicator(
                      backgroundColor: Theme.of(context).primaryColorLight,
                      color: Theme.of(context).primaryColor,
                      minHeight: 5,
                    ),
                  ),
                ],
              ),
            ),
            Container(
              alignment: Alignment.bottomCenter,
              padding: const EdgeInsets.only(bottom: 20),
              child: Text(
                'Copyright 2023',
                style: Theme.of(context).textTheme.labelSmall,
                textAlign: TextAlign.center,
              ),
            )
          ],
        ),
      ),
    );
  }
}
