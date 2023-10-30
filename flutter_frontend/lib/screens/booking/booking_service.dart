import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';

import '../../models/service_type.dart';
import '../../widgets/custom_divider.dart';
import 'booking_form.dart';

class BookingService extends StatefulWidget {
  final SvgPicture svg;
  final String title;

  const BookingService({
    required this.svg,
    required this.title,
    super.key,
  });

  @override
  State<BookingService> createState() => BookingServiceState();
}

class BookingServiceState extends State<BookingService> {
  // call service type in models folder
  final serviceType = ServiceType.genereateServiceType();
  int activeButton = 1;
  int onSelectedIndex = -1;
  late bool onSelected;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        backgroundColor: Theme.of(context).primaryColorDark,
        body: CustomScrollView(
          slivers: [
            topHeader(context),
            SliverToBoxAdapter(
              child: Container(
                padding:
                    const EdgeInsets.symmetric(horizontal: 20, vertical: 10),
                decoration: BoxDecoration(
                  color: Theme.of(context).primaryColorLight,
                  borderRadius: const BorderRadius.only(
                    topLeft: Radius.circular(25),
                    topRight: Radius.circular(25),
                  ),
                ),
                child: Padding(
                  padding: const EdgeInsets.symmetric(vertical: 20),
                  child: Column(
                    children: [
                      serviceOption(),
                      const SizedBox(height: 15),
                      bookingTitle(),
                      const BookingForm(),
                    ],
                  ),
                ),
              ),
            )
          ],
        ));
  }

  Widget topHeader(BuildContext context) {
    return SliverAppBar(
      expandedHeight: 170,
      backgroundColor: Theme.of(context).primaryColorDark,
      leading: IconButton(
        onPressed: () {
          Navigator.of(context).pop();
        },
        icon: const Icon(Icons.keyboard_arrow_left),
      ),
      flexibleSpace: FlexibleSpaceBar(
        centerTitle: true,
        title: Column(
          crossAxisAlignment: CrossAxisAlignment.center,
          mainAxisAlignment: MainAxisAlignment.end,
          children: [
            widget.svg,
            const SizedBox(height: 10),
            Text(
              widget.title,
              style: Theme.of(context).textTheme.titleMedium,
            ),
          ],
        ),
      ),
    );
  }

  Widget serviceOption() {
    return Column(
      children: [
        Row(
          children: [
            const Expanded(
              flex: 2,
              child: CustomDivider(),
            ),
            Expanded(
              flex: 4,
              child: Center(
                child: Text(
                  'Service Type',
                  style: Theme.of(context).textTheme.labelLarge,
                ),
              ),
            ),
            const Expanded(
              flex: 2,
              child: CustomDivider(),
            ),
          ],
        ),
        Container(
          margin: const EdgeInsets.symmetric(vertical: 15),
          height: 40,
          child: ListView(
            scrollDirection: Axis.horizontal,
            // array list generate 3 service type button
            children: List.generate(
              serviceType.length,
              (index) => Container(
                padding: const EdgeInsets.only(right: 15),
                child: TextButton(
                  style: TextButton.styleFrom(
                      // when onselect change button color
                      backgroundColor: (onSelected = onSelectedIndex == index)
                          ? Theme.of(context).primaryColor
                          : Theme.of(context).dialogBackgroundColor),
                  onPressed: () {
                    setState(() => onSelectedIndex = index);
                  },
                  child: Text(
                    serviceType[index].title,
                    style: Theme.of(context).textTheme.titleMedium,
                  ),
                ),
              ),
            ),
          ),
        ),
      ],
    );
  }

  Widget bookingTitle() {
    return Row(
      children: [
        const Expanded(
          flex: 2,
          child: CustomDivider(),
        ),
        Expanded(
          flex: 2,
          child: Center(
            child: Text(
              'Booking',
              style: Theme.of(context).textTheme.labelLarge,
            ),
          ),
        ),
        const Expanded(
          flex: 2,
          child: CustomDivider(),
        ),
      ],
    );
  }
}
