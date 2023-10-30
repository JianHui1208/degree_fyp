class StockHistory {
  String inOrOut;
  String totalQuantity;
  String description;
  List<StockHistoryItem> stockItems;

  StockHistory({
    required this.inOrOut,
    required this.totalQuantity,
    required this.description,
    required this.stockItems,
  });

  factory StockHistory.fromJson(Map<String, dynamic> json) {
    List<dynamic> stockItemsJson = json['stockItems'];
    List<StockHistoryItem> stockItemsList =
        stockItemsJson.map((item) => StockHistoryItem.fromJson(item)).toList();

    return StockHistory(
      inOrOut: json['in_or_out'],
      totalQuantity: json['total_quantity'],
      description: json['description'],
      stockItems: stockItemsList,
    );
  }

  Map<String, dynamic> toJson() {
    List<Map<String, dynamic>> stockItemsJson =
        stockItems.map((item) => item.toJson()).toList();

    return {
      'in_or_out': inOrOut,
      'total_quantity': totalQuantity,
      'description': description,
      'stockItems': stockItemsJson,
    };
  }
}

class StockHistoryItem {
  int itemId;
  int oldQuantity;
  int newQuantity;
  int currentAddQuantity;

  StockHistoryItem({
    required this.itemId,
    required this.oldQuantity,
    required this.newQuantity,
    required this.currentAddQuantity,
  });

  factory StockHistoryItem.fromJson(Map<String, dynamic> json) {
    return StockHistoryItem(
      itemId: json['item_id'],
      oldQuantity: json['old_quantity'],
      newQuantity: json['new_quantity'],
      currentAddQuantity: json['currentAddQuantity'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'item_id': itemId,
      'old_quantity': oldQuantity,
      'new_quantity': newQuantity,
      'currentAddQuantity': currentAddQuantity,
    };
  }
}
