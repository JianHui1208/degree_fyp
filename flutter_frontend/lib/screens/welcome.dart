import 'package:flutter/material.dart';

import '../../routes/route.dart';
import '../gen/assets.gen.dart';
import '../widgets/elevated_button.dart';

class Welcome extends StatefulWidget {
  const Welcome({super.key});

  @override
  State<Welcome> createState() => _WelcomeState();
}

class _WelcomeState extends State<Welcome> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          content(context),
        ],
      ),
    );
  }
}

Widget content(BuildContext context) {
  return Container(
    decoration: BoxDecoration(
      color: Theme.of(context).primaryColorDark,
      image: DecorationImage(
        image: Assets.images.landing.image().image,
        opacity: 0.9,
        fit: BoxFit.cover,
      ),
    ),
    child: Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 30),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.end,
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Image(
            image: Assets.images.logo.image().image,
            width: MediaQuery.of(context).size.width / 3.8,
          ),
          Padding(
            padding: const EdgeInsets.only(bottom: 30),
            child: Text(
              'Welcome To SUC Service',
              style: Theme.of(context).textTheme.displayMedium,
            ),
          ),
          ElevatedBtn(
            onPressed: () {
              Navigator.of(context).pushReplacementNamed(RouteList.login);
            },
            btnText: 'Signin',
          ),
          const SizedBox(height: 20),
          ElevatedBtn(
            onPressed: () {
              Navigator.of(context).pushReplacementNamed(RouteList.register);
            },
            btnText: 'Register',
            btnColorWhite: false,
          ),
        ],
      ),
    ),
  );
}
