import 'dart:convert';
import 'dart:math';

import 'package:flutter/material.dart';
import '../../routes/route.dart';
import '../../providers/api.dart';

class ChangePasswordPage extends StatefulWidget {
  const ChangePasswordPage({super.key});

  @override
  _ChangePasswordPageState createState() => _ChangePasswordPageState();
}

class _ChangePasswordPageState extends State<ChangePasswordPage> {
  final _formKey = GlobalKey<FormState>();
  bool _isObscure = true;
  final TextEditingController _currentPasswordController =
      TextEditingController();
  final TextEditingController _newPasswordController = TextEditingController();
  final TextEditingController _confirmPasswordController =
      TextEditingController();

  String _errorMessage = "";

  void _changePassword() async {
    if (_formKey.currentState!.validate()) {
      _formKey.currentState!.save();
      String currentPassword = _currentPasswordController.text;
      String newPassword = _newPasswordController.text;
      String confirmPassword = _confirmPasswordController.text;

      if (newPassword != confirmPassword) {
        setState(() {
          _errorMessage = "New password and confirm password do not match.";
        });
      } else {
        String response = await updatePassword(currentPassword, newPassword);
        dynamic jsonResponse = jsonDecode(response);

        if (jsonResponse['status'] == 705) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              backgroundColor: Theme.of(context).secondaryHeaderColor,
              duration: const Duration(seconds: 2),
              content: Container(
                padding: const EdgeInsets.all(8),
                child: const Text(
                  'Password Updated Successfully',
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 18,
                  ),
                ),
              ),
            ),
          );
          Future.delayed(const Duration(seconds: 3), () {
            Navigator.of(context).pushReplacementNamed(RouteList.account);
          });
        } else if (jsonResponse['status'] == 706) {
          setState(() {
            _errorMessage = jsonResponse['message'];
          });
        } else {
          setState(() {
            _errorMessage = "Something went wrong. Please try again later.";
          });
        }
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Change Password"),
        leading: IconButton(
          onPressed: () {
            Navigator.of(context).pushReplacementNamed(RouteList.account);
          },
          icon: const Icon(Icons.arrow_back_ios_rounded, color: Colors.white),
        ),
      ),
      body: Form(
        key: _formKey,
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              TextFormField(
                controller: _currentPasswordController,
                obscureText: _isObscure,
                decoration: const InputDecoration(
                  border: OutlineInputBorder(),
                  labelText: 'Current Password',
                ),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter old password';
                  }
                  return null;
                },
                onEditingComplete: () {
                  print(_currentPasswordController.text);
                  print('editing complete');
                },
              ),
              const SizedBox(height: 16.0),
              TextFormField(
                controller: _newPasswordController,
                obscureText: _isObscure,
                decoration: const InputDecoration(
                  border: OutlineInputBorder(),
                  labelText: 'New Password',
                ),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter new password';
                  }
                  return null;
                },
              ),
              const SizedBox(height: 16.0),
              TextFormField(
                controller: _confirmPasswordController,
                obscureText: _isObscure,
                decoration: const InputDecoration(
                  border: OutlineInputBorder(),
                  labelText: 'Confirm Password',
                ),
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return 'Please enter password';
                  }
                  return null;
                },
              ),
              const SizedBox(height: 16.0),
              Text(
                _errorMessage,
                style: const TextStyle(color: Colors.red),
              ),
              const SizedBox(height: 16.0),
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                children: [
                  ElevatedButton(
                    onPressed: () {
                      Navigator.of(context)
                          .pushReplacementNamed(RouteList.account);
                    },
                    child: const Text("Cancel"),
                  ),
                  ElevatedButton(
                    onPressed: () {
                      setState(() {
                        _isObscure = !_isObscure;
                      });
                    },
                    child: Icon(
                      _isObscure ? Icons.visibility : Icons.visibility_off,
                      color: Colors.white,
                    ),
                  ),
                  ElevatedButton(
                    onPressed: _changePassword,
                    child: const Text("Change Password"),
                  ),
                ],
              )
            ],
          ),
        ),
      ),
    );
  }
}
