import 'package:flutter/material.dart';
import 'package:flutter_datetime_picker/flutter_datetime_picker.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:intl/intl.dart';

import '../../common/theme.dart';
import '../../models/location_model.dart';
import '../../routes/route.dart';
import '../../widgets/elevated_button.dart';

class BookingForm extends StatefulWidget {
  const BookingForm({super.key});

  @override
  State<BookingForm> createState() => BookingFormState();
}

class BookingFormState extends State<BookingForm> {
  String? value;
  int? index;
  // call location in models folder
  final location = Location.genereateLocation();

  late Map<String, dynamic> selectedCarType;
  late List<Map<String, dynamic>> carTypes;
  DateTime? _selectedDateTime;

  @override
  // to init first click show the car type
  void initState() {
    super.initState();
    carTypes = [
      {
        'title': 'Sedan',
        'price': 20,
        'icon': 'assets/svg/car_type/sedan.svg',
      },
      {
        'title': 'SUV',
        'price': 35,
        'icon': 'assets/svg/car_type/suv.svg',
      },
      {
        'title': 'MPV',
        'price': 40,
        'icon': 'assets/svg/car_type/mpv.svg',
      },
      {
        'title': 'Lorry',
        'price': 60,
        'icon': 'assets/svg/car_type/lorry.svg',
      },
    ];
    selectedCarType = carTypes[0];
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      height: 430,
      padding: const EdgeInsets.symmetric(vertical: 10),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Padding(
            padding: const EdgeInsets.symmetric(vertical: 10),
            child: Text(
              'Location',
              style: Theme.of(context).textTheme.labelLarge,
            ),
          ),
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 10),
            decoration: boxDeco,
            child: DropdownButtonHideUnderline(
              child: DropdownButton(
                iconSize: 30,
                icon: const Icon(Icons.keyboard_arrow_down),
                value: value,
                isExpanded: true,
                onChanged: (value) => setState(() => this.value = value),
                items: List.generate(
                  location.length,
                  (index) {
                    return DropdownMenuItem(
                      value: location[index].title,
                      child: Text(
                        location[index].title,
                        style: Theme.of(context).textTheme.labelMedium,
                      ),
                    );
                  },
                ),
              ),
            ),
          ),
          Padding(
            padding: const EdgeInsets.symmetric(vertical: 10),
            child: Text(
              'Date Time',
              style: Theme.of(context).textTheme.labelLarge,
            ),
          ),
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 10),
            decoration: boxDeco,
            child: TextButton(
              child: Text(
                _selectedDateTime == null
                    ? 'Select a date and time'
                    : DateFormat('EEE, MMM d, yyyy hh:mm a')
                        .format(_selectedDateTime!),
                style: Theme.of(context).textTheme.bodyMedium,
              ),
              onPressed: () {
                DatePicker.showDateTimePicker(context,
                    showTitleActions: true,
                    minTime: DateTime(2023, 4, 18, 10, 00),
                    maxTime: DateTime(2023, 12, 31, 17, 30),
                    onChanged: (date) {}, onConfirm: (date) {
                  setState(() {
                    _selectedDateTime = date;
                  });
                });
              },
            ),
          ),
          Padding(
            padding: const EdgeInsets.symmetric(vertical: 10),
            child: Text(
              'Car Type',
              style: Theme.of(context).textTheme.labelLarge,
            ),
          ),
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 10),
            decoration: boxDeco,
            child: DropdownButtonHideUnderline(
              child: DropdownButton(
                iconSize: 30,
                icon: const Icon(Icons.keyboard_arrow_down),
                value: selectedCarType,
                isExpanded: true,
                onChanged: (value) => setState(() => selectedCarType = value!),
                items: carTypes
                    .map<DropdownMenuItem<Map<String, dynamic>>>((carType) {
                  return DropdownMenuItem(
                    value: carType,
                    child: Row(
                      children: [
                        SvgPicture.asset(
                          carType['icon'],
                          height: 20,
                          width: 20,
                        ),
                        const SizedBox(width: 10),
                        Text(
                          carType['title'],
                          style: Theme.of(context).textTheme.labelMedium,
                        ),
                      ],
                    ),
                  );
                }).toList(),
              ),
            ),
          ),
          if (selectedCarType != null) ...[
            const SizedBox(height: 10),
            Text(
              'Price: RM ${NumberFormat('#,###').format(selectedCarType['price'])}',
              style: Theme.of(context).textTheme.labelLarge,
            ),
            const SizedBox(height: 10),
            Text(
              'Selected Car Type: ${selectedCarType['title']}',
              style: Theme.of(context).textTheme.labelLarge,
            ),
          ],
          Expanded(
            child: Align(
              alignment: Alignment.bottomCenter,
              child: ElevatedBtn(
                onPressed: () {
                  Navigator.of(context).pushNamed(RouteList.booking);
                },
                btnText: 'Booking Now',
              ),
            ),
          ),
        ],
      ),
    );
  }
}
