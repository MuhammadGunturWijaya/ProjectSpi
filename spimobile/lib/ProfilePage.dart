import 'package:flutter/material.dart';

class ProfilePage extends StatefulWidget {
  const ProfilePage({super.key});

  @override
  State<ProfilePage> createState() => _ProfilePageState();
}

class _ProfilePageState extends State<ProfilePage> {
  // User data
  String _nama = 'Budi Santoso';
  String _email = 'budi.santoso@example.com';
  String _nomorTelepon = '081234567890';
  String _alamat = 'Jl. Merpati No. 45, Jember, Jawa Timur 68121';
  String _pekerjaan = 'Pegawai Swasta';
  String _usia = '35';
  String _pendidikan = 'S1';

  bool _isEditing = false;
  bool _notifikasiEmail = true;
  bool _notifikasiTelepon = false;
  bool _notifikasiWhatsApp = true;

  final _namaController = TextEditingController();
  final _emailController = TextEditingController();
  final _telpController = TextEditingController();
  final _alamatController = TextEditingController();

  @override
  void initState() {
    super.initState();
    _loadUserData();
  }

  void _loadUserData() {
    _namaController.text = _nama;
    _emailController.text = _email;
    _telpController.text = _nomorTelepon;
    _alamatController.text = _alamat;
  }

  void _saveChanges() {
    if (_namaController.text.isEmpty ||
        _emailController.text.isEmpty ||
        _telpController.text.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text('Semua field wajib diisi'),
          backgroundColor: Colors.orange,
        ),
      );
      return;
    }

    setState(() {
      _nama = _namaController.text;
      _email = _emailController.text;
      _nomorTelepon = _telpController.text;
      _alamat = _alamatController.text;
      _isEditing = false;
    });

    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(
        content: Text('Profil berhasil diperbarui'),
        backgroundColor: Colors.green,
      ),
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
          style: TextStyle(
            color: Colors.white,
            fontWeight: FontWeight.bold,
          ),
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
                _loadUserData();
                setState(() => _isEditing = false);
              },
            ),
        ],
      ),
      body: SingleChildScrollView(
        physics: const BouncingScrollPhysics(),
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
                  colors: [
                    const Color(0xFFC62828),
                    Colors.red.shade400,
                  ],
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
                            _nama.substring(0, 1).toUpperCase(),
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
                              border: Border.all(color: Colors.white, width: 2),
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
                ],
              ),
            ),

            const SizedBox(height: 20),

            // Informasi Pribadi
            _buildSectionCard(
              'INFORMASI PRIBADI',
              Icons.person_rounded,
              [
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
              ],
            ),

            const SizedBox(height: 20),

            // Informasi Tambahan
            _buildSectionCard(
              'INFORMASI TAMBAHAN',
              Icons.info_outline_rounded,
              [
                _buildReadOnlyField('Pekerjaan', _pekerjaan, Icons.work_outline_rounded),
                const SizedBox(height: 15),
                _buildReadOnlyField('Usia', _usia, Icons.cake_rounded),
                const SizedBox(height: 15),
                _buildReadOnlyField('Pendidikan', _pendidikan, Icons.school_rounded),
              ],
            ),

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
                      child: _buildStatCard('Total Laporan', '5', Colors.blue),
                    ),
                    const SizedBox(width: 12),
                    Expanded(
                      child: _buildStatCard('Diproses', '2', Colors.orange),
                    ),
                    const SizedBox(width: 12),
                    Expanded(
                      child: _buildStatCard('Selesai', '3', Colors.green),
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
                                  ScaffoldMessenger.of(context).showSnackBar(
                                    const SnackBar(
                                      content: Text('Password berhasil diubah'),
                                      backgroundColor: Colors.green,
                                    ),
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
                                onPressed: () => Navigator.pop(context),
                                child: const Text('Batal'),
                              ),
                              ElevatedButton(
                                onPressed: () {
                                  Navigator.pop(context);
                                  ScaffoldMessenger.of(context).showSnackBar(
                                    const SnackBar(
                                      content: Text('Logout berhasil'),
                                      backgroundColor: Colors.green,
                                    ),
                                  );
                                  // TODO: Implementasi logout logic
                                  // Navigator.of(context)
                                  //     .pushReplacementNamed('/login');
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
                        side: const BorderSide(
                          color: Colors.red,
                          width: 2,
                        ),
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
    );
  }

  Widget _buildSectionCard(
    String title,
    IconData icon,
    List<Widget> children,
  ) {
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
                child: Icon(
                  icon,
                  color: const Color(0xFFC62828),
                  size: 24,
                ),
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
                    value,
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

  Widget _buildReadOnlyField(String label, String value, IconData icon) {
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
              Text(
                value,
                style: TextStyle(
                  fontSize: 14,
                  color: Colors.grey.shade800,
                  fontWeight: FontWeight.w500,
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
            child: Icon(
              icon,
              color: const Color(0xFFC62828),
              size: 20,
            ),
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
                  style: TextStyle(
                    fontSize: 12,
                    color: Colors.grey.shade600,
                  ),
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