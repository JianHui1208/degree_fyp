import 'package:flutter/material.dart';

import '../../routes/route.dart';
import '../gen/assets.gen.dart';

// widget for login and register
class WCFormTitle extends StatelessWidget {
  final String title;
  final String descr;

  const WCFormTitle({
    required this.title,
    required this.descr,
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      height: MediaQuery.of(context).size.height / 3.9,
      alignment: Alignment.center,
      decoration: BoxDecoration(
        image: DecorationImage(
          image: Assets.images.colorBlue.image().image,
          fit: BoxFit.cover,
          opacity: 0.9,
        ),
        color: Theme.of(context).primaryColorDark,
        borderRadius: const BorderRadius.only(
          bottomLeft: Radius.circular(25),
          bottomRight: Radius.circular(25),
        ),
      ),
      child: Padding(
        padding: const EdgeInsets.only(bottom: 30),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.end,
          children: [
            Align(
              alignment: Alignment.centerLeft,
              child: IconButton(
                icon: const Icon(Icons.arrow_back_ios_rounded),
                color: Theme.of(context).iconTheme.color,
                onPressed: () {
                  Navigator.of(context).pushReplacementNamed(RouteList.login);
                },
              ),
            ),
            Text(
              title,
              style: Theme.of(context).textTheme.displaySmall,
            ),
            const SizedBox(height: 10),
            Text(
              descr,
              style: Theme.of(context).textTheme.titleSmall,
            ),
          ],
        ),
      ),
    );
  }
}
