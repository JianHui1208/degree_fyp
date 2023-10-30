import 'package:flutter/material.dart';

import '../../common/theme.dart';
import '../../gen/assets.gen.dart';
import '../../widgets/custom_divider.dart';
import '../../widgets/custom_scaffold.dart';

class BookingDetail extends StatefulWidget {
  const BookingDetail({super.key});

  @override
  State<BookingDetail> createState() => _BookingDetailState();
}

class _BookingDetailState extends State<BookingDetail> {
  @override
  Widget build(BuildContext context) {
    return ScaffoldCustom(
      text: 'Booking Detail',
      body: SingleChildScrollView(
        physics: const BouncingScrollPhysics(),
        child: Container(
          margin: const EdgeInsets.all(20),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text(
                    "Booking ID: B0001",
                    style: Theme.of(context).textTheme.bodyMedium,
                  ),
                  Container(
                    padding:
                        const EdgeInsets.symmetric(vertical: 5, horizontal: 25),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(8),
                      color: Theme.of(context).hintColor,
                    ),
                    child: Text(
                      'Pending',
                      style: Theme.of(context).textTheme.titleMedium,
                    ),
                  )
                ],
              ),
              Container(
                width: 500,
                padding: const EdgeInsets.all(15),
                margin: const EdgeInsets.only(top: 15),
                decoration: BoxDecoration(
                    color: Theme.of(context).dialogBackgroundColor,
                    borderRadius: BorderRadius.circular(12),
                    boxShadow: [
                      BoxShadow(
                        color: Theme.of(context).shadowColor,
                        spreadRadius: 1,
                        blurRadius: 8,
                      ),
                    ]),
                child: Column(
                  children: [
                    // first table show service type, date, time and location
                    detailFirstPart(),
                  ],
                ),
              ),
              ContainerBoxShadow(
                children: [
                  Text(
                    'Vehicle Detail',
                    style: Theme.of(context).textTheme.labelLarge,
                  ),
                  const CustomDivider(),
                  // second table show vehicle detail: car plate, brand, model, color
                  detailSecondTable(),
                ],
              ),
              ContainerBoxShadow(
                children: [
                  Text(
                    'SUC Service',
                    style: Theme.of(context).textTheme.labelLarge,
                  ),
                  const CustomDivider(),
                  ClipRRect(
                    borderRadius: BorderRadius.circular(20),
                    child: Assets.images.southern.image(),
                  ),
                  const SizedBox(height: 15),
                  detailWorkingTime(),
                  const CustomDivider(),
                  // table show payment status
                  detailPayment(),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget detailFirstPart() {
    return Table(
      defaultVerticalAlignment: TableCellVerticalAlignment.middle,
      columnWidths: const {
        0: FlexColumnWidth(1),
        1: FlexColumnWidth(2),
        2: FlexColumnWidth(1),
        3: FlexColumnWidth(3),
      },
      children: <TableRow>[
        TableRow(
          children: <Widget>[
            Icon(Icons.directions_car_filled,
                color: Theme.of(context).iconTheme.color),
            Text('Service Type', style: Theme.of(context).textTheme.titleSmall),
            Text(':', style: Theme.of(context).textTheme.titleSmall),
            Text('Car Wash', style: Theme.of(context).textTheme.bodySmall),
          ],
        ),
        TableRow(
          children: <Widget>[
            Icon(Icons.calendar_month,
                color: Theme.of(context).iconTheme.color),
            Text('Date', style: Theme.of(context).textTheme.titleSmall),
            Text(':', style: Theme.of(context).textTheme.titleSmall),
            Text('20 May 2023', style: Theme.of(context).textTheme.bodySmall),
          ],
        ),
        TableRow(
          children: <Widget>[
            Icon(Icons.access_time_filled,
                color: Theme.of(context).iconTheme.color),
            Text('Time', style: Theme.of(context).textTheme.titleSmall),
            Text(':', style: Theme.of(context).textTheme.titleSmall),
            Text('12:00pm', style: Theme.of(context).textTheme.bodySmall),
          ],
        ),
        TableRow(
          children: <Widget>[
            Icon(
              Icons.location_pin,
              color: Theme.of(context).iconTheme.color,
              size: 20,
            ),
            Text('Location', style: Theme.of(context).textTheme.titleSmall),
            Text(':', style: Theme.of(context).textTheme.titleSmall),
            Text(
                'PTD 64888, Jalan Selatan Utama, KM 15, Off, Skudai Lbh, 81300 Skudai, Johor',
                style: Theme.of(context).textTheme.bodySmall)
          ],
        ),
      ],
    );
  }

  Widget detailSecondTable() {
    return Table(
      defaultVerticalAlignment: TableCellVerticalAlignment.middle,
      columnWidths: const {
        0: FlexColumnWidth(3),
        1: FlexColumnWidth(1),
        2: FlexColumnWidth(3),
      },
      children: <TableRow>[
        TableRow(
          children: <Widget>[
            Text('Vehicle Number',
                style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Text('JVR 668', style: Theme.of(context).textTheme.labelMedium),
          ],
        ),
        TableRow(
          children: <Widget>[
            Text('Brand', style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Text('Porsche', style: Theme.of(context).textTheme.labelMedium),
          ],
        ),
        TableRow(
          children: <Widget>[
            Text('Model', style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Text('Panamera', style: Theme.of(context).textTheme.labelMedium),
          ],
        ),
        TableRow(
          children: <Widget>[
            Text('Color', style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Text('White', style: Theme.of(context).textTheme.labelMedium),
          ],
        ),
      ],
    );
  }

  Widget detailWorkingTime() {
    return Table(
      defaultVerticalAlignment: TableCellVerticalAlignment.middle,
      columnWidths: const {
        0: FlexColumnWidth(3),
        1: FlexColumnWidth(1),
        2: FlexColumnWidth(3),
      },
      children: <TableRow>[
        TableRow(
          children: <Widget>[
            Text('Working Time',
                style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  'Monday - Friday',
                  style: Theme.of(context).textTheme.labelMedium,
                ),
                Text(
                  '10:00am -07:00pm',
                  style: Theme.of(context).textTheme.labelMedium,
                ),
              ],
            ),
          ],
        ),
      ],
    );
  }

  Widget detailPayment() {
    return Table(
      defaultVerticalAlignment: TableCellVerticalAlignment.middle,
      columnWidths: const {
        0: FlexColumnWidth(3),
        1: FlexColumnWidth(1),
        2: FlexColumnWidth(3),
      },
      children: <TableRow>[
        TableRow(
          children: <Widget>[
            Text('Payment Type',
                style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Text('Walk in payment',
                style: Theme.of(context).textTheme.labelMedium),
          ],
        ),
        TableRow(
          children: <Widget>[
            Text('Service Fees',
                style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Text('RM 50', style: Theme.of(context).textTheme.labelMedium),
          ],
        ),
        TableRow(
          children: <Widget>[
            Text('PaymentStatus',
                style: Theme.of(context).textTheme.labelMedium),
            const Text(':'),
            Text(
              'Unpaid',
              style: Theme.of(context).textTheme.labelMedium?.copyWith(
                    color: const Color(0xFFFF4154),
                    fontWeight: FontWeight.w600,
                  ),
            ),
          ],
        ),
      ],
    );
  }
}

class ContainerBoxShadow extends StatelessWidget {
  final List<Widget> children;

  const ContainerBoxShadow({
    required this.children,
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(15),
      margin: const EdgeInsets.only(top: 20),
      decoration: BoxDecoration(
        color: Theme.of(context).primaryColorLight,
        borderRadius: BorderRadius.circular(12),
        boxShadow: const [boxShadow],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: children,
      ),
    );
  }
}
