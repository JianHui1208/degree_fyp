import 'dart:convert';
import 'package:flutter_dotenv/flutter_dotenv.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

Future<String> updatePassword(String currentPw, String newPw) async {
  String jsonData = '''
    {
      "old_password": "$currentPw",
      "new_password": "$newPw"
    }
  ''';
  return await _sendAuthorizedPostRequest(
    '/api/admin/updatePassword',
    jsonDecode(jsonData),
  );
}

Future<String> getItemCategoryGroupByItem() async {
  return await _sendAuthorizedGetRequest('/api/admin/getCategoryList');
}

Future<String> getItemByCategoryID(String categoryID) async {
  return await _sendAuthorizedGetRequest(
      '/api/admin/getItemByCateID/$categoryID');
}

Future<String> getItemOfStockApi() async {
  return await _sendAuthorizedGetRequest('/api/admin/getItemOfStock');
}

Future<String> storeStockIn(dynamic jsonData) async {
  return await _sendAuthorizedPostRequest(
      '/api/admin/stock-histories', jsonData);
}

Future<String> getItemByItemID(String itemID) async {
  return await _sendAuthorizedGetRequest('/api/admin/items/$itemID');
}

Future<String> getItemCategoryByCompanyId() async {
  return await _sendAuthorizedGetRequest('/api/admin/getCategoryListByCompany');
}

Future<String> searchItemByBarcode(String barcode) async {
  return await _sendAuthorizedGetRequest(
      '/api/admin/searchItemByBarcode/$barcode');
}

Future<String> addItem(dynamic value) async {
  return await _sendAuthorizedPostRequest('/api/admin/items', value);
}

Future<String> addItemCategory(dynamic jsonData) async {
  return await _sendAuthorizedPostRequest(
      '/api/admin/itemCategories', jsonData);
}

Future<String> getStockInOutList() async {
  return await _sendAuthorizedGetRequest(
      '/api/admin/get-stockHistoryGroupByDate');
}

Future<String> getStockInOutDetail(String stockHistoryID) async {
  return await _sendAuthorizedGetRequest(
      '/api/admin/get-stockHistoryById/$stockHistoryID');
}

Future<String> getItemQuantity() async {
  return await _sendAuthorizedGetRequest('/api/admin/getItemQuantity');
}

Future<String> deleteItem(String itemID) async {
  return await _sendAuthorizedDeleteRequest('/api/admin/items/$itemID');
}

Future<String> searchItem(String keyword) async {
  String jsonData = '''
    {
      "keyword": "$keyword",
      "type": 0
    }
  ''';

  return await _sendAuthorizedPostRequest(
    '/api/admin/searchItem',
    jsonDecode(jsonData),
  );
}

Future<String> _getToken() async {
  final prefs = await SharedPreferences.getInstance();
  final userInfo = prefs.getString('user_data') ?? '';
  final userObj = jsonDecode(userInfo);
  return userObj['response']['token'];
}

Future<String> _sendAuthorizedGetRequest(String url) async {
  final baseUrl = dotenv.env['BACKEND_URL'];
  final token = await _getToken();

  final response = await http.get(
    Uri.parse('$baseUrl$url'),
    headers: <String, String>{
      'Content-Type': 'application/json; charset=UTF-8',
      'Authorization': 'Bearer $token',
    },
  );

  if (response.statusCode == 200) {
    return response.body;
  } else {
    throw Exception('Failed to load data');
  }
}

Future<String> _sendAuthorizedDeleteRequest(String url) async {
  final baseUrl = dotenv.env['BACKEND_URL'];
  final token = await _getToken();

  final response = await http.delete(
    Uri.parse('$baseUrl$url'),
    headers: <String, String>{
      'Content-Type': 'application/json; charset=UTF-8',
      'Authorization': 'Bearer $token',
    },
  );

  if (response.statusCode == 200) {
    return response.body;
  } else {
    throw Exception('Failed to load data');
  }
}

Future<String> _sendAuthorizedPostRequest(String url, dynamic value) async {
  final baseUrl = dotenv.env['BACKEND_URL'];
  final token = await _getToken();

  final response = await http.post(
    Uri.parse('$baseUrl$url'),
    headers: <String, String>{
      'Content-Type': 'application/json; charset=UTF-8',
      'Authorization': 'Bearer $token',
    },
    body: jsonEncode(value),
  );

  if (response.statusCode == 200) {
    return response.body;
  } else if (response.statusCode == 422) {
    String jsonString =
        '''{"status": 422, "message": "Unprocessable Entity"}''';
    return jsonString;
  } else {
    return response.statusCode.toString();
  }
}
