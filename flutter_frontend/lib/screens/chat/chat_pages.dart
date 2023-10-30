import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

class ChatMessage {
  String messageContent;
  String messageType;
  ChatMessage({required this.messageContent, required this.messageType});
}

class ChatScreen extends StatefulWidget {
  const ChatScreen({super.key});

  @override
  _ChatScreenState createState() => _ChatScreenState();
}

class _ChatScreenState extends State<ChatScreen> {
  final _formKey = GlobalKey<FormState>();
  String? senderMSG;
  final TextEditingController _messageController = TextEditingController();
  ScrollController _scrollController = ScrollController();
  List<ChatMessage> messages = [
    ChatMessage(
        messageContent:
            "Hi, this is intelligent customer service. You can ask some questions about this application, and I will answer you.",
        messageType: "receiver"),
  ];

  @override
  void dispose() {
    _messageController.dispose(); // Dispose the TextEditingController
    super.dispose();
  }

  Future<String> chatbot(String message) async {
    var url = Uri.parse('http://localhost:7000/get?msg=$message');
    var response = await http.get(url);
    if (response.statusCode == 200) {
      dynamic jsonResponse = jsonDecode(response.body);
      return jsonResponse['data']['text'].toString();
    } else {
      print('Request failed with status: ${response.statusCode}.');
      return 'Error of the ChatBot';
    }
  }

  @override
  Widget build(BuildContext context) {
    void submitMessage() async {
      if (_formKey.currentState!.validate()) {
        _formKey.currentState!.save(); // Save the form field value
        String response = await chatbot(senderMSG!);

        setState(() {
          messages.add(
              ChatMessage(messageContent: senderMSG!, messageType: "sender"));
          messages.add(
              ChatMessage(messageContent: response, messageType: "receiver"));
        });

        // Scroll to the end of the list
        _scrollController.animateTo(
          _scrollController.position.maxScrollExtent,
          duration: const Duration(milliseconds: 1000),
          curve: Curves.easeOut,
        );

        _messageController.clear();
      }
    }

    return Scaffold(
      appBar: AppBar(
        elevation: 0,
        automaticallyImplyLeading: false,
        backgroundColor: Colors.white,
        flexibleSpace: SafeArea(
          child: Container(
            padding: const EdgeInsets.only(right: 16),
            child: Row(
              children: <Widget>[
                const SizedBox(
                  width: 10,
                ),
                IconButton(
                  onPressed: () {
                    Navigator.pop(context);
                  },
                  icon: const Icon(
                    Icons.arrow_back,
                    color: Colors.black,
                  ),
                ),
                const SizedBox(
                  width: 10,
                ),
                const CircleAvatar(
                  backgroundColor: Colors.white,
                  backgroundImage: NetworkImage(
                      "https://icon-library.com/images/customer-service-icon-png/customer-service-icon-png-27.jpg"),
                  maxRadius: 20,
                ),
                const SizedBox(
                  width: 20,
                ),
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: <Widget>[
                      const Text(
                        "Kriss Benwat",
                        style: TextStyle(
                            fontSize: 16, fontWeight: FontWeight.w600),
                      ),
                      const SizedBox(
                        height: 6,
                      ),
                      Text(
                        "Online",
                        style: TextStyle(
                            color: Colors.grey.shade600, fontSize: 13),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
      body: SingleChildScrollView(
        physics: const BouncingScrollPhysics(),
        child: ListView.builder(
          controller: _scrollController,
          itemCount: messages.length,
          padding: const EdgeInsets.only(top: 10, bottom: 70),
          shrinkWrap: true,
          physics: const NeverScrollableScrollPhysics(),
          itemBuilder: (context, index) {
            return Container(
              padding: const EdgeInsets.only(
                  left: 14, right: 14, top: 10, bottom: 10),
              child: Align(
                alignment: (messages[index].messageType == "receiver"
                    ? Alignment.topLeft
                    : Alignment.topRight),
                child: Container(
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(20),
                    color: (messages[index].messageType == "receiver"
                        ? Colors.grey.shade200
                        : Colors.blue[200]),
                  ),
                  padding: const EdgeInsets.all(16),
                  child: Text(
                    messages[index].messageContent,
                    style: const TextStyle(fontSize: 15),
                  ),
                ),
              ),
            );
          },
        ),
      ),
      bottomSheet: SizedBox(
        height: 60,
        child: Align(
          alignment: Alignment.bottomLeft,
          child: Container(
            padding: const EdgeInsets.only(left: 10, bottom: 10, top: 10),
            height: 60,
            width: double.infinity,
            color: Colors.white,
            child: Row(
              children: <Widget>[
                Container(
                  height: 30,
                  width: 30,
                  decoration: BoxDecoration(
                    color: Colors.lightBlue,
                    borderRadius: BorderRadius.circular(30),
                  ),
                  child: const Icon(
                    Icons.add,
                    color: Colors.white,
                    size: 20,
                  ),
                ),
                const SizedBox(
                  width: 15,
                ),
                Form(
                  key: _formKey,
                  child: Expanded(
                    child: TextFormField(
                      controller: _messageController,
                      decoration: const InputDecoration(
                          hintText: "Write message...",
                          hintStyle: TextStyle(color: Colors.black54),
                          border: InputBorder.none),
                      onSaved: (newValue) {
                        senderMSG = newValue!;
                      },
                    ),
                  ),
                ),
                const SizedBox(
                  width: 15,
                ),
                FloatingActionButton(
                  onPressed: () {
                    submitMessage();
                  },
                  backgroundColor: Colors.blue,
                  elevation: 0,
                  child: const Icon(
                    Icons.send,
                    color: Colors.white,
                    size: 18,
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
