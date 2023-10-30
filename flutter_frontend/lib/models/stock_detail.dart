class StockDetailType {
  int id;
  int inOrOut;
  int totalQuantity;
  int itemCount;
  String description;
  String createdAt;
  String updatedAt;
  List<StockItem> stockItems;

  StockDetailType({
    required this.id,
    required this.inOrOut,
    required this.totalQuantity,
    required this.itemCount,
    required this.description,
    required this.createdAt,
    required this.updatedAt,
    required this.stockItems,
  });

  factory StockDetailType.fromJson(Map<String, dynamic> json) {
    var stockItemList = json['stockItems'] as List;
    List<StockItem> stockItem =
        stockItemList.map((item) => StockItem.fromJson(item)).toList();

    return StockDetailType(
      id: json['id'],
      inOrOut: json['in_or_out'],
      totalQuantity: json['total_quantity'],
      itemCount: json['item_count'],
      description: json['description'],
      createdAt: json['created_at'],
      updatedAt: json['updated_at'],
      stockItems: stockItem,
    );
  }
}

class StockItem {
  int id;
  int stockHistoryId;
  int itemId;
  int oldQuantity;
  int newQuantity;
  String createdAt;
  String updatedAt;
  Items items;

  StockItem({
    required this.id,
    required this.stockHistoryId,
    required this.itemId,
    required this.oldQuantity,
    required this.newQuantity,
    required this.createdAt,
    required this.updatedAt,
    required this.items,
  });

  factory StockItem.fromJson(Map<String, dynamic> json) {
    return StockItem(
      id: json['id'],
      stockHistoryId: json['stock_history_id'],
      itemId: json['item_id'],
      oldQuantity: json['old_quantity'],
      newQuantity: json['new_quantity'],
      createdAt: json['created_at'],
      updatedAt: json['updated_at'],
      items: Items.fromJson(json['items']),
    );
  }
}

class Items {
  int id;
  String uid;
  String name;
  String? imageUrl;

  Items({
    required this.id,
    required this.uid,
    required this.name,
    this.imageUrl,
  });

  factory Items.fromJson(Map<String, dynamic> json) {
    return Items(
      id: json['id'],
      uid: json['uid'],
      name: json['name'],
      imageUrl: json['imageUrl'],
    );
  }
}
