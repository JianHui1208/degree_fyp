import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_svg/svg.dart';

import '../../routes/route.dart';
import '../gen/assets.gen.dart';
import '../providers/auth.dart';
import '../widgets/elevated_button.dart';
import '../widgets/wc_form_title.dart';

class Register extends StatefulWidget {
  const Register({super.key});

  @override
  State<Register> createState() => _RegisterState();
}

class _RegisterState extends State<Register> {
  final _formKey = GlobalKey<FormState>();
  bool _isObscure = true;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: PreferredSize(
        preferredSize: Size.fromHeight(
          MediaQuery.of(context).size.height / 4,
        ),
        child: const WCFormTitle(
          title: 'Register',
          descr: 'Welcome',
        ),
      ),
      body: SingleChildScrollView(
        child: Container(
          color: Theme.of(context).scaffoldBackgroundColor,
          child: Column(
            children: <Widget>[
              registerForm(),
            ],
          ),
        ),
      ),
    );
  }

  Widget registerForm() {
    String? name;
    String? email;
    String? phone;
    String? passwords;

    // register check validate form if correct show success else show show failed
    void conditionRegister(context) async {
      if (_formKey.currentState!.validate()) {
        _formKey.currentState?.save();

        Map<String, dynamic> formData = {
          'name': name,
          'username': name,
          'email': email,
          'phone_number': phone,
          'password': passwords,
          'is_active': 1,
        };
        String jsonData = json.encode(formData);
        bool isRegister = await registerUser(jsonData);

        if (isRegister) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              backgroundColor: Theme.of(context).secondaryHeaderColor,
              duration: const Duration(seconds: 2),
              content: Container(
                padding: const EdgeInsets.all(8),
                child: Text(
                  'Register Successfully',
                  style: Theme.of(context).textTheme.labelLarge,
                ),
              ),
            ),
          );
          Future.delayed(const Duration(seconds: 3), () {
            Navigator.of(context).pushReplacementNamed(RouteList.welcome);
          });
        } else {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(
              backgroundColor: Theme.of(context).hintColor,
              duration: const Duration(seconds: 2),
              content: Container(
                padding: const EdgeInsets.all(8),
                child: Text(
                  'Register Failed',
                  style: Theme.of(context).textTheme.titleMedium,
                ),
              ),
            ),
          );
        }
      }
    }

    return Container(
      padding: const EdgeInsets.fromLTRB(20, 40, 20, 20),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Form(
              key: _formKey,
              child: Column(
                children: [
                  TextFormField(
                    style: Theme.of(context).textTheme.bodyMedium,
                    decoration: InputDecoration(
                      border: const OutlineInputBorder(),
                      labelText: 'Name',
                      labelStyle: Theme.of(context).textTheme.labelLarge,
                    ),
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Enter Name';
                      }
                      return null;
                    },
                    onSaved: (value) {
                      setState(() {
                        name = value;
                      });
                    },
                  ),
                  const SizedBox(height: 20),
                  TextFormField(
                    keyboardType: TextInputType.emailAddress,
                    style: Theme.of(context).textTheme.bodyMedium,
                    decoration: InputDecoration(
                      border: const OutlineInputBorder(),
                      labelText: 'Email',
                      labelStyle: Theme.of(context).textTheme.labelLarge,
                    ),
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Enter Email';
                      }
                      // check is valid email or not
                      if (!RegExp(r'\S+@\S+\.\S+').hasMatch(value)) {
                        return 'Please enter a valid email';
                      }
                      return null;
                    },
                    onSaved: (value) {
                      setState(() {
                        email = value;
                      });
                    },
                  ),
                  const SizedBox(height: 20),
                  TextFormField(
                    keyboardType: TextInputType.number,
                    inputFormatters: <TextInputFormatter>[
                      FilteringTextInputFormatter.digitsOnly
                    ],
                    style: Theme.of(context).textTheme.bodyMedium,
                    decoration: InputDecoration(
                      border: const OutlineInputBorder(),
                      labelText: 'Phone',
                      labelStyle: Theme.of(context).textTheme.labelLarge,
                    ),
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Enter Phone';
                      }
                      return null;
                    },
                    onSaved: (value) {
                      setState(() {
                        phone = value;
                      });
                    },
                  ),
                  const SizedBox(height: 20),
                  TextFormField(
                    style: Theme.of(context).textTheme.bodyMedium,
                    decoration: InputDecoration(
                      border: const OutlineInputBorder(
                        borderRadius: BorderRadius.all(Radius.circular(5.0)),
                      ),
                      labelText: 'Password',
                      labelStyle: Theme.of(context).textTheme.labelLarge,
                      suffixIcon: IconButton(
                          icon: _isObscure
                              ? SvgPicture.asset(Assets.svg.eyeOpen)
                              : SvgPicture.asset(Assets.svg.eyeClose),
                          onPressed: () {
                            setState(() {
                              _isObscure = !_isObscure;
                            });
                          }),
                    ),
                    obscureText: _isObscure,
                    validator: (value) {
                      if (value == null || value.isEmpty) {
                        return 'Enter Password';
                      }
                      return null;
                    },
                    onSaved: (value) {
                      setState(() {
                        passwords = value;
                      });
                    },
                  ),
                  const SizedBox(height: 20),
                ],
              )),
          const SizedBox(height: 20),
          ElevatedBtn(
            onPressed: () {
              conditionRegister(context);
            },
            btnText: 'Register',
          ),
          const SizedBox(height: 40),
          GestureDetector(
            onTap: () {
              Navigator.of(context).pushReplacementNamed(RouteList.login);
            },
            child: Row(
              children: [
                Expanded(
                  flex: 2,
                  child: Text(
                    'Have an account',
                    style: Theme.of(context).textTheme.labelLarge,
                  ),
                ),
                Expanded(
                    child: Align(
                  alignment: Alignment.topRight,
                  child: Icon(
                    Icons.arrow_right_alt,
                    color: Theme.of(context).highlightColor,
                    size: 30,
                  ),
                ))
              ],
            ),
          ),
        ],
      ),
    );
  }
}
