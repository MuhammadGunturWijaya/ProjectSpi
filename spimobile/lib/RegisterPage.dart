import 'package:flutter/material.dart';
import 'package:flutter/gestures.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

// ============ REGISTER PAGE ============
class RegisterPage extends StatefulWidget {
  const RegisterPage({super.key});

  @override
  State<RegisterPage> createState() => _RegisterPageState();
}

class _RegisterPageState extends State<RegisterPage>
    with SingleTickerProviderStateMixin {
  final _namaController = TextEditingController();
  final _emailController = TextEditingController();
  final _passwordController = TextEditingController();
  final _confirmPasswordController = TextEditingController();
  final _noTelpController = TextEditingController();
  final _formKey = GlobalKey<FormState>();

  bool _obscurePassword = true;
  bool _obscureConfirmPassword = true;
  bool _isLoading = false;
  bool _agreeTerms = false;

  bool _isPegawaiPolijeSelected = false;
  String? _selectedSubKategoriInternal;
  bool _isWhistleblowerSelected = false;
  bool _isMasyarakatSelected = false;

  late AnimationController _animController;
  late Animation<double> _fadeAnimation;
  late Animation<Offset> _slideAnimation;

  // API Configuration - UBAH SESUAI IP ANDA
  static const String API_BASE_URL = 'http://192.168.0.104/backend/api';

  @override
  void initState() {
    super.initState();
    _animController = AnimationController(
      duration: const Duration(milliseconds: 1000),
      vsync: this,
    );

    _fadeAnimation = Tween<double>(
      begin: 0.0,
      end: 1.0,
    ).animate(CurvedAnimation(parent: _animController, curve: Curves.easeIn));

    _slideAnimation =
        Tween<Offset>(begin: const Offset(0, 0.4), end: Offset.zero).animate(
          CurvedAnimation(parent: _animController, curve: Curves.easeOutCubic),
        );

    _animController.forward();
  }

  @override
  void dispose() {
    _namaController.dispose();
    _emailController.dispose();
    _passwordController.dispose();
    _confirmPasswordController.dispose();
    _noTelpController.dispose();
    _animController.dispose();
    super.dispose();
  }

  String _convertPegawaiRoleToLowercase(String role) {
    switch (role) {
      case 'Pimpinan':
        return 'pimpinan';
      case 'Pejabat yang Ditunjuk':
        return 'pejabat';
      case 'Pegawai':
        return 'pegawai';
      case 'Admin':
        return 'admin';
      case 'Pengawas':
        return 'pengawas';
      default:
        return role.toLowerCase();
    }
  }

  void _register() async {
    // Validasi kategori dipilih
    if (!(_isPegawaiPolijeSelected ||
        _isWhistleblowerSelected ||
        _isMasyarakatSelected)) {
      _showErrorSnackBar('Harap pilih salah satu kategori');
      return;
    }

    // Validasi form
    if (!_formKey.currentState!.validate()) {
      return;
    }

    // Validasi syarat dan ketentuan
    if (!_agreeTerms) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: const Text('Anda harus menerima Syarat dan Ketentuan'),
          backgroundColor: Colors.orange.shade600,
          behavior: SnackBarBehavior.floating,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(15),
          ),
          margin: const EdgeInsets.all(20),
        ),
      );
      return;
    }

    // Validasi pegawai role jika pegawai dipilih
    if (_isPegawaiPolijeSelected && _selectedSubKategoriInternal == null) {
      _showErrorSnackBar('Harap pilih posisi pegawai');
      return;
    }

    setState(() => _isLoading = true);

    try {
      // Tentukan user_type dan pegawai_role
      String userType = '';
      String? pegawaiRole;

      if (_isPegawaiPolijeSelected) {
        userType = 'pegawai';
        pegawaiRole = _convertPegawaiRoleToLowercase(_selectedSubKategoriInternal ?? '');
      } else if (_isWhistleblowerSelected) {
        userType = 'whistleblower';
      } else if (_isMasyarakatSelected) {
        userType = 'masyarakat';
      }

      // Siapkan data untuk dikirim ke API
      final Map<String, dynamic> requestData = {
        'name': _namaController.text.trim(),
        'email': _emailController.text.trim(),
        'password': _passwordController.text,
        'confirm_password': _confirmPasswordController.text,
        'phone': _noTelpController.text.trim(),
        'user_type': userType,
        'pegawai_role': pegawaiRole,
      };

      print('Sending request: $requestData');

      // Kirim request ke API
      final response = await http
          .post(
            Uri.parse('$API_BASE_URL/register.php'),
            headers: {
              'Content-Type': 'application/json',
            },
            body: jsonEncode(requestData),
          )
          .timeout(
            const Duration(seconds: 30),
            onTimeout: () {
              throw 'Koneksi timeout. Silakan coba lagi.';
            },
          );

      print('Response status: ${response.statusCode}');
      print('Response body: ${response.body}');

      if (!mounted) return;

      setState(() => _isLoading = false);

      // Parse response
      final Map<String, dynamic> result = jsonDecode(response.body);

      if (response.statusCode == 200 && result['status'] == 'success') {
        // Jika pegawai, tampilkan OTP dialog
        if (result['data']['user_type'] == 'pegawai' && result['data']['otp'] != null) {
          _showOTPDialog(
            otp: result['data']['otp'],
            email: result['data']['email'],
          );
        } else {
          // Untuk whistleblower dan masyarakat
          _showSuccessDialog();
        }
      } else {
        String errorMessage =
            result['message'] ?? 'Pendaftaran gagal. Silakan coba lagi.';
        _showErrorSnackBar(errorMessage);
      }
    } catch (e) {
      if (!mounted) return;
      setState(() => _isLoading = false);
      print('Error: $e');
      _showErrorSnackBar('Error: $e');
    }
  }

  void _showOTPDialog({
    required String otp,
    required String email,
  }) {
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (context) => AlertDialog(
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(20),
        ),
        title: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(10),
              decoration: BoxDecoration(
                color: Colors.blue.shade100,
                shape: BoxShape.circle,
              ),
              child: Icon(
                Icons.verified_user_rounded,
                color: Colors.blue.shade600,
                size: 28,
              ),
            ),
            const SizedBox(width: 12),
            const Expanded(child: Text('Verifikasi Pegawai')),
          ],
        ),
        content: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            mainAxisSize: MainAxisSize.min,
            children: [
              const Text(
                'Pendaftaran berhasil! Akun Anda sedang menunggu verifikasi admin.',
                style: TextStyle(fontSize: 14, fontWeight: FontWeight.w500),
              ),
              const SizedBox(height: 20),
              Container(
                padding: const EdgeInsets.all(16),
                decoration: BoxDecoration(
                  color: Colors.blue.shade50,
                  borderRadius: BorderRadius.circular(12),
                  border: Border.all(color: Colors.blue.shade200),
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const Text(
                      'Kode OTP Anda:',
                      style: TextStyle(
                        fontSize: 12,
                        fontWeight: FontWeight.w600,
                        color: Colors.grey,
                      ),
                    ),
                    const SizedBox(height: 12),
                    Center(
                      child: Container(
                        padding: const EdgeInsets.symmetric(
                          horizontal: 24,
                          vertical: 16,
                        ),
                        decoration: BoxDecoration(
                          color: Colors.white,
                          borderRadius: BorderRadius.circular(12),
                          border: Border.all(
                            color: const Color(0xFFC62828),
                            width: 2,
                          ),
                        ),
                        child: Text(
                          otp,
                          style: const TextStyle(
                            fontSize: 28,
                            fontWeight: FontWeight.bold,
                            color: Color(0xFFC62828),
                            letterSpacing: 4,
                          ),
                        ),
                      ),
                    ),
                    const SizedBox(height: 16),
                    const Text(
                      '⚠️ Berikan kode OTP ini kepada admin untuk verifikasi akun Anda. OTP berlaku selama 10 menit.',
                      style: TextStyle(
                        fontSize: 12,
                        color: Colors.orange,
                        fontWeight: FontWeight.w500,
                      ),
                    ),
                    const SizedBox(height: 12),
                    Container(
                      padding: const EdgeInsets.all(12),
                      decoration: BoxDecoration(
                        color: Colors.grey.shade100,
                        borderRadius: BorderRadius.circular(8),
                      ),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          const Text(
                            'Email Terdaftar:',
                            style: TextStyle(
                              fontSize: 11,
                              fontWeight: FontWeight.w600,
                              color: Colors.grey,
                            ),
                          ),
                          const SizedBox(height: 4),
                          Text(
                            email,
                            style: const TextStyle(
                              fontSize: 13,
                              fontWeight: FontWeight.w500,
                              color: Colors.black87,
                            ),
                          ),
                        ],
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
        actions: [
          ElevatedButton(
            onPressed: () {
              Navigator.pop(context);
              Navigator.pop(context);
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: const Color(0xFFC62828),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(10),
              ),
            ),
            child: const Text('Kembali ke Login'),
          ),
        ],
      ),
    );
  }

  void _showSuccessDialog() {
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (context) => AlertDialog(
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(20),
        ),
        title: Row(
          children: [
            Container(
              padding: const EdgeInsets.all(10),
              decoration: BoxDecoration(
                color: Colors.green.shade100,
                shape: BoxShape.circle,
              ),
              child: Icon(
                Icons.check_circle_rounded,
                color: Colors.green.shade600,
                size: 28,
              ),
            ),
            const SizedBox(width: 12),
            const Expanded(child: Text('Pendaftaran Berhasil')),
          ],
        ),
        content: const Text(
          'Akun Anda telah berhasil dibuat. Silakan login menggunakan email dan password Anda.',
        ),
        actions: [
          ElevatedButton(
            onPressed: () {
              Navigator.pop(context);
              Navigator.pop(context);
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: const Color(0xFFC62828),
            ),
            child: const Text('OK'),
          ),
        ],
      ),
    );
  }

  void _showErrorSnackBar(String message) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message),
        backgroundColor: Colors.red.shade600,
        behavior: SnackBarBehavior.floating,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(15),
        ),
        margin: const EdgeInsets.all(20),
      ),
    );
  }

  void _showTermsDialog(BuildContext context) {
    showDialog(
      context: context,
      builder: (context) {
        return AlertDialog(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(20),
          ),
          title: const Text(
            'Syarat dan Ketentuan',
            style: TextStyle(
              fontWeight: FontWeight.bold,
              color: Color(0xFFC62828),
            ),
          ),
          content: SingleChildScrollView(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: const [
                Text(
                  'Dengan mendaftar akun, Anda menyetujui hal-hal berikut:',
                  style: TextStyle(fontWeight: FontWeight.w500),
                ),
                SizedBox(height: 10),
                Text(
                  '1. Anda memberikan data yang benar, akurat, dan dapat dipertanggungjawabkan.\n\n'
                  '2. Anda bertanggung jawab atas kerahasiaan akun dan kata sandi Anda.\n\n'
                  '3. Anda tidak boleh menggunakan sistem ini untuk tujuan yang melanggar hukum, merugikan pihak lain, atau mengganggu keamanan data.\n\n'
                  '4. Pihak pengelola berhak menolak atau menonaktifkan akun yang melanggar ketentuan penggunaan.\n\n'
                  '5. Data pribadi Anda akan diproses sesuai dengan kebijakan privasi yang berlaku.',
                  style: TextStyle(fontSize: 14, height: 1.5),
                ),
              ],
            ),
          ),
          actions: [
            TextButton(
              onPressed: () => Navigator.pop(context),
              child: const Text('Tutup', style: TextStyle(color: Colors.grey)),
            ),
            ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: const Color(0xFFC62828),
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.circular(10),
                ),
              ),
              onPressed: () {
                Navigator.pop(context);
                setState(() => _agreeTerms = true);
              },
              child: const Text(
                'Saya Setuju',
                style: TextStyle(color: Colors.white),
              ),
            ),
          ],
        );
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.transparent,
      body: Container(
        decoration: BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
            colors: [
              const Color(0xFFC62828),
              const Color(0xFFD32F2F),
              const Color(0xFFFF9800).withOpacity(0.8),
            ],
            stops: const [0.0, 0.4, 1.0],
          ),
        ),
        child: SafeArea(
          child: SingleChildScrollView(
            padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 20),
            child: FadeTransition(
              opacity: _fadeAnimation,
              child: SlideTransition(
                position: _slideAnimation,
                child: Column(
                  children: [
                    // Header
                    Row(
                      children: [
                        IconButton(
                          icon: const Icon(
                            Icons.arrow_back_ios_rounded,
                            color: Colors.white,
                          ),
                          onPressed: () => Navigator.pop(context),
                        ),
                        const Expanded(
                          child: Text(
                            'Daftar Akun Baru',
                            style: TextStyle(
                              fontSize: 24,
                              fontWeight: FontWeight.bold,
                              color: Colors.white,
                            ),
                          ),
                        ),
                      ],
                    ),
                    const SizedBox(height: 10),

                    // Register Card
                    Container(
                      padding: const EdgeInsets.all(25),
                      decoration: BoxDecoration(
                        color: Colors.white,
                        borderRadius: BorderRadius.circular(25),
                        boxShadow: [
                          BoxShadow(
                            color: Colors.black.withOpacity(0.15),
                            blurRadius: 30,
                            spreadRadius: 5,
                            offset: const Offset(0, 15),
                          ),
                        ],
                      ),
                      child: Form(
                        key: _formKey,
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            // Nama Field
                            _buildInputField(
                              controller: _namaController,
                              label: 'Nama Lengkap',
                              hint: 'Masukkan nama lengkap',
                              icon: Icons.person_rounded,
                              validator: (value) {
                                if (value == null || value.isEmpty) {
                                  return 'Nama tidak boleh kosong';
                                }
                                if (value.length < 3) {
                                  return 'Nama minimal 3 karakter';
                                }
                                return null;
                              },
                            ),
                            const SizedBox(height: 18),

                            // Email Field
                            _buildInputField(
                              controller: _emailController,
                              label: 'Email',
                              hint: 'Masukkan email Anda',
                              icon: Icons.email_rounded,
                              keyboardType: TextInputType.emailAddress,
                              validator: (value) {
                                if (value == null || value.isEmpty) {
                                  return 'Email tidak boleh kosong';
                                }
                                if (!RegExp(
                                  r'^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$',
                                ).hasMatch(value)) {
                                  return 'Format email tidak valid';
                                }
                                return null;
                              },
                            ),
                            const SizedBox(height: 18),

                            // Nomor Telepon
                            _buildInputField(
                              controller: _noTelpController,
                              label: 'Nomor Telepon',
                              hint: '08xxxxxxxxxx',
                              icon: Icons.phone_rounded,
                              keyboardType: TextInputType.phone,
                              validator: (value) {
                                if (value == null || value.isEmpty) {
                                  return 'Nomor telepon tidak boleh kosong';
                                }
                                if (!RegExp(r'^[0-9]{10,}$').hasMatch(value)) {
                                  return 'Nomor telepon minimal 10 digit dan hanya angka';
                                }
                                return null;
                              },
                            ),
                            const SizedBox(height: 18),

                            // Password Field
                            _buildInputField(
                              controller: _passwordController,
                              label: 'Password',
                              hint: 'Masukkan password minimal 8 karakter',
                              icon: Icons.lock_rounded,
                              isPassword: true,
                              obscurePassword: _obscurePassword,
                              onPasswordToggle: () {
                                setState(
                                  () => _obscurePassword = !_obscurePassword,
                                );
                              },
                              validator: (value) {
                                if (value == null || value.isEmpty) {
                                  return 'Password tidak boleh kosong';
                                }
                                if (value.length < 8) {
                                  return 'Password minimal 8 karakter';
                                }
                                return null;
                              },
                            ),
                            const SizedBox(height: 18),

                            // Confirm Password Field
                            _buildInputField(
                              controller: _confirmPasswordController,
                              label: 'Konfirmasi Password',
                              hint: 'Masukkan ulang password',
                              icon: Icons.lock_rounded,
                              isPassword: true,
                              obscurePassword: _obscureConfirmPassword,
                              onPasswordToggle: () {
                                setState(
                                  () => _obscureConfirmPassword =
                                      !_obscureConfirmPassword,
                                );
                              },
                              validator: (value) {
                                if (value == null || value.isEmpty) {
                                  return 'Konfirmasi password tidak boleh kosong';
                                }
                                if (value != _passwordController.text) {
                                  return 'Password tidak sesuai';
                                }
                                return null;
                              },
                            ),
                            const SizedBox(height: 20),

                            // === KATEGORI INTERNAL ===
                            if (!_isMasyarakatSelected)
                              Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  const Text(
                                    'Kategori Internal',
                                    style: TextStyle(
                                      fontSize: 16,
                                      fontWeight: FontWeight.bold,
                                      color: Colors.black87,
                                    ),
                                  ),
                                  const SizedBox(height: 10),

                                  // Pegawai Polije
                                  if (!_isWhistleblowerSelected)
                                    Container(
                                      decoration: BoxDecoration(
                                        color: _isPegawaiPolijeSelected
                                            ? Colors.red.shade50
                                            : Colors.grey.shade100,
                                        borderRadius: BorderRadius.circular(12),
                                        border: Border.all(
                                          color: _isPegawaiPolijeSelected
                                              ? const Color(0xFFC62828)
                                              : Colors.grey.shade300,
                                        ),
                                      ),
                                      child: Column(
                                        children: [
                                          ListTile(
                                            leading: const Icon(
                                              Icons.business_center_rounded,
                                              color: Color(0xFFC62828),
                                            ),
                                            title: const Text(
                                              'Pegawai Polije',
                                              style: TextStyle(
                                                fontWeight: FontWeight.w600,
                                              ),
                                            ),
                                            trailing: Icon(
                                              _isPegawaiPolijeSelected
                                                  ? Icons
                                                        .keyboard_arrow_up_rounded
                                                  : Icons
                                                        .keyboard_arrow_down_rounded,
                                              color: Colors.grey[600],
                                            ),
                                            onTap: () {
                                              setState(() {
                                                _isPegawaiPolijeSelected =
                                                    !_isPegawaiPolijeSelected;
                                                if (_isPegawaiPolijeSelected) {
                                                  _isWhistleblowerSelected =
                                                      false;
                                                  _isMasyarakatSelected = false;
                                                } else {
                                                  _selectedSubKategoriInternal =
                                                      null;
                                                }
                                              });
                                            },
                                          ),
                                          if (_isPegawaiPolijeSelected)
                                            Padding(
                                              padding: const EdgeInsets.only(
                                                left: 20,
                                                bottom: 10,
                                                right: 10,
                                              ),
                                              child: Column(
                                                children: [
                                                  'Pimpinan',
                                                  'Pejabat yang Ditunjuk',
                                                  'Pegawai',
                                                  'Admin',
                                                  'Pengawas',
                                                ]
                                                    .map(
                                                      (e) =>
                                                          RadioListTile<String>(
                                                        value: e,
                                                        groupValue:
                                                            _selectedSubKategoriInternal,
                                                        title: Text(e),
                                                        onChanged: (val) =>
                                                            setState(
                                                              () =>
                                                                  _selectedSubKategoriInternal =
                                                                      val,
                                                            ),
                                                      ),
                                                    )
                                                    .toList(),
                                              ),
                                            ),
                                        ],
                                      ),
                                    ),
                                  const SizedBox(height: 10),
                                  // Whistleblower
                                  if (!_isPegawaiPolijeSelected)
                                    Container(
                                      decoration: BoxDecoration(
                                        color: _isWhistleblowerSelected
                                            ? Colors.red.shade50
                                            : Colors.grey.shade100,
                                        borderRadius: BorderRadius.circular(12),
                                        border: Border.all(
                                          color: _isWhistleblowerSelected
                                              ? const Color(0xFFC62828)
                                              : Colors.grey.shade300,
                                        ),
                                      ),
                                      child: CheckboxListTile(
                                        activeColor: const Color(0xFFC62828),
                                        value: _isWhistleblowerSelected,
                                        onChanged: (val) {
                                          setState(() {
                                            _isWhistleblowerSelected =
                                                val ?? false;
                                            if (_isWhistleblowerSelected) {
                                              _isPegawaiPolijeSelected = false;
                                              _selectedSubKategoriInternal =
                                                  null;
                                              _isMasyarakatSelected = false;
                                            }
                                          });
                                        },
                                        title: const Text(
                                          'Whistleblower',
                                          style: TextStyle(
                                            fontWeight: FontWeight.w600,
                                          ),
                                        ),
                                        controlAffinity:
                                            ListTileControlAffinity.leading,
                                      ),
                                    ),
                                ],
                              ),

                            // === KATEGORI EKSTERNAL ===
                            if (!_isPegawaiPolijeSelected &&
                                !_isWhistleblowerSelected)
                              Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  const SizedBox(height: 10),
                                  const Text(
                                    'Kategori Eksternal',
                                    style: TextStyle(
                                      fontSize: 16,
                                      fontWeight: FontWeight.bold,
                                      color: Colors.black87,
                                    ),
                                  ),
                                  const SizedBox(height: 10),
                                  Container(
                                    decoration: BoxDecoration(
                                      color: _isMasyarakatSelected
                                          ? Colors.red.shade50
                                          : Colors.grey.shade100,
                                      borderRadius: BorderRadius.circular(12),
                                      border: Border.all(
                                        color: _isMasyarakatSelected
                                            ? const Color(0xFFC62828)
                                            : Colors.grey.shade300,
                                      ),
                                    ),
                                    child: CheckboxListTile(
                                      activeColor: const Color(0xFFC62828),
                                      value: _isMasyarakatSelected,
                                      onChanged: (val) {
                                        setState(() {
                                          _isMasyarakatSelected = val ?? false;
                                          if (_isMasyarakatSelected) {
                                            _isPegawaiPolijeSelected = false;
                                            _selectedSubKategoriInternal = null;
                                            _isWhistleblowerSelected = false;
                                          }
                                        });
                                      },
                                      title: const Text(
                                        'Masyarakat / Non Pegawai / Instansi Lain',
                                        style: TextStyle(
                                          fontWeight: FontWeight.w600,
                                        ),
                                      ),
                                      controlAffinity:
                                          ListTileControlAffinity.leading,
                                    ),
                                  ),
                                ],
                              ),

                            const SizedBox(height: 20),

                            // Terms & Conditions Checkbox
                            CheckboxListTile(
                              value: _agreeTerms,
                              onChanged: (value) {
                                setState(() => _agreeTerms = value ?? false);
                              },
                              activeColor: const Color(0xFFC62828),
                              contentPadding: EdgeInsets.zero,
                              title: Text.rich(
                                TextSpan(
                                  children: [
                                    const TextSpan(
                                      text: 'Saya setuju dengan ',
                                      style: TextStyle(
                                        fontSize: 12,
                                        color: Colors.grey,
                                      ),
                                    ),
                                    TextSpan(
                                      text: 'Syarat dan Ketentuan',
                                      style: const TextStyle(
                                        fontSize: 12,
                                        color: Color(0xFFC62828),
                                        fontWeight: FontWeight.bold,
                                        decoration: TextDecoration.underline,
                                      ),
                                      recognizer: TapGestureRecognizer()
                                        ..onTap = () {
                                          _showTermsDialog(context);
                                        },
                                    ),
                                  ],
                                ),
                              ),
                            ),

                            const SizedBox(height: 25),

                            // Register Button
                            Container(
                              width: double.infinity,
                              height: 55,
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(15),
                                gradient: LinearGradient(
                                  colors: [
                                    const Color(0xFFC62828),
                                    const Color(0xFFEF5350),
                                    Colors.orange.shade700,
                                  ],
                                  begin: Alignment.centerLeft,
                                  end: Alignment.centerRight,
                                ),
                                boxShadow: [
                                  BoxShadow(
                                    color: Colors.red.shade700.withOpacity(0.4),
                                    blurRadius: 15,
                                    offset: const Offset(0, 8),
                                  ),
                                ],
                              ),
                              child: ElevatedButton(
                                onPressed: _isLoading ? null : _register,
                                style: ElevatedButton.styleFrom(
                                  backgroundColor: Colors.transparent,
                                  shadowColor: Colors.transparent,
                                  shape: RoundedRectangleBorder(
                                    borderRadius: BorderRadius.circular(15),
                                  ),
                                ),
                                child: _isLoading
                                    ? const SizedBox(
                                        width: 28,
                                        height: 28,
                                        child: CircularProgressIndicator(
                                          color: Colors.white,
                                          strokeWidth: 3,
                                        ),
                                      )
                                    : const Text(
                                        'DAFTAR',
                                        style: TextStyle(
                                          fontSize: 18,
                                          fontWeight: FontWeight.bold,
                                          color: Colors.white,
                                          letterSpacing: 2,
                                        ),
                                      ),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),

                    const SizedBox(height: 20),

                    // Back to Login Link
                    Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Text(
                          'Sudah punya akun? ',
                          style: TextStyle(
                            color: Colors.white.withOpacity(0.9),
                          ),
                        ),
                        TextButton(
                          onPressed: () => Navigator.pop(context),
                          child: const Text(
                            'Masuk Sekarang',
                            style: TextStyle(
                              color: Colors.white,
                              fontWeight: FontWeight.bold,
                              fontSize: 14,
                              decoration: TextDecoration.underline,
                              decorationColor: Colors.white,
                            ),
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}

// ============ WIDGET _buildInputField ============
Widget _buildInputField({
  required TextEditingController controller,
  required String label,
  required String hint,
  required IconData icon,
  TextInputType keyboardType = TextInputType.text,
  bool isPassword = false,
  bool obscurePassword = false,
  VoidCallback? onPasswordToggle,
  String? Function(String?)? validator,
}) {
  return TextFormField(
    controller: controller,
    obscureText: isPassword ? obscurePassword : false,
    keyboardType: keyboardType,
    validator: validator,
    style: const TextStyle(color: Colors.black87, fontSize: 14),
    decoration: InputDecoration(
      labelText: label,
      hintText: hint,
      hintStyle: TextStyle(color: Colors.grey.shade400, fontSize: 13),
      labelStyle: TextStyle(
        color: Colors.grey.shade600,
        fontWeight: FontWeight.w600,
        fontSize: 13,
      ),
      prefixIcon: Icon(icon, color: const Color(0xFFC62828), size: 22),
      border: OutlineInputBorder(
        borderRadius: BorderRadius.circular(15),
        borderSide: BorderSide.none,
      ),
      enabledBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(15),
        borderSide: BorderSide.none,
      ),
      focusedBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(15),
        borderSide: const BorderSide(color: Color(0xFFC62828), width: 2),
      ),
      errorBorder: OutlineInputBorder(
        borderRadius: BorderRadius.circular(15),
        borderSide: const BorderSide(color: Colors.red, width: 2),
      ),
      filled: true,
      fillColor: Colors.grey.shade100,
      suffixIcon: isPassword
          ? IconButton(
              icon: Icon(
                obscurePassword
                    ? Icons.visibility_off_outlined
                    : Icons.visibility_outlined,
                color: Colors.grey.shade600,
                size: 20,
              ),
              onPressed: onPasswordToggle,
            )
          : null,
      contentPadding: const EdgeInsets.symmetric(vertical: 16, horizontal: 20),
      errorStyle: const TextStyle(fontSize: 12),
    ),
  );
}