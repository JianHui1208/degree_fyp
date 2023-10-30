import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:flutter_svg/svg.dart';
import '../../routes/route.dart';
import '../../models/supplier_model.dart';
import 'dart:convert';

class SupplierList extends StatefulWidget {
  const SupplierList({Key? key}) : super(key: key);

  @override
  State<SupplierList> createState() => _SupplierListState();
}

class _SupplierListState extends State<SupplierList> {
  @override
  Widget build(BuildContext context) {
    List<dynamic> jsonData = json.decode(supplierListJson);
    List<Supplier> suppliers =
        jsonData.map((json) => Supplier.fromJson(json)).toList();

    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        centerTitle: true,
        title: Text(
          'Supplier List',
          style: Theme.of(context).textTheme.bodyLarge,
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.of(context).pushReplacementNamed(RouteList.account);
          },
          icon: const Icon(Icons.arrow_back_ios_rounded, color: Colors.black),
        ),
      ),
      body: Container(
        // color: Theme.of(context).scaffoldBackgroundColor,
        padding: const EdgeInsets.only(top: 18, left: 18, right: 18),
        child: SizedBox(
          // height: 500, // Adjust this height as needed
          child: ListView.builder(
            itemCount: suppliers.length,
            itemBuilder: (BuildContext context, int index) {
              Supplier person = suppliers[index];
              return Container(
                margin: const EdgeInsets.only(bottom: 10),
                child: Column(
                  children: [
                    Card(
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(20),
                      ),
                      margin: const EdgeInsets.symmetric(
                          horizontal: 16, vertical: 10),
                      elevation: 4,
                      child: ListTile(
                        contentPadding: const EdgeInsets.all(16),
                        title: Text(
                          person.name,
                          style: const TextStyle(
                            fontWeight: FontWeight.bold,
                            fontSize: 18,
                          ),
                        ),
                        subtitle: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            const SizedBox(height: 8),
                            Text('Person in charge: ${person.p_i_c}'),
                            Text('Email: ${person.email}'),
                          ],
                        ),
                      ),
                    ),
                    suppliers.length - 1 == index
                        ? Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: const [
                              SizedBox(height: 20),
                              Text('End of list'),
                              SizedBox(height: 20),
                            ],
                          )
                        : Container(),
                  ],
                ),
              );
            },
          ),
        ),
      ),
    );
  }
}
