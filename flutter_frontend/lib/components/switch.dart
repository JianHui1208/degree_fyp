import 'package:flutter/material.dart';

class SwitchApp extends StatelessWidget {
  final bool comeInValue;
  const SwitchApp({super.key, required this.comeInValue});

  @override
  Widget build(BuildContext context) {
    return Center(
      child: SwitchExample(
        initialValue: comeInValue,
      ),
    );
  }
}

class SwitchExample extends StatefulWidget {
  final bool initialValue;
  const SwitchExample({super.key, required this.initialValue});

  @override
  State<SwitchExample> createState() => _SwitchExampleState();
}

class _SwitchExampleState extends State<SwitchExample> {
  late bool light1;

  @override
  void initState() {
    super.initState();
    light1 = widget.initialValue; // Set the initial value of the switch
  }

  final MaterialStateProperty<Icon?> thumbIcon =
      MaterialStateProperty.resolveWith<Icon?>(
    (Set<MaterialState> states) {
      if (states.contains(MaterialState.selected)) {
        return const Icon(Icons.check);
      }
      return const Icon(Icons.close);
    },
  );

  @override
  Widget build(BuildContext context) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.center,
      children: <Widget>[
        Switch(
          thumbIcon: thumbIcon,
          value: light1,
          onChanged: (bool value) {
            setState(() {
              light1 = value;
            });
          },
        ),
      ],
    );
  }
}
