import 'dart:async';

import 'package:flutter/material.dart';
import 'package:flutter_barcode_scanner/flutter_barcode_scanner.dart';
import '../../widgets/bottom_navigation.dart';
import '../../widgets/custom_scaffold.dart';
import '../../routes/route.dart';

class Search extends StatefulWidget {
  const Search({super.key});

  @override
  State<Search> createState() => _SearchState();
}

class _SearchState extends State<Search> {
  final _formKey = GlobalKey<FormState>();
  String barcodeId = '';
  String keyword = '';

  Future<void> scanBarcode() async {
    String barcodeScanRes = await FlutterBarcodeScanner.scanBarcode(
        '#ff6666', 'Cancel', true, ScanMode.BARCODE);
    // String barcodeScanRes = '9555247209941';

    if (barcodeScanRes != '-1') {
      Navigator.of(context)
          .pushNamed(RouteList.searchBarcodeResult, arguments: barcodeScanRes);
      // setState(() {
      //   barcodeId = barcodeScanRes;
      // });
    } else {
      AlertDialog(
        title: const Text('Scan Canceled'),
        content: SingleChildScrollView(
          child: ListBody(
            children: const <Widget>[
              Text('Barcode scanning was canceled.'),
            ],
          ),
        ),
      );
    }
  }

  void formSubmit() {
    if (_formKey.currentState!.validate()) {
      _formKey.currentState!.save();

      Navigator.of(context)
          .pushNamed(RouteList.searchResult, arguments: keyword);
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        leading: IconButton(
          onPressed: () {
            Navigator.of(context).pushReplacementNamed(RouteList.dashboard);
          },
          icon: const Icon(Icons.arrow_back_ios_rounded, color: Colors.black),
        ),
        title: const Text(
          'Search',
          style: TextStyle(
            fontSize: 20,
            color: Colors.black,
            fontWeight: FontWeight.bold,
          ),
        ),
        backgroundColor: Colors.white,
      ),
      body: Column(
        // mainAxisAlignment: MainAxisAlignment.center,
        children: [
          const SizedBox(height: 40),
          const Text('Enter item name or barcode ID to search.'),
          const SizedBox(height: 20),
          // search text field
          Form(
            key: _formKey,
            child: SizedBox(
              width: 300,
              child: TextFormField(
                decoration: const InputDecoration(
                  border: OutlineInputBorder(),
                  labelText: 'Search',
                ),
                onSaved: (newValue) {
                  keyword = newValue!;
                },
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter keyword';
                  }
                  return null;
                },
              ),
            ),
          ),
          const SizedBox(height: 20),
          ElevatedButton(
            onPressed: () {
              formSubmit();
            },
            child: const Text('Search'),
          ),
          const SizedBox(height: 20),
          Stack(
            alignment: Alignment.center,
            children: [
              const Divider(
                color: Colors.grey,
                thickness: 1,
                indent: 20,
                endIndent: 20,
              ),
              Container(
                color: Colors
                    .white, // Change this color to match the background color
                padding: const EdgeInsets.symmetric(horizontal: 8),
                child: const Text(
                  'Other',
                  style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
                ),
              ),
            ],
          ),
          const SizedBox(height: 20),
          const Text('Scan barcode to search.'),
          const SizedBox(height: 30),

          ElevatedButton(
            onPressed: scanBarcode,
            child: const Icon(
              Icons.qr_code_scanner,
              size: 60,
            ),
          ),
          const SizedBox(height: 20),
          // Text(
          //   // barcode length is 13
          //   'Barcode ID: $barcodeId',
          //   style: const TextStyle(fontSize: 18),
          // ),
        ],
      ),
      // bottomNavigationBar: const BottomNavigation(currentIndex: 3),
    );
  }
}
