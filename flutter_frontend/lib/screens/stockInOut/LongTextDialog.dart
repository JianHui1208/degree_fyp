import 'package:flutter/material.dart';

class LongTextDialog extends StatefulWidget {
  final String? initialDescription;

  const LongTextDialog({super.key, this.initialDescription});

  @override
  _LongTextDialogState createState() => _LongTextDialogState();
}

class _LongTextDialogState extends State<LongTextDialog> {
  final TextEditingController _textEditingController = TextEditingController();

  @override
  void initState() {
    super.initState();
    // Prepopulate the TextField with the initial description (if available).
    _textEditingController.text = widget.initialDescription ?? '';
  }

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: const Text('Enter Description'),
      content: TextField(
        controller: _textEditingController,
        maxLines: null,
        decoration: const InputDecoration(hintText: 'Description...'),
      ),
      actions: <Widget>[
        TextButton(
          child: const Text('Cancel'),
          onPressed: () => Navigator.of(context).pop(null),
        ),
        TextButton(
          child: const Text('Save'),
          onPressed: () {
            String description = _textEditingController.text;
            Navigator.of(context).pop(description);
          },
        ),
      ],
    );
  }
}
