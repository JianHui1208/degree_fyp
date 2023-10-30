import 'package:flutter/material.dart';

import '../../common/theme.dart';
import '../../models/service_model.dart';
import '../booking/booking_service.dart';

class FindService extends StatelessWidget {
  FindService({super.key});

  final serviceList = Service.genereateService();

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 15),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Padding(
            padding: const EdgeInsets.only(left: 10, bottom: 15),
            child: Text(
              'Find Service',
              style: Theme.of(context).textTheme.titleLarge,
            ),
          ),
          // use gridview builder generate show 6 service list
          GridView.builder(
            padding: const EdgeInsets.fromLTRB(5, 0, 5, 20),
            physics: const NeverScrollableScrollPhysics(),
            shrinkWrap: true,
            gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
              crossAxisCount: 3,
              crossAxisSpacing: 10,
              mainAxisSpacing: 10,
            ),
            itemCount: serviceList.length,
            itemBuilder: (context, index) => serviceList[index].last
                ? noneList(context)
                : serviceGridList(context, serviceList[index]),
          ),
        ],
      ),
    );
  }
}

// show when no service list
Widget noneList(context) {
  return Text(
    'None',
    style: Theme.of(context).textTheme.bodyLarge,
  );
}

// service list detail layout
Widget serviceGridList(BuildContext context, Service service) {
  return GestureDetector(
    onTap: () => Navigator.push(
      context,
      MaterialPageRoute(
        builder: (context) =>
            BookingService(svg: service.svg, title: service.title),
      ),
    ),
    child: Container(
      decoration: BoxDecoration(
        color: Theme.of(context).primaryColorLight,
        boxShadow: const [boxShadow],
        borderRadius: const BorderRadius.all(Radius.circular(15)),
      ),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        crossAxisAlignment: CrossAxisAlignment.center,
        children: [
          service.svg,
          const SizedBox(height: 10),
          Text(
            service.title,
            style: Theme.of(context).textTheme.bodySmall,
          ),
        ],
      ),
    ),
  );
}
