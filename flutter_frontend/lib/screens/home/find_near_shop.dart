import 'package:flutter/material.dart';

import '../../common/theme.dart';
import '../../gen/assets.gen.dart';
import '../../routes/route.dart';

class FindNearShop extends StatelessWidget {
  const FindNearShop({super.key});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      child: Container(
        margin: const EdgeInsets.all(20),
        decoration: BoxDecoration(
          color: Theme.of(context).primaryColorLight,
          boxShadow: const [boxShadow],
          borderRadius: const BorderRadius.all(Radius.circular(25)),
        ),
        child: Column(
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceEvenly,
              children: [
                Expanded(
                  child: Assets.images.map.image(),
                ),
                Expanded(
                  flex: 2,
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'Find Near Shop',
                        style: Theme.of(context).textTheme.labelLarge,
                      ),
                      const SizedBox(height: 5),
                      Text(
                        'All Branch',
                        style: Theme.of(context).textTheme.bodySmall,
                      ),
                    ],
                  ),
                ),
                Expanded(
                  flex: 1,
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: const [
                      Icon(Icons.chevron_right),
                    ],
                  ),
                ),
              ],
            )
          ],
        ),
      ),
    );
  }
}
