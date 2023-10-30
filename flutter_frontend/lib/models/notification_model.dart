class NotificationItem {
  final String title;
  final String message;
  final String type;

  NotificationItem(
      {required this.title, required this.message, required this.type});

  // Convert NotificationItem to a JSON Map
  Map<String, dynamic> toJson() {
    return {
      'title': title,
      'message': message,
      'type': type, // Convert enum to string
    };
  }

  // Create a NotificationItem from JSON Map
  factory NotificationItem.fromJson(Map<String, dynamic> json) {
    return NotificationItem(
      title: json['title'],
      message: json['message'],
      type: json['type'],
    );
  }
}

String notificationListJson = '''
    [
      {
        "title": "Success Notification",
        "message": "This is a success notification.",
        "type": "success"
      },
      {
        "title": "Reminder Notification",
        "message": "This is a reminder notification.",
        "type": "remind"
      },
      {
        "title": "Information Notification",
        "message": "This is an information notification.",
        "type": "information"
      },{
        "title": "Success Notification",
        "message": "This is a success notification.",
        "type": "success"
      },
      {
        "title": "Reminder Notification",
        "message": "This is a reminder notification.",
        "type": "remind"
      },
      {
        "title": "Information Notification",
        "message": "This is an information notification.",
        "type": "information"
      },{
        "title": "Success Notification",
        "message": "This is a success notification.",
        "type": "success"
      },
      {
        "title": "Reminder Notification",
        "message": "This is a reminder notification.",
        "type": "remind"
      },
      {
        "title": "Information Notification",
        "message": "This is an information notification.",
        "type": "information"
      },{
        "title": "Success Notification",
        "message": "This is a success notification.",
        "type": "success"
      },
      {
        "title": "Reminder Notification",
        "message": "This is a reminder notification.",
        "type": "remind"
      },
      {
        "title": "Information Notification",
        "message": "This is an information notification.",
        "type": "information"
      }
    ]
    ''';
