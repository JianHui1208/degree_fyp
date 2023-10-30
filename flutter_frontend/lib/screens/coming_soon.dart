import 'package:flutter/material.dart';

import '../gen/assets.gen.dart';
import '../widgets/elevated_button.dart';

class ComingSoon extends StatelessWidget {
  const ComingSoon({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Material(
      color: Theme.of(context).primaryColorDark,
      child: Padding(
        padding: const EdgeInsets.all(20),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Assets.images.comingsoon.image(width: 120),
            const SizedBox(height: 20),
            Text('Coming Soon !',
                style: Theme.of(context).textTheme.displaySmall),
            const SizedBox(height: 10),
            Text('We are working hard to bring you this features.',
                textAlign: TextAlign.center,
                style: Theme.of(context).textTheme.titleLarge),
            const SizedBox(height: 20),
            ElevatedBtn(
              onPressed: () {
                Navigator.of(context).pop();
              },
              btnText: 'Continue View',
            )
          ],
        ),
      ),
    );
  }
}
