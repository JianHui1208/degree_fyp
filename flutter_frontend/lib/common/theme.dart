import 'package:flutter/material.dart';

final ThemeData theme = ThemeData.light().copyWith(
  scaffoldBackgroundColor: const Color(0xFFF0F2F6),
  secondaryHeaderColor: Colors.green,
  primaryColorLight: Colors.white,
  primaryColorDark: Colors.black,
  primaryColor: const Color(0xFFFD0019),
  dialogBackgroundColor: Colors.white,
  dividerColor: const Color(0xFFC5C5C5),
  highlightColor: const Color(0xFF1C1C1C),
  hintColor: const Color(0xFFFF4154),
  focusColor: Colors.white.withOpacity(0.2),
  shadowColor: Colors.grey.withOpacity(0.1),
  iconTheme: const IconThemeData(
    color: Color(0xFFC5C5C5),
    size: 20,
  ),
  textTheme: const TextTheme(
    displayMedium: TextStyle(
      fontSize: 34,
      color: Colors.white,
      height: 1.2,
    ),
    displaySmall: TextStyle(
      fontSize: 32,
      color: Colors.white,
      fontWeight: FontWeight.w600,
    ),
    headlineLarge: TextStyle(
      fontSize: 26,
      color: Colors.white,
      fontWeight: FontWeight.w700,
    ),
    headlineMedium: TextStyle(
      fontSize: 26,
      color: Colors.white,
      fontWeight: FontWeight.bold,
    ),
    headlineSmall: TextStyle(
      fontSize: 20,
      color: Color(0xFF1C1C1C),
      fontWeight: FontWeight.bold,
    ),
    titleLarge: TextStyle(
      fontSize: 20,
      color: Color(0xFF4F4F4F),
    ),
    titleMedium: TextStyle(
      fontSize: 16,
      color: Colors.black,
      fontWeight: FontWeight.w500,
    ),
    titleSmall: TextStyle(
      fontSize: 12,
      color: Colors.white,
      fontWeight: FontWeight.bold,
    ),
    labelLarge: TextStyle(
      fontSize: 18,
      color: Color(0xFF4F4F4F),
    ),
    labelMedium: TextStyle(
      fontSize: 16,
      color: Color(0xFF4F4F4F),
    ),
    labelSmall: TextStyle(
      fontSize: 11,
      color: Color(0xFFAAAAAA),
    ),
    bodyLarge: TextStyle(
      fontSize: 20,
      color: Colors.black,
      fontWeight: FontWeight.bold,
    ),
    bodyMedium: TextStyle(
      fontSize: 16,
      color: Color(0xFF1C1C1C),
    ),
    bodySmall: TextStyle(
      fontSize: 14,
      color: Color(0xFF949494),
    ),
  ).apply(fontFamily: 'SF Pro Display'),
);

final boxDeco = BoxDecoration(
  border: Border.all(color: Colors.black),
  borderRadius: BorderRadius.circular(15),
);

const boxShadow = BoxShadow(
  color: Color.fromARGB(22, 0, 0, 28),
  spreadRadius: 2,
  blurRadius: 15,
  offset: Offset(0, 2),
);
