class StockHistoryResponse {
  Map<String, StockList> stockHistory;

  StockHistoryResponse({required this.stockHistory});

  factory StockHistoryResponse.fromJson(Map<String, dynamic> json) {
    final Map<String, dynamic> stockHistoryJson = json['stockHistory'];
    final stockHistory = stockHistoryJson
        .map((key, value) => MapEntry(key, StockList.fromJson(value)));
    return StockHistoryResponse(stockHistory: stockHistory);
  }
}

class StockList {
  String date;
  List<StockOrder> stockOrder;

  StockList({required this.date, required this.stockOrder});

  factory StockList.fromJson(Map<String, dynamic> json) {
    final date = json['date'] as String;
    final stockOrderJson = json['stockOrder'] as List<dynamic>;
    final stockOrder =
        stockOrderJson.map((e) => StockOrder.fromJson(e)).toList();
    return StockList(date: date, stockOrder: stockOrder);
  }
}

class StockOrder {
  int id;
  int inOrOut;
  String totalQuantity;
  String description;
  String createdAt;
  String updatedAt;
  dynamic deletedAt;
  String date;
  int itemCount;

  StockOrder({
    required this.id,
    required this.inOrOut,
    required this.totalQuantity,
    required this.description,
    required this.createdAt,
    required this.updatedAt,
    required this.deletedAt,
    required this.date,
    required this.itemCount,
  });

  factory StockOrder.fromJson(Map<String, dynamic> json) {
    return StockOrder(
      id: json['id'] as int,
      inOrOut: json['in_or_out'],
      totalQuantity: json['total_quantity'] as String,
      description: json['description'] as String,
      createdAt: json['created_at'] as String,
      updatedAt: json['updated_at'] as String,
      deletedAt: json['deleted_at'],
      date: json['date'] as String,
      itemCount: json['item_count'] as int,
    );
  }
}
