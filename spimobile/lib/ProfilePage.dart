import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:shared_preferences/shared_preferences.dart';

class ProfilePage extends StatefulWidget {
  final String? userId; // Ubah jadi nullable

  const ProfilePage({
    super.key,
    this.userId, // Hapus required
  });

  @override
  State<ProfilePage> createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
  // API Base URL - sesuaikan dengan URL API Anda
  final String baseUrl = 'http://192.168.0.104/backend/api';

  // User data
  String _id = '';
  String _nama = '';
  String _email = '';
  String _role = '';
  String _nomorTelepon = '';
  String _alamat = '';

  bool _isEditing = false;
  bool _isLoading = true;
  bool _notifikasiEmail = true;
  bool _notifikasiTelepon = false;
  bool _notifikasiWhatsApp = true;

  // Statistik
  int _totalLaporan = 0;
  int _laporanDikirim = 0;
  int _diverifikasi = 0;
  int _tindakLanjut = 0;
  int _tanggapanPelapor = 0;
  int _selesai = 0;

  final _namaController = TextEditingController();
  final _emailController = TextEditingController();
  final _telpController = TextEditingController();
  final _alamatController = TextEditingController();

  String? _currentUserId;

  @override
  void initState() {
    super.initState();
    _initializeUserId();
  }

  // Inisialisasi userId
  Future<void> _initializeUserId() async {
    if (widget.userId != null && widget.userId!.isNotEmpty) {
      _currentUserId = widget.userId;
    } else {
      final prefs = await SharedPreferences.getInstance();
      _currentUserId = prefs.getString('user_id') ?? '';
    }

    if (_currentUserId != null && _currentUserId!.isNotEmpty) {
      await _loadUserProfile();
      await _loadUserStatistics();
    } else {
      _showErrorSnackBar('User ID tidak ditemukan');
      setState(() => _isLoading = false);
    }
  }

  // Fungsi untuk load profil user dari API
  Future<void> _loadUserProfile() async {
    setState(() => _isLoading = true);

    try {
      final response = await http.get(
        Uri.parse('$baseUrl/get_profile.php?user_id=$_currentUserId'),
        headers: {'Content-Type': 'application/json'},
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);

        if (data['status'] == 'success') {
          setState(() {
            _id = data['data']['id'].toString(); // Konversi ke String
            _nama = data['data']['name']?.toString() ?? '';
            _email = data['data']['email']?.toString() ?? '';
            _role = data['data']['role']?.toString() ?? '';
            _nomorTelepon = data['data']['phone']?.toString() ?? '';
            _alamat = data['data']['address']?.toString() ?? '';

            _namaController.text = _nama;
            _emailController.text = _email;
            _telpController.text = _nomorTelepon;
            _alamatController.text = _alamat;

            _isLoading = false;
          });
        } else {
          _showErrorSnackBar(data['message'] ?? 'Gagal memuat profil');
          setState(() => _isLoading = false);
        }
      } else {
        _showErrorSnackBar('Gagal terhubung ke server');
        setState(() => _isLoading = false);
      }
    } catch (e) {
      _showErrorSnackBar('Terjadi kesalahan: $e');
      setState(() => _isLoading = false);
    }
  }

  // Fungsi untuk load statistik user
  Future<void> _loadUserStatistics() async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/get_user_statistics.php?user_id=$_currentUserId'),
        headers: {'Content-Type': 'application/json'},
      );

      if (response.statusCode == 200) {
        final data = json.decode(response.body);

        if (data['status'] == 'success') {
          setState(() {
            _totalLaporan =
                int.tryParse(data['data']['total_laporan'].toString()) ?? 0;
            _laporanDikirim =
                int.tryParse(data['data']['laporan_dikirim'].toString()) ?? 0;
            _diverifikasi =
                int.tryParse(data['data']['diverifikasi'].toString()) ?? 0;
            _tindakLanjut =
                int.tryParse(data['data']['tindak_lanjut'].toString()) ?? 0;
            _tanggapanPelapor =
                int.tryParse(data['data']['tanggapan_pelapor'].toString()) ?? 0;
            _selesai = int.tryParse(data['data']['selesai'].toString()) ?? 0;
          });
        }
      }
    } catch (e) {
      print('Error loading statistics: $e');
    }
  }

  // Fungsi untuk update profil
  Future<void> _saveChanges() async {
    // Validasi input wajib
    if (_namaController.text.isEmpty ||
        _emailController.text.isEmpty ||
        _telpController.text.isEmpty) {
      _showErrorSnackBar('Semua field wajib diisi');
      return;
    }

    setState(() => _isLoading = true);

    try {
      // 🔹 Ambil user_id dari SharedPreferences
      final prefs = await SharedPreferences.getInstance();
      final userId = prefs.getString('user_id');

      if (userId == null || userId.isEmpty) {
        _showErrorSnackBar('User ID tidak ditemukan. Silakan login ulang.');
        setState(() => _isLoading = false);
        return;
      }

      // 🔹 Kirim data ke API (POST JSON)
      final response = await http.post(
        Uri.parse('$baseUrl/get_profile.php'),
        headers: {'Content-Type': 'application/json'},
        body: json.encode({
          'user_id': userId,
          'name': _namaController.text,
          'email': _emailController.text,
          'phone': _telpController.text,
          'address': _alamatController.text,
        }),
      );

      // 🔹 Cek status dari server
      if (response.statusCode == 200) {
        final data = json.decode(response.body);

        if (data['status'] == 'success') {
          setState(() {
            _nama = _namaController.text;
            _email = _emailController.text;
            _nomorTelepon = _telpController.text;
            _alamat = _alamatController.text;
            _isEditing = false;
            _isLoading = false;
          });

          _showSuccessSnackBar('Profil berhasil diperbarui');
        } else {
          _showErrorSnackBar(data['message'] ?? 'Gagal memperbarui profil');
          setState(() => _isLoading = false);
        }
      } else {
        _showErrorSnackBar(
          'Gagal terhubung ke server (${response.statusCode})',
        );
        setState(() => _isLoading = false);
      }
    } catch (e) {
      _showErrorSnackBar('Terjadi kesalahan: $e');
      setState(() => _isLoading = false);
    }
  }

  void _showSuccessSnackBar(String message) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text(message), backgroundColor: Colors.green),
    );
  }

  void _showErrorSnackBar(String message) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text(message), backgroundColor: Colors.orange),
    );
  }

  @override
  void dispose() {
    _namaController.dispose();
    _emailController.dispose();
    _telpController.dispose();
    _alamatController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    if (_isLoading) {
      return Scaffold(
        backgroundColor: Colors.grey.shade50,
        appBar: AppBar(
          elevation: 0,
          backgroundColor: const Color(0xFFC62828),
          leading: IconButton(
            icon: const Icon(Icons.arrow_back_ios_rounded, color: Colors.white),
            onPressed: () => Navigator.pop(context),
          ),
          title: const Text(
            'Profil Saya',
            style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
          ),
          centerTitle: true,
        ),
        body: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              const CircularProgressIndicator(
                valueColor: AlwaysStoppedAnimation<Color>(Color(0xFFC62828)),
              ),
              const SizedBox(height: 16),
              Text(
                'Memuat profil...',
                style: TextStyle(fontSize: 14, color: Colors.grey.shade600),
              ),
            ],
          ),
        ),
      );
    }

    return Scaffold(
      backgroundColor: Colors.grey.shade50,
      appBar: AppBar(
        elevation: 0,
        backgroundColor: const Color(0xFFC62828),
        leading: IconButton(
          icon: const Icon(Icons.arrow_back_ios_rounded, color: Colors.white),
          onPressed: () => Navigator.pop(context),
        ),
        title: const Text(
          'Profil Saya',
          style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
        ),
        centerTitle: true,
        actions: [
          if (!_isEditing)
            IconButton(
              icon: const Icon(Icons.edit_rounded, color: Colors.white),
              onPressed: () => setState(() => _isEditing = true),
            )
          else
            IconButton(
              icon: const Icon(Icons.close_rounded, color: Colors.white),
              onPressed: () {
                _namaController.text = _nama;
                _emailController.text = _email;
                _telpController.text = _nomorTelepon;
                _alamatController.text = _alamat;
                setState(() => _isEditing = false);
              },
            ),
        ],
      ),
      body: RefreshIndicator(
        onRefresh: () async {
          await _loadUserProfile();
          await _loadUserStatistics();
        },
        color: const Color(0xFFC62828),
        child: SingleChildScrollView(
          physics: const AlwaysScrollableScrollPhysics(
            parent: BouncingScrollPhysics(),
          ),
          child: Column(
            children: [
              // Header dengan Avatar
              Container(
                width: double.infinity,
                padding: const EdgeInsets.all(20),
                decoration: BoxDecoration(
                  gradient: LinearGradient(
                    begin: Alignment.topLeft,
                    end: Alignment.bottomRight,
                    colors: [const Color(0xFFC62828), Colors.red.shade400],
                  ),
                ),
                child: Column(
                  children: [
                    Stack(
                      children: [
                        Container(
                          width: 100,
                          height: 100,
                          decoration: BoxDecoration(
                            shape: BoxShape.circle,
                            border: Border.all(color: Colors.white, width: 4),
                            color: Colors.white,
                          ),
                          child: Center(
                            child: Text(
                              _nama.isNotEmpty
                                  ? _nama.substring(0, 1).toUpperCase()
                                  : 'U',
                              style: const TextStyle(
                                fontSize: 48,
                                fontWeight: FontWeight.bold,
                                color: Color(0xFFC62828),
                              ),
                            ),
                          ),
                        ),
                        if (_isEditing)
                          Positioned(
                            right: 0,
                            bottom: 0,
                            child: Container(
                              padding: const EdgeInsets.all(5),
                              decoration: BoxDecoration(
                                color: Colors.white,
                                shape: BoxShape.circle,
                                border: Border.all(
                                  color: Colors.white,
                                  width: 2,
                                ),
                              ),
                              child: const Icon(
                                Icons.camera_alt_rounded,
                                color: Color(0xFFC62828),
                                size: 20,
                              ),
                            ),
                          ),
                      ],
                    ),
                    const SizedBox(height: 15),
                    Text(
                      _nama,
                      style: const TextStyle(
                        fontSize: 22,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                    const SizedBox(height: 5),
                    Text(
                      _email,
                      style: TextStyle(
                        fontSize: 13,
                        color: Colors.white.withOpacity(0.9),
                      ),
                    ),
                    const SizedBox(height: 8),
                    Container(
                      padding: const EdgeInsets.symmetric(
                        horizontal: 12,
                        vertical: 6,
                      ),
                      decoration: BoxDecoration(
                        color: Colors.white.withOpacity(0.2),
                        borderRadius: BorderRadius.circular(20),
                      ),
                      child: Text(
                        _role.toUpperCase(),
                        style: const TextStyle(
                          fontSize: 12,
                          fontWeight: FontWeight.bold,
                          color: Colors.white,
                          letterSpacing: 1,
                        ),
                      ),
                    ),
                  ],
                ),
              ),

              const SizedBox(height: 20),

              // Informasi Pribadi
              _buildSectionCard('INFORMASI PRIBADI', Icons.person_rounded, [
                _buildInfoField(
                  'Nama Lengkap',
                  _nama,
                  _namaController,
                  Icons.person_rounded,
                  _isEditing,
                ),
                const SizedBox(height: 15),
                _buildInfoField(
                  'Email',
                  _email,
                  _emailController,
                  Icons.email_rounded,
                  _isEditing,
                  keyboardType: TextInputType.emailAddress,
                ),
                const SizedBox(height: 15),
                _buildInfoField(
                  'Nomor Telepon',
                  _nomorTelepon,
                  _telpController,
                  Icons.phone_rounded,
                  _isEditing,
                  keyboardType: TextInputType.phone,
                ),
                const SizedBox(height: 15),
                _buildInfoField(
                  'Alamat',
                  _alamat,
                  _alamatController,
                  Icons.location_on_rounded,
                  _isEditing,
                  maxLines: 2,
                ),
              ]),

              const SizedBox(height: 20),

              // Pengaturan Notifikasi
              _buildSectionCard(
                'PENGATURAN NOTIFIKASI',
                Icons.notifications_rounded,
                [
                  _buildNotificationToggle(
                    'Email',
                    'Terima notifikasi melalui email',
                    Icons.email_rounded,
                    _notifikasiEmail,
                    (value) => setState(() => _notifikasiEmail = value),
                  ),
                  const SizedBox(height: 15),
                  _buildNotificationToggle(
                    'Telepon',
                    'Terima notifikasi melalui SMS',
                    Icons.phone_rounded,
                    _notifikasiTelepon,
                    (value) => setState(() => _notifikasiTelepon = value),
                  ),
                  const SizedBox(height: 15),
                  _buildNotificationToggle(
                    'WhatsApp',
                    'Terima notifikasi melalui WhatsApp',
                    Icons.chat_bubble_rounded,
                    _notifikasiWhatsApp,
                    (value) => setState(() => _notifikasiWhatsApp = value),
                  ),
                ],
              ),

              const SizedBox(height: 20),

              // Statistik
              _buildSectionCard(
                'STATISTIK PENGADUAN',
                Icons.bar_chart_rounded,
                [
                  Row(
                    children: [
                      Expanded(
                        child: _buildStatCard(
                          'Total Laporan',
                          _totalLaporan.toString(),
                          Colors.blue,
                        ),
                      ),
                      const SizedBox(width: 12),
                      Expanded(
                        child: _buildStatCard(
                          'Diproses',
                          (_laporanDikirim +
                                  _diverifikasi +
                                  _tindakLanjut +
                                  _tanggapanPelapor)
                              .toString(),
                          Colors.orange,
                        ),
                      ),
                      const SizedBox(width: 12),
                      Expanded(
                        child: _buildStatCard(
                          'Selesai',
                          _selesai.toString(),
                          Colors.green,
                        ),
                      ),
                    ],
                  ),
                ],
              ),

              const SizedBox(height: 20),

              // Tombol Aksi
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 20),
                child: Column(
                  children: [
                    if (_isEditing) ...[
                      SizedBox(
                        width: double.infinity,
                        height: 50,
                        child: ElevatedButton.icon(
                          onPressed: _saveChanges,
                          style: ElevatedButton.styleFrom(
                            backgroundColor: Colors.green,
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(12),
                            ),
                            elevation: 5,
                            shadowColor: Colors.green.shade200,
                          ),
                          icon: const Icon(Icons.save_rounded),
                          label: const Text(
                            'Simpan Perubahan',
                            style: TextStyle(
                              fontSize: 16,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                        ),
                      ),
                      const SizedBox(height: 12),
                    ],
                    SizedBox(
                      width: double.infinity,
                      height: 50,
                      child: OutlinedButton.icon(
                        onPressed: () {
                          showDialog(
                            context: context,
                            builder: (context) => AlertDialog(
                              title: const Text('Ubah Password'),
                              content: Column(
                                mainAxisSize: MainAxisSize.min,
                                children: [
                                  TextField(
                                    obscureText: true,
                                    decoration: InputDecoration(
                                      labelText: 'Password Lama',
                                      border: OutlineInputBorder(
                                        borderRadius: BorderRadius.circular(10),
                                      ),
                                    ),
                                  ),
                                  const SizedBox(height: 12),
                                  TextField(
                                    obscureText: true,
                                    decoration: InputDecoration(
                                      labelText: 'Password Baru',
                                      border: OutlineInputBorder(
                                        borderRadius: BorderRadius.circular(10),
                                      ),
                                    ),
                                  ),
                                  const SizedBox(height: 12),
                                  TextField(
                                    obscureText: true,
                                    decoration: InputDecoration(
                                      labelText: 'Konfirmasi Password',
                                      border: OutlineInputBorder(
                                        borderRadius: BorderRadius.circular(10),
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                              actions: [
                                TextButton(
                                  onPressed: () => Navigator.pop(context),
                                  child: const Text('Batal'),
                                ),
                                ElevatedButton(
                                  onPressed: () {
                                    Navigator.pop(context);
                                    _showSuccessSnackBar(
                                      'Password berhasil diubah',
                                    );
                                  },
                                  style: ElevatedButton.styleFrom(
                                    backgroundColor: const Color(0xFFC62828),
                                  ),
                                  child: const Text('Simpan'),
                                ),
                              ],
                            ),
                          );
                        },
                        style: OutlinedButton.styleFrom(
                          foregroundColor: const Color(0xFFC62828),
                          side: const BorderSide(
                            color: Color(0xFFC62828),
                            width: 2,
                          ),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(12),
                          ),
                        ),
                        icon: const Icon(Icons.lock_outline_rounded),
                        label: const Text(
                          'Ubah Password',
                          style: TextStyle(
                            fontSize: 16,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ),
                    ),
                    const SizedBox(height: 12),
                    SizedBox(
                      width: double.infinity,
                      height: 50,
                      child: OutlinedButton.icon(
                        onPressed: () {
                          showDialog(
                            context: context,
                            builder: (context) => AlertDialog(
                              title: const Text('Logout'),
                              content: const Text(
                                'Apakah Anda yakin ingin keluar dari aplikasi?',
                              ),
                              actions: [
                                TextButton(
                                  onPressed: () =>
                                      Navigator.pop(context), // batal
                                  child: const Text('Batal'),
                                ),
                                ElevatedButton(
                                  onPressed: () {
                                    Navigator.pop(context); // tutup dialog
                                    _logout(); // panggil fungsi logout
                                  },
                                  style: ElevatedButton.styleFrom(
                                    backgroundColor: Colors.red,
                                  ),
                                  child: const Text('Logout'),
                                ),
                              ],
                            ),
                          );
                        },
                        style: OutlinedButton.styleFrom(
                          foregroundColor: Colors.red,
                          side: const BorderSide(color: Colors.red, width: 2),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(12),
                          ),
                        ),
                        icon: const Icon(Icons.logout_rounded),
                        label: const Text(
                          'Logout',
                          style: TextStyle(
                            fontSize: 16,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              ),

              const SizedBox(height: 30),
            ],
          ),
        ),
      ),
    );
  }

  Future<void> _logout() async {
    // 1. Hapus semua data login di SharedPreferences
    final prefs = await SharedPreferences.getInstance();
    await prefs.remove('user_id'); // hapus user_id
    await prefs.remove('user_name'); // hapus nama user
    // Jika ada data lain yang ingin dihapus, bisa tambahkan di sini

    // 2. Tampilkan snackbar konfirmasi
    _showSuccessSnackBar('Logout berhasil');

    // 3. Navigasi ke halaman login
    // Ganti '/login' sesuai route halaman login Anda
    Navigator.pushNamedAndRemoveUntil(
      context,
      '/LoginPage',
      (Route<dynamic> route) => false,
    );
  }

  Widget _buildSectionCard(String title, IconData icon, List<Widget> children) {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 20),
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(20),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.05),
            blurRadius: 10,
            offset: const Offset(0, 4),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              Container(
                padding: const EdgeInsets.all(10),
                decoration: BoxDecoration(
                  color: const Color(0xFFC62828).withOpacity(0.1),
                  borderRadius: BorderRadius.circular(10),
                ),
                child: Icon(icon, color: const Color(0xFFC62828), size: 24),
              ),
              const SizedBox(width: 12),
              Text(
                title,
                style: TextStyle(
                  fontSize: 16,
                  fontWeight: FontWeight.bold,
                  color: Colors.grey.shade800,
                ),
              ),
            ],
          ),
          const SizedBox(height: 20),
          ...children,
        ],
      ),
    );
  }

  Widget _buildInfoField(
    String label,
    String value,
    TextEditingController controller,
    IconData icon,
    bool isEditing, {
    TextInputType keyboardType = TextInputType.text,
    int maxLines = 1,
  }) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: TextStyle(
            fontSize: 13,
            fontWeight: FontWeight.bold,
            color: Colors.grey.shade700,
          ),
        ),
        const SizedBox(height: 8),
        if (isEditing)
          TextField(
            controller: controller,
            maxLines: maxLines,
            keyboardType: keyboardType,
            decoration: InputDecoration(
              prefixIcon: Icon(icon, color: const Color(0xFFC62828)),
              filled: true,
              fillColor: Colors.grey.shade50,
              border: OutlineInputBorder(
                borderRadius: BorderRadius.circular(12),
                borderSide: BorderSide(color: Colors.grey.shade300),
              ),
              enabledBorder: OutlineInputBorder(
                borderRadius: BorderRadius.circular(12),
                borderSide: BorderSide(color: Colors.grey.shade300),
              ),
              focusedBorder: OutlineInputBorder(
                borderRadius: BorderRadius.circular(12),
                borderSide: const BorderSide(
                  color: Color(0xFFC62828),
                  width: 2,
                ),
              ),
              contentPadding: const EdgeInsets.symmetric(
                horizontal: 15,
                vertical: 12,
              ),
            ),
          )
        else
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 15, vertical: 12),
            decoration: BoxDecoration(
              color: Colors.grey.shade50,
              borderRadius: BorderRadius.circular(12),
              border: Border.all(color: Colors.grey.shade200),
            ),
            child: Row(
              children: [
                Icon(icon, color: const Color(0xFFC62828), size: 20),
                const SizedBox(width: 12),
                Expanded(
                  child: Text(
                    value.isEmpty ? '-' : value,
                    style: TextStyle(
                      fontSize: 14,
                      color: Colors.grey.shade800,
                      fontWeight: FontWeight.w500,
                    ),
                  ),
                ),
              ],
            ),
          ),
      ],
    );
  }

  Widget _buildNotificationToggle(
    String title,
    String subtitle,
    IconData icon,
    bool value,
    Function(bool) onChanged,
  ) {
    return Container(
      padding: const EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: Colors.grey.shade50,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: Colors.grey.shade200),
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(8),
            decoration: BoxDecoration(
              color: const Color(0xFFC62828).withOpacity(0.1),
              borderRadius: BorderRadius.circular(8),
            ),
            child: Icon(icon, color: const Color(0xFFC62828), size: 20),
          ),
          const SizedBox(width: 12),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  title,
                  style: const TextStyle(
                    fontSize: 14,
                    fontWeight: FontWeight.w600,
                  ),
                ),
                const SizedBox(height: 2),
                Text(
                  subtitle,
                  style: TextStyle(fontSize: 12, color: Colors.grey.shade600),
                ),
              ],
            ),
          ),
          Transform.scale(
            scale: 0.8,
            child: Switch(
              value: value,
              onChanged: onChanged,
              activeColor: const Color(0xFFC62828),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildStatCard(String label, String value, Color color) {
    return Container(
      padding: const EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: color.withOpacity(0.1),
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: color.withOpacity(0.3)),
      ),
      child: Column(
        children: [
          Text(
            value,
            style: TextStyle(
              fontSize: 24,
              fontWeight: FontWeight.bold,
              color: color,
            ),
          ),
          const SizedBox(height: 4),
          Text(
            label,
            textAlign: TextAlign.center,
            style: TextStyle(
              fontSize: 11,
              color: Colors.grey.shade700,
              fontWeight: FontWeight.w500,
            ),
          ),
        ],
      ),
    );
  }
}
