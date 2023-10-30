class Supplier {
  final String name;
  final String p_i_c;
  final String email;

  Supplier({required this.name, required this.p_i_c, required this.email});

  factory Supplier.fromJson(Map<String, dynamic> json) {
    return Supplier(
      name: json['name'],
      p_i_c: json['person_in_charge'],
      email: json['email'],
    );
  }
}

String supplierListJson = '''
    [
      {
        "name": "CandaceDicki",
        "person_in_charge": "30",
        "email": "CandaceDicki@example.com"
      },
      {
        "name": "UrielBeahan",
        "person_in_charge": "31",
        "email": "UrielBeahan@example.com"
      },
      {
        "name": "ChaddGoldner",
        "person_in_charge": "30",
        "email": "ChaddGoldner@example.com"
      },
      {
        "name": "GwendolynAbbott",
        "person_in_charge": "31",
        "email": "GwendolynAbbott@example.com"
      },
      {
        "name": "PercyHirthe",
        "person_in_charge": "30",
        "email": "PercyHirthe@example.com"
      },
      {
        "name": "JulioCarroll",
        "person_in_charge": "31",
        "email": "JulioCarroll@example.com"
      },
      {
        "name": "EdwardCormier",
        "person_in_charge": "30",
        "email": "EdwardCormier@example.com"
      },
      {
        "name": "JosephFarrell",
        "person_in_charge": "31",
        "email": "JosephFarrell@example.com"
      },
      {
        "name": "DellaZiemann",
        "person_in_charge": "30",
        "email": "DellaZiemann@example.com"
      },
      {
        "name": "AshleyDoyle",
        "person_in_charge": "31",
        "email": "AshleyDoyle@example.com"
      },
      {
        "name": "LeslySchulist",
        "person_in_charge": "32",
        "email": "LeslySchulist@example.com"
      }
    ]
    ''';

String buyListJson = '''
    [
      {
      "name": "RodrickCrooks",
      "person_in_charge": "30",
      "email": "RodrickCrooks@example.com"
      },
      {
        "name": "RichardKassulke",
        "person_in_charge": "31",
        "email": "RichardKassulke@example.com"
      },
      {
        "name": "CharlesRowe",
        "person_in_charge": "30",
        "email": "CharlesRowe@example.com"
      },
      {
        "name": "RonnyKunze",
        "person_in_charge": "31",
        "email": "RonnyKunze@example.com"
      },
      {
        "name": "LindaCole",
        "person_in_charge": "30",
        "email": "LindaCole@example.com"
      },
      {
        "name": "ImogeneHyatt",
        "person_in_charge": "31",
        "email": "ImogeneHyatt@example.com"
      },
      {
        "name": "TarynLegros",
        "person_in_charge": "30",
        "email": "TarynLegros@example.com"
      },
      {
        "name": "AdrianRatke",
        "person_in_charge": "31",
        "email": "AdrianRatke@example.com"
      },
      {
        "name": "GageHartmann",
        "person_in_charge": "30",
        "email": "GageHartmann@example.com"
      },
      {
        "name": "CaliCole",
        "person_in_charge": "31",
        "email": "CaliCole@example.com"
      },
      {
        "name": "KristianStehr",
        "person_in_charge": "32",
        "email": "KristianStehr@example.com"
      }
    ]
    ''';
