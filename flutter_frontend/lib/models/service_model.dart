import 'package:flutter_svg/svg.dart';

import '../gen/assets.gen.dart';

class Service {
  SvgPicture svg;
  String title;
  bool last;

  Service({
    required this.svg,
    required this.title,
    this.last = false,
  });

  static List<Service> genereateService() {
    return [
      Service(
        svg: SvgPicture.asset(
          Assets.svg.service.ourservice,
          height: 45,
        ),
        title: 'Our Package',
      ),
      Service(
        svg: SvgPicture.asset(
          Assets.svg.service.carwash,
          height: 45,
        ),
        title: 'Car Wash',
      ),
      Service(
        svg: SvgPicture.asset(
          Assets.svg.service.cleaning,
          height: 45,
        ),
        title: 'Cleaning',
      ),
      Service(
        svg: SvgPicture.asset(
          Assets.svg.service.polishing,
          height: 45,
        ),
        title: 'Polishing',
      ),
      Service(
        svg: SvgPicture.asset(
          Assets.svg.service.tinted,
          height: 45,
        ),
        title: 'Tinted',
      ),
      Service(
        svg: SvgPicture.asset(
          Assets.svg.service.wrapping,
          height: 45,
        ),
        title: 'Wrapping',
      ),
    ];
  }
}
