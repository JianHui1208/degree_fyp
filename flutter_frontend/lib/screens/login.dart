import 'dart:convert';
import 'package:flutter/material.dart';
import '../../routes/route.dart';
import '../providers/auth.dart';

class Login extends StatefulWidget {
  const Login({super.key});

  @override
  State<Login> createState() => _LoginState();
}

class _LoginState extends State<Login> {
  final _formKey = GlobalKey<FormState>();
  bool _isObscure = true;
  bool isError = false;
  bool isLoading = true;

  @override
  Widget build(BuildContext context) {
    String? email;
    String? passwords;

    void conditionLogin(context) async {
      if (_formKey.currentState!.validate()) {
        isLoading = false;
        _formKey.currentState?.save();

        String response = await fetchUserData(email, passwords);
        dynamic jsonResult = jsonDecode(response);

        if (jsonResult['status'] == 702) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              backgroundColor: Theme.of(context).secondaryHeaderColor,
              duration: const Duration(seconds: 2),
              content: Container(
                padding: const EdgeInsets.all(8),
                child: const Text(
                  'Login Successfully',
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 18,
                  ),
                ),
              ),
            ),
          );
          Future.delayed(const Duration(seconds: 3), () {
            Navigator.of(context).pushReplacementNamed(RouteList.dashboard);
          });
        } else if (jsonResult['status'] == 701) {
          setState(() {
            isLoading = true;
          });
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              backgroundColor: Theme.of(context).primaryColor,
              duration: const Duration(seconds: 2),
              content: Container(
                padding: const EdgeInsets.all(8),
                child: const Text(
                  'User not found',
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 18,
                  ),
                ),
              ),
            ),
          );
        } else if (jsonResult['status'] == 703) {
          setState(() {
            isLoading = true;
          });
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              backgroundColor: Theme.of(context).primaryColor,
              duration: const Duration(seconds: 2),
              content: Container(
                padding: const EdgeInsets.all(8),
                child: const Text(
                  'Username or Password is incorrect',
                  style: TextStyle(
                    color: Colors.white,
                    fontSize: 18,
                  ),
                ),
              ),
            ),
          );
        } else {
          setState(() {
            isLoading = true;
          });
          await showDialog(
            context: context,
            builder: (BuildContext context) {
              return AlertDialog(
                title: const Text(
                  'Login Error',
                  style: TextStyle(
                    fontSize: 20,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                content: const Text(
                  'There was a problem with the System. Please try again later.',
                ),
                actions: <Widget>[
                  TextButton(
                    child: const Text('OK'),
                    onPressed: () {
                      Navigator.of(context).pop();
                    },
                  ),
                ],
              );
            },
          );
        }
      }
    }

    return Scaffold(
      body: Container(
        decoration: BoxDecoration(
          color: Colors.red.withOpacity(0.1),
        ),
        child: SafeArea(
          child: Center(
            child: SingleChildScrollView(
              scrollDirection: Axis.vertical,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  const Text(
                    'Log In',
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                      fontSize: 40,
                    ),
                  ),
                  Text(
                    'Welcome Back',
                    style: TextStyle(
                      color: Colors.black.withOpacity(0.5),
                      fontWeight: FontWeight.w300,
                      // height: 1.5,
                      fontSize: 15,
                    ),
                  ),
                  const SizedBox(
                    height: 30,
                  ),
                  Container(
                    height: isError ? 280 : 235,
                    width: MediaQuery.of(context).size.width / 1.1,
                    decoration: BoxDecoration(
                      color: Colors.white.withOpacity(0.3),
                      borderRadius: BorderRadius.circular(20),
                    ),
                    child: Form(
                      key: _formKey,
                      child: Column(
                        children: [
                          Padding(
                            padding: const EdgeInsets.only(
                                left: 20, right: 20, bottom: 20, top: 20),
                            child: TextFormField(
                              keyboardType: TextInputType.emailAddress,
                              onSaved: (newValue) {
                                email = newValue;
                              },
                              decoration: const InputDecoration(
                                focusedBorder: UnderlineInputBorder(
                                  borderSide: BorderSide.none,
                                  borderRadius: BorderRadius.all(
                                    Radius.circular(10),
                                  ),
                                ),
                                enabledBorder: UnderlineInputBorder(
                                  borderSide: BorderSide.none,
                                  borderRadius: BorderRadius.all(
                                    Radius.circular(10),
                                  ),
                                ),
                                prefixIcon: Icon(
                                  Icons.person,
                                  color: Colors.purple,
                                ),
                                filled: true,
                                fillColor: Colors.white,
                                labelText: "Email or Username",
                                labelStyle: TextStyle(color: Colors.purple),
                              ),
                              validator: (value) {
                                if (value == null || value.isEmpty) {
                                  setState(() {
                                    isError = true;
                                  });
                                  return 'Please enter email';
                                }
                                return null;
                              },
                            ),
                          ),
                          Padding(
                            padding: const EdgeInsets.only(left: 20, right: 20),
                            child: TextFormField(
                              keyboardType: TextInputType.visiblePassword,
                              onSaved: (newValue) {
                                passwords = newValue;
                              },
                              obscuringCharacter: '*',
                              obscureText: _isObscure,
                              decoration: InputDecoration(
                                focusedBorder: const UnderlineInputBorder(
                                  borderSide: BorderSide.none,
                                  borderRadius: BorderRadius.all(
                                    Radius.circular(10),
                                  ),
                                ),
                                enabledBorder: const UnderlineInputBorder(
                                  borderSide: BorderSide.none,
                                  borderRadius: BorderRadius.all(
                                    Radius.circular(10),
                                  ),
                                ),
                                prefixIcon: const Icon(
                                  Icons.lock,
                                  color: Colors.purple,
                                ),
                                filled: true,
                                fillColor: Colors.white,
                                labelText: "Password",
                                labelStyle:
                                    const TextStyle(color: Colors.purple),
                                suffixIcon: IconButton(
                                  splashRadius: 20,
                                  icon: Icon(
                                    _isObscure
                                        ? Icons.visibility
                                        : Icons.visibility_off,
                                    color: Colors.purple,
                                  ),
                                  onPressed: () {
                                    setState(() {
                                      _isObscure = !_isObscure;
                                    });
                                  },
                                ),
                              ),
                              validator: (value) {
                                if (value == null || value.isEmpty) {
                                  setState(() {
                                    isError = true;
                                  });
                                  return 'Enter Password';
                                }
                                return null;
                              },
                            ),
                          ),
                          const SizedBox(height: 20),
                          Padding(
                            padding: const EdgeInsets.only(left: 20, right: 20),
                            child: ElevatedButton(
                              style: ElevatedButton.styleFrom(
                                shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(10.0),
                                ),
                                backgroundColor: Colors.purple,
                                padding: const EdgeInsets.symmetric(
                                  horizontal: 131,
                                  vertical: 20,
                                ),
                              ),
                              onPressed: () {
                                setState(() {
                                  isError = false;
                                });
                                // Navigator.of(context)
                                //     .pushReplacementNamed(RouteList.dashboard);

                                conditionLogin(context);
                              },
                              child: isLoading
                                  ? const Text(
                                      'Log In',
                                      style: TextStyle(fontSize: 17),
                                    )
                                  : const SizedBox(
                                      width: 20,
                                      height: 20,
                                      child: CircularProgressIndicator(
                                        strokeWidth: 2,
                                      ),
                                    ),
                            ),
                          )
                        ],
                      ),
                    ),
                  ),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Text(
                        'You have\'t any account?',
                        style: TextStyle(
                          color: Colors.black.withOpacity(0.6),
                        ),
                      ),
                      TextButton(
                        onPressed: () {},
                        child: const Text(
                          'Sign Up',
                          style: TextStyle(
                              color: Colors.purple,
                              fontWeight: FontWeight.w500),
                        ),
                      )
                    ],
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}
