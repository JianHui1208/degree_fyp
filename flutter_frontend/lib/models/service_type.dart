class ServiceType {
  String title;

  ServiceType({
    required this.title,
  });

  static List<ServiceType> genereateServiceType() {
    return [
      ServiceType(
        title: 'Normal Wash',
      ),
      ServiceType(
        title: 'Bubble Wash',
      ),
      ServiceType(
        title: 'Wash & Waxing',
      ),
    ];
  }
}
