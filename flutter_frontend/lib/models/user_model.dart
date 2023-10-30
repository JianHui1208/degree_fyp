class UserData {
  final String? uid;
  final String? username;
  final String? phoneNumber;
  final String? email;
  final String? type;

  const UserData({
    this.uid,
    this.username,
    this.phoneNumber,
    this.email,
    this.type,
  });

  factory UserData.fromJson(Map<String, dynamic> json) {
    return UserData(
      uid: json['uid'],
      username: json['username'],
      phoneNumber: json['phoneNumber'],
      email: json['email'],
      type: json['type'],
    );
  }

  Map<String, dynamic> toJson() => {
        'uid': uid,
        'username': username,
        'phoneNumber': phoneNumber,
        'email': email,
        'type': type,
      };
}
