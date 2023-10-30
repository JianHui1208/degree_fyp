import 'package:flutter/material.dart';
import '../../models/notification_model.dart';
import '../../routes/route.dart';
import 'dart:convert';

class NotificationList extends StatefulWidget {
  NotificationList({Key? key}) : super(key: key);

  @override
  State<NotificationList> createState() => _NotificationListState();
}

class _NotificationListState extends State<NotificationList> {
  @override
  Widget build(BuildContext context) {
    List<dynamic> jsonData = json.decode(notificationListJson);
    List<NotificationItem> notifications =
        jsonData.map((json) => NotificationItem.fromJson(json)).toList();

    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.white,
        centerTitle: true,
        title: Text(
          'Notification',
          style: Theme.of(context).textTheme.bodyLarge,
        ),
        leading: IconButton(
          onPressed: () {
            Navigator.of(context).pushReplacementNamed(RouteList.dashboard);
          },
          icon: const Icon(Icons.arrow_back_ios_rounded, color: Colors.black),
        ),
      ),
      body: Container(
        padding: const EdgeInsets.all(18),
        child: SizedBox(
          // height: 500,
          child: ListView.builder(
            itemCount: notifications.length,
            itemBuilder: (BuildContext context, int index) {
              IconData icon;
              Color color;

              if (notifications[index].type == 'success') {
                icon = Icons.check_circle_rounded;
                color = Colors.green;
              } else if (notifications[index].type == 'remind') {
                icon = Icons.notifications_active_rounded;
                color = Colors.red;
              } else {
                icon = Icons.info_rounded;
                color = Colors.blue;
              }
              return ListTile(
                contentPadding: const EdgeInsets.all(5),
                leading: Icon(icon, color: color, size: 35),
                title: Text(notifications[index].title),
                subtitle: Text(notifications[index].message),
                trailing:
                    const Icon(Icons.keyboard_arrow_right_rounded, size: 35),
                onTap: () {
                  _showNotificationDialog(context, notifications[index]);
                },
              );
            },
          ),
        ),
      ),
    );
  }

  void _showNotificationDialog(
      BuildContext context, NotificationItem notification) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text(notification.title,
              style: Theme.of(context).textTheme.bodyLarge),
          content: Text(notification.message),
          actions: [
            TextButton(
              onPressed: () {
                Navigator.of(context).pop();
              },
              child: const Text('Close'),
            ),
          ],
        );
      },
    );
  }
}
