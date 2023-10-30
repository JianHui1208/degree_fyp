import 'package:flutter/material.dart';

import '../gen/assets.gen.dart';

class TrendingData {
  Image image;
  String title;
  bool last;

  TrendingData({
    required this.image,
    required this.title,
    this.last = false,
  });

  static List<TrendingData> genereateTrending() {
    return [
      TrendingData(
        image: Assets.images.trending1.image(width: 350),
        title: 'Car Wash and Auto Detailing Now!',
      ),
      TrendingData(
        image: Assets.images.trending2.image(width: 350),
        title: 'Car Wash',
      ),
      TrendingData(
        image: Assets.images.trending1.image(width: 350),
        title: 'Cleaning',
      ),
    ];
  }
}
