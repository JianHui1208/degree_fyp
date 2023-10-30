import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';

import '../../common/theme.dart';
import '../../gen/assets.gen.dart';
import '../../routes/route.dart';
import '../../widgets/bottom_navigation.dart';
import '../../widgets/custom_scaffold.dart';

class BookingList extends StatefulWidget {
  const BookingList({super.key});

  @override
  State<BookingList> createState() => _BookingListState();
}

class _BookingListState extends State<BookingList> {
  // for Text 'Upcoming and Passed' use
  List<bool> isSelected = [true, false];
  // sample data show my booking list
  List<DataSample> data = [
    DataSample(
        '28.04.2023',
        'Car Wash',
        '12:00pm',
        'PTD 64888, Jalan Selatan Utama, KM 15, Off, Skudai Lbh, 81300 Skudai, Johor',
        '03'),
    DataSample(
        '28.04.2023',
        'Polishing',
        '14:00pm',
        'PTD 64888, Jalan Selatan Utama, KM 15, Off, Skudai Lbh, 81300 Skudai, Johor',
        '13'),
    DataSample(
        '28.05.2023',
        'Polishing',
        '15:00pm',
        'PTD 64888, Jalan Selatan Utama, KM 15, Off, Skudai Lbh, 81300 Skudai, Johor',
        '23'),
  ];

  @override
  Widget build(BuildContext context) {
    return ScaffoldCustom(
      leadingButton: false,
      text: 'Notification',
      bottomNavigationBar: const BottomNavigation(currentIndex: 2),
      body: SingleChildScrollView(
        physics: const BouncingScrollPhysics(),
        child: Column(
          children: [
            Container(
              margin: const EdgeInsets.symmetric(vertical: 30, horizontal: 20),
              child: Center(
                child: Container(
                  height: 45,
                  decoration: BoxDecoration(
                    color: Theme.of(context).primaryColorLight,
                    borderRadius: BorderRadius.circular(10),
                    boxShadow: const [boxShadow],
                  ),
                  child: ToggleButtons(
                      disabledColor: Theme.of(context).disabledColor,
                      isSelected: isSelected,
                      selectedColor: Theme.of(context).primaryColorLight,
                      fillColor: Theme.of(context).hintColor,
                      borderRadius: BorderRadius.circular(10),
                      textStyle: const TextStyle(fontWeight: FontWeight.w600),
                      children: const [
                        Padding(
                          padding: EdgeInsets.symmetric(horizontal: 30),
                          child: Text(
                            'Upcoming',
                            style: TextStyle(fontSize: 18),
                          ),
                        ),
                        Padding(
                          padding: EdgeInsets.symmetric(horizontal: 30),
                          child: Text(
                            'Passed',
                            style: TextStyle(fontSize: 18),
                          ),
                        )
                      ],
                      // when button selected show different backgroundcolor
                      onPressed: (int index) {
                        setState(() {
                          for (int i = 0; i < isSelected.length; i++) {
                            if (i == index) {
                              isSelected[i] = true;
                            } else {
                              isSelected[i] = false;
                            }
                          }
                        });
                      }),
                ),
              ),
            ),
            // use listview builder generate 3 sample booking list
            ListView.builder(
              shrinkWrap: true,
              physics: const NeverScrollableScrollPhysics(),
              itemCount: data.length,
              itemBuilder: (itemBuilder, index) {
                return sampleBooking(data[index]);
              },
            )
          ],
        ),
      ),
    );
  }

  // booking list detail layout
  Widget sampleBooking(DataSample data) {
    return Container(
      margin: const EdgeInsets.all(20),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            margin: const EdgeInsets.only(bottom: 10),
            child: Text(
              data.date,
              style: Theme.of(context).textTheme.headlineSmall,
            ),
          ),
          InkWell(
            // after click show booking detail screen
            onTap: () {
              Navigator.of(context).pushNamed(RouteList.bookingDetail);
            },
            child: Container(
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(15),
                color: Theme.of(context).dialogBackgroundColor,
                border:
                    Border.all(color: Theme.of(context).hintColor, width: 3),
              ),
              padding: const EdgeInsets.all(15.0),
              child: Column(
                children: [
                  Row(
                    children: [
                      Padding(
                        padding: const EdgeInsets.only(right: 13),
                        child: CircleAvatar(
                          backgroundColor: Theme.of(context).primaryColorLight,
                          child: SvgPicture.asset(
                            Assets.svg.service.carwash,
                          ),
                        ),
                      ),
                      Expanded(
                        child: Text(data.title,
                            style: Theme.of(context).textTheme.titleMedium),
                      ),
                      Column(
                        children: [
                          Row(children: [
                            Text(data.leftTime,
                                style: Theme.of(context).textTheme.titleMedium),
                            Text(
                              ' Day Left',
                              style: Theme.of(context).textTheme.labelSmall,
                            ),
                          ]),
                          Text(
                            data.date,
                            style: Theme.of(context).textTheme.labelSmall,
                          ),
                        ],
                      ),
                    ],
                  ),
                  Padding(
                    padding: const EdgeInsets.fromLTRB(5, 17, 5, 5),
                    child: Row(
                      children: [
                        Padding(
                          padding: const EdgeInsets.only(right: 10),
                          child: Icon(
                            Icons.access_time_filled,
                            color: Theme.of(context).iconTheme.color,
                            size: 20,
                          ),
                        ),
                        Text(
                          data.time,
                          style: Theme.of(context).textTheme.titleMedium,
                        ),
                      ],
                    ),
                  ),
                  Container(
                    padding: const EdgeInsets.all(5.0),
                    child: Row(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Padding(
                          padding: const EdgeInsets.only(right: 10),
                          child: Icon(
                            Icons.location_pin,
                            color: Theme.of(context).iconTheme.color,
                            size: 20,
                          ),
                        ),
                        Expanded(
                          child: Text(
                            data.location,
                            style: Theme.of(context).textTheme.titleMedium,
                          ),
                        ),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}

class DataSample {
  final String date;
  final String title;
  final String time;
  final String location;
  final String leftTime;

  DataSample(
    this.date,
    this.title,
    this.time,
    this.location,
    this.leftTime,
  );
}
