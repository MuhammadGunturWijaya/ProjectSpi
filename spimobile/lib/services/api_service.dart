import 'dart:convert';
import 'package:http/http.dart' as http;

class ApiService {
  // Base URL hanya sampai folder API
  static const String baseUrl = 'http://localhost:8080/backend/api';

  static Future<List<dynamic>> fetchPengaduans() async {
    // File endpoint ditambahkan di sini
    final response = await http.get(Uri.parse('$baseUrl/pengaduans.php'));

    if (response.statusCode == 200) {
      return jsonDecode(response.body);
    } else {
      throw Exception('Gagal mengambil data dari server');
    }
  }
}

