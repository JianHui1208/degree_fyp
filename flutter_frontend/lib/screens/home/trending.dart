import 'package:flutter/material.dart';

import '../../models/trending_model.dart';

class Trending extends StatelessWidget {
  Trending({super.key});

  final trendingList = TrendingData.genereateTrending();

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Padding(
          padding: const EdgeInsets.only(left: 20, top: 30),
          child: Text(
            'Trending',
            style: Theme.of(context).textTheme.titleLarge,
          ),
        ),
        SizedBox(
          height: 250,
          child: ListView(
            physics: const BouncingScrollPhysics(),
            scrollDirection: Axis.horizontal,
            padding: const EdgeInsets.symmetric(horizontal: 15),
            // use .map to generate 3 trending image and text
            children: trendingList.map<Widget>((trendingList) {
              return FeatureGridItem(
                img: trendingList.image,
                title: trendingList.title,
              );
            }).toList(),
          ),
        ),
      ],
    );
  }
}

// trending detail layout
class FeatureGridItem extends StatelessWidget {
  final Image img;
  final String title;

  const FeatureGridItem({
    required this.img,
    required this.title,
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      mainAxisAlignment: MainAxisAlignment.spaceAround,
      children: [
        Stack(
          children: [
            Card(
              semanticContainer: true,
              clipBehavior: Clip.antiAliasWithSaveLayer,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(15.0),
              ),
              margin: const EdgeInsets.all(6),
              child: img,
            ),
            Positioned(
              left: 15,
              bottom: 30,
              child: Text(
                title,
                style: const TextStyle(
                  fontSize: 16,
                  color: Colors.white,
                  fontWeight: FontWeight.w500,
                ),
              ),
            ),
          ],
        )
      ],
    );
  }
}
