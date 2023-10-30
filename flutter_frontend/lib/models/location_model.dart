class Location {
  String title;
  int id;

  Location({
    required this.title,
    required this.id,
  });

  static List<Location> genereateLocation() {
    return [
      Location(
        id: 1,
        title: 'Southern AutoSPA',
      ),
      Location(
        id: 2,
        title: 'Setia Tropika',
      ),
      Location(
        id: 3,
        title: 'Skudai',
      ),
    ];
  }
}
