import 'package:flutter/material.dart';

class QuantityDialog extends StatefulWidget {
  final int currentAddQuantity;
  final int oldQuantity;
  final int newQuantity;

  const QuantityDialog({
    super.key,
    required this.currentAddQuantity,
    required this.oldQuantity,
    required this.newQuantity,
  });

  @override
  _QuantityDialogState createState() => _QuantityDialogState();
}

class _QuantityDialogState extends State<QuantityDialog> {
  late int _quantity;
  final TextEditingController _quantityController = TextEditingController();

  @override
  void initState() {
    super.initState();
    _quantity = widget.currentAddQuantity;
    _quantityController.text = '$_quantity';
  }

  @override
  void dispose() {
    _quantityController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: const Text('Select Quantity'),
      content: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              TextButton(
                style: ButtonStyle(
                  shape: MaterialStateProperty.all<RoundedRectangleBorder>(
                    RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(18.0),
                      side: const BorderSide(color: Colors.black),
                    ),
                  ),
                ),
                child: const Icon(Icons.remove),
                onPressed: () {
                  setState(() {
                    if (_quantity > 1) {
                      _quantity--;
                      _quantityController.text = '$_quantity';
                    }
                  });
                },
              ),
              const SizedBox(width: 30),
              SizedBox(
                width: 60,
                child: TextField(
                  decoration: const InputDecoration(
                    // remove the border
                    border: InputBorder.none,
                  ),
                  textAlign: TextAlign.center,
                  controller: _quantityController,
                  keyboardType: TextInputType.number,
                  onChanged: (value) {
                    setState(() {
                      _quantity = int.parse(value);
                    });
                  },
                ),
              ),
              const SizedBox(width: 30),
              TextButton(
                style: ButtonStyle(
                  shape: MaterialStateProperty.all<RoundedRectangleBorder>(
                    RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(18.0),
                      side: const BorderSide(color: Colors.black),
                    ),
                  ),
                ),
                child: const Icon(Icons.add),
                onPressed: () {
                  setState(() {
                    _quantity++;
                    _quantityController.text = '$_quantity';
                  });
                },
              ),
            ],
          ),
          const SizedBox(height: 10),
          Text(
            '${widget.oldQuantity} -> ${widget.newQuantity}',
            style: const TextStyle(fontWeight: FontWeight.bold),
          ),
        ],
      ),
      actions: [
        TextButton(
          onPressed: () {
            Navigator.of(context).pop(_quantity);
          },
          child: const Text('OK'),
        ),
        TextButton(
          onPressed: () {
            Navigator.of(context).pop();
          },
          child: const Text('Cancel'),
        ),
      ],
    );
  }
}
