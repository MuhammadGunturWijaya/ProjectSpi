import 'package:flutter/material.dart';
import 'dart:io';
import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class BuatLaporanPage extends StatefulWidget {
  const BuatLaporanPage({super.key});

  @override
  State<BuatLaporanPage> createState() => _BuatLaporanPageState();
}

class _BuatLaporanPageState extends State<BuatLaporanPage> {
  final _formKey = GlobalKey<FormState>();

  // Controllers untuk text fields
  final _tanggalPengaduanController = TextEditingController();
  final _perihalController = TextEditingController();
  final _uraianSingkatController = TextEditingController();
  final _usiaController = TextEditingController();
  final _waktuTerbaikController = TextEditingController();
  final _bentukPelanggaranLainController = TextEditingController();
  final _emailController = TextEditingController();
  final _telpController = TextEditingController();
  final _whatsappController = TextEditingController();
  final _tanggalKejadianController = TextEditingController();
  final _waktuKejadianController = TextEditingController();
  final TextEditingController _pekerjaanLainController =
      TextEditingController();
  final TextEditingController _tempatLainController = TextEditingController();

  // Controllers untuk Data Terlapor
  final _namaTelaportController = TextEditingController();
  final _nipTelaportController = TextEditingController();
  final _pihakTerkaitInfoController = TextEditingController();

  // Variables untuk dropdown & checkbox
  String? _pendidikanTerakhir;
  String? _pekerjaanAnda;
  String _waktuMenghubungi = 'baik_kapan_saja';
  String? _tempatKejadian;

  // Data Terlapor
  String? _satKerjaTelapor;
  String? _jabatanTelapor;
  String? _jenisKelaminTelapor;
  List<Map<String, String>> _dataTelaportList = [];

  // Checkbox bentuk pelanggaran
  bool _isPemerasan = false;
  bool _isPenyuapan = false;
  bool _isGratifikasi = false;
  bool _isPelanggaranLain = false;

  // Checkbox cara menghubungi
  bool _hubungiEmail = false;
  bool _hubungiTelepon = false;
  bool _hubungiWhatsApp = false;

  TextEditingController _waktuLainController = TextEditingController();
  // Pernyataan dan Informasi Pihak Terkait
  String? _identitasDiketahui;

  // Upload files
  List<File> _uploadedFiles = [];

  @override
  void dispose() {
    _tanggalPengaduanController.dispose();
    _perihalController.dispose();
    _uraianSingkatController.dispose();
    _usiaController.dispose();
    _waktuTerbaikController.dispose();
    _bentukPelanggaranLainController.dispose();
    _emailController.dispose();
    _telpController.dispose();
    _whatsappController.dispose();
    _tanggalKejadianController.dispose();
    _waktuKejadianController.dispose();
    _namaTelaportController.dispose();
    _nipTelaportController.dispose();
    _pihakTerkaitInfoController.dispose();
    _pekerjaanLainController.dispose();
    _tempatLainController.dispose();
    super.dispose();
  }

  Future<void> _selectDate(
    BuildContext context,
    TextEditingController controller,
  ) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime(2020),
      lastDate: DateTime(2030),
      builder: (context, child) {
        return Theme(
          data: Theme.of(context).copyWith(
            colorScheme: const ColorScheme.light(
              primary: Color(0xFFC62828),
              onPrimary: Colors.white,
              onSurface: Colors.black,
            ),
          ),
          child: child!,
        );
      },
    );
    if (picked != null) {
      controller.text =
          "${picked.day.toString().padLeft(2, '0')}/${picked.month.toString().padLeft(2, '0')}/${picked.year}";
    }
  }

  Future<void> _selectTime(
    BuildContext context,
    TextEditingController controller,
  ) async {
    final TimeOfDay? picked = await showTimePicker(
      context: context,
      initialTime: TimeOfDay.now(),
      builder: (context, child) {
        return Theme(
          data: Theme.of(context).copyWith(
            colorScheme: const ColorScheme.light(
              primary: Color(0xFFC62828),
              onPrimary: Colors.white,
              onSurface: Colors.black,
            ),
          ),
          child: child!,
        );
      },
    );
    if (picked != null) {
      controller.text = picked.format(context);
    }
  }

  void _addTelaport() {
    if (_namaTelaportController.text.isEmpty ||
        _nipTelaportController.text.isEmpty ||
        _satKerjaTelapor == null ||
        _jabatanTelapor == null ||
        _jenisKelaminTelapor == null) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text('Lengkapi semua data terlapor terlebih dahulu'),
          backgroundColor: Colors.orange,
        ),
      );
      return;
    }

    setState(() {
      _dataTelaportList.add({
        'nama': _namaTelaportController.text,
        'nip': _nipTelaportController.text,
        'satKerja': _satKerjaTelapor!,
        'jabatan': _jabatanTelapor!,
        'jenisKelamin': _jenisKelaminTelapor!,
      });
      _namaTelaportController.clear();
      _nipTelaportController.clear();
      _satKerjaTelapor = null;
      _jabatanTelapor = null;
      _jenisKelaminTelapor = null;
    });
  }

  void _deleteTelaport(int index) {
    setState(() {
      _dataTelaportList.removeAt(index);
    });
  }

  void _pickFiles() async {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: const Text('Upload File'),
        content: const Text(
          'Fitur upload akan aktif setelah menambahkan dependency:\n\n'
          'file_picker: ^5.5.0\nimage_picker: ^1.0.4',
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: const Text('OK'),
          ),
        ],
      ),
    );
  }

  void _submitForm() {
    if (_formKey.currentState!.validate()) {
      if (!_isPemerasan &&
          !_isPenyuapan &&
          !_isGratifikasi &&
          !_isPelanggaranLain) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('Pilih minimal satu bentuk pelanggaran'),
            backgroundColor: Colors.red,
          ),
        );
        return;
      }

      if (!_hubungiEmail && !_hubungiTelepon && !_hubungiWhatsApp) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('Pilih minimal satu cara menghubungi'),
            backgroundColor: Colors.red,
          ),
        );
        return;
      }

      if (_dataTelaportList.isEmpty) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('Tambahkan minimal satu data terlapor'),
            backgroundColor: Colors.red,
          ),
        );
        return;
      }

      if (_identitasDiketahui == null) {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(
            content: Text('Pilih pernyataan identitas'),
            backgroundColor: Colors.red,
          ),
        );
        return;
      }

      _formKey.currentState!.save();

      showDialog(
        context: context,
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
                  Icons.check_circle,
                  color: Colors.green.shade600,
                  size: 30,
                ),
              ),
              const SizedBox(width: 15),
              const Expanded(
                child: Text(
                  'Laporan Berhasil Dikirim',
                  style: TextStyle(fontSize: 18),
                ),
              ),
            ],
          ),
          content: const Text(
            'Laporan Anda telah berhasil dikirim dan akan segera ditindaklanjuti oleh tim SPI.',
          ),
          actions: [
            TextButton(
              onPressed: () {
                Navigator.pop(context);
                Navigator.pop(context);
              },
              style: TextButton.styleFrom(
                foregroundColor: const Color(0xFFC62828),
              ),
              child: const Text('OK'),
            ),
          ],
        ),
      );
    }
  }

  //--------------------------------------------------------

  String _getSelectedPelanggaran() {
    List<String> pelanggaran = [];
    if (_isPemerasan) pelanggaran.add('Pemerasan / Pungutan');
    if (_isPenyuapan) pelanggaran.add('Penyuapan');
    if (_isGratifikasi) pelanggaran.add('Gratifikasi');
    if (_isPelanggaranLain)
      pelanggaran.add(_bentukPelanggaranLainController.text);
    return pelanggaran.join(', ');
  }

  String _getTerlaporList() {
    return jsonEncode(_dataTelaportList);
  }

  String _getKontak() {
    List<String> kontak = [];
    if (_hubungiEmail) kontak.add('Email');
    if (_hubungiTelepon) kontak.add('Telepon');
    if (_hubungiWhatsApp) kontak.add('WhatsApp');
    return kontak.join(', ');
  }

  Future<void> _submitFormAPI() async {
  final prefs = await SharedPreferences.getInstance();
  final userId = prefs.getString('user_id') ?? '';

  if (userId.isEmpty) return;

  // Prepare data, kosongkan field yang belum diisi
  final Map<String, dynamic> bodyData = {
    "user_id": userId,
    "tanggal_pengaduan": _tanggalPengaduanController.text,
    "perihal": _perihalController.text,
    "uraian": _uraianSingkatController.text,
    "usia": _usiaController.text,
    "pendidikan": _pendidikanTerakhir ?? "",
    "pekerjaan": _pekerjaanAnda ?? "",
    "pekerjaan_lain": _pekerjaanLainController.text,
    "waktu_hubung": _waktuTerbaikController.text,
    "waktu_lain": _waktuLainController.text,
    "pelanggaran": _getSelectedPelanggaran() ?? [],
    "pelanggaran_lain": _bentukPelanggaranLainController.text,
    "kontak": _getKontak() ?? [],
    "tanggal_kejadian": _tanggalKejadianController.text,
    "jam_kejadian": _waktuKejadianController.text,
    "tempat_kejadian": _tempatKejadian ?? "",
    "tempat_lain": _tempatLainController.text,
    "terlapor": jsonEncode(_getTerlaporList() ?? []),
    "identitas_diketahui": _identitasDiketahui ?? "",
    "pihak_terkait": _pihakTerkaitInfoController.text,
  };

  try {
    final response = await http.post(
      Uri.parse('http://10.133.104.213/backend/api/submit_pengaduan.php'),
      headers: {"Content-Type": "application/json"},
      body: jsonEncode(bodyData),
    );

    final data = jsonDecode(response.body);

    if (data['status'] == 'success') {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(content: Text('Laporan berhasil dikirim!')),
      );
      Navigator.pop(context); // Kembali ke halaman sebelumnya
    } else {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Gagal: ${data['message']}')),
      );
    }
  } catch (e) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text('Error: $e')),
    );
  }
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
          'Buat Laporan Baru',
          style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
        ),
        centerTitle: true,
      ),
      body: Form(
        key: _formKey,
        child: SingleChildScrollView(
          physics: const BouncingScrollPhysics(),
          child: Column(
            children: [
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
                    Icon(
                      Icons.report_gmailerrorred_rounded,
                      size: 60,
                      color: Colors.white.withOpacity(0.9),
                    ),
                    const SizedBox(height: 10),
                    const Text(
                      'Formulir Pengaduan',
                      style: TextStyle(
                        fontSize: 22,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                    const SizedBox(height: 5),
                    Text(
                      'Isi form dengan lengkap dan jelas',
                      style: TextStyle(
                        fontSize: 14,
                        color: Colors.white.withOpacity(0.9),
                      ),
                    ),
                  ],
                ),
              ),

              const SizedBox(height: 20),

              _buildSectionCard('URAIAN PENGADUAN', Icons.description_rounded, [
                _buildDateField(
                  'Tanggal Pengaduan',
                  _tanggalPengaduanController,
                  Icons.calendar_today_rounded,
                ),
                const SizedBox(height: 15),
                _buildTextField(
                  'Perihal',
                  _perihalController,
                  Icons.title_rounded,
                  'Masukkan perihal pengaduan',
                  maxLines: 1,
                ),
                const SizedBox(height: 15),
                _buildTextField(
                  'Uraian Singkat',
                  _uraianSingkatController,
                  Icons.notes_rounded,
                  'Jelaskan kronologi kejadian secara singkat',
                  maxLines: 5,
                ),
                const SizedBox(height: 15),
                _buildUploadSection(),
              ]),

              const SizedBox(height: 20),

              _buildSectionCard(
                'INFORMASI PENDUKUNG',
                Icons.info_outline_rounded,
                [
                  _buildTextField(
                    'Usia Anda',
                    _usiaController,
                    Icons.cake_rounded,
                    'Masukkan usia (contoh: 25)',
                    keyboardType: TextInputType.number,
                    maxLines: 1,
                  ),
                  const SizedBox(height: 15),
                  _buildDropdown(
                    'Pendidikan Terakhir',
                    _pendidikanTerakhir,
                    ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'],
                    Icons.school_rounded,
                    (value) => setState(() => _pendidikanTerakhir = value),
                  ),
                  const SizedBox(height: 15),
                  _buildDropdown(
                    'Pekerjaan Anda',
                    _pekerjaanAnda,
                    [
                      'Advokat',
                      'Pegawai Swasta',
                      'Wirausaha',
                      'Pegawai Negeri Sipil',
                    ],
                    Icons.work_outline_rounded,
                    (value) => setState(() => _pekerjaanAnda = value),
                  ),
                  const SizedBox(height: 15),
                  _buildWaktuMenghubungi(),
                ],
              ),

              const SizedBox(height: 20),

              _buildSectionCard(
                'BENTUK PELANGGARAN & CARA MENGHUBUNGI',
                Icons.warning_amber_rounded,
                [
                  Text(
                    'Bentuk pelanggaran yang akan Anda laporkan?',
                    style: TextStyle(
                      fontSize: 14,
                      fontWeight: FontWeight.bold,
                      color: Colors.grey.shade800,
                    ),
                  ),
                  const SizedBox(height: 10),
                  _buildCheckbox(
                    'Pemerasan / Pungutan',
                    _isPemerasan,
                    (val) => setState(() => _isPemerasan = val!),
                  ),
                  _buildCheckbox(
                    'Penyuapan',
                    _isPenyuapan,
                    (val) => setState(() => _isPenyuapan = val!),
                  ),
                  _buildCheckbox(
                    'Gratifikasi',
                    _isGratifikasi,
                    (val) => setState(() => _isGratifikasi = val!),
                  ),
                  _buildCheckbox(
                    'Lainnya',
                    _isPelanggaranLain,
                    (val) => setState(() => _isPelanggaranLain = val!),
                  ),
                  if (_isPelanggaranLain) ...[
                    const SizedBox(height: 10),
                    _buildTextField(
                      'Sebutkan bentuk pelanggaran lainnya',
                      _bentukPelanggaranLainController,
                      Icons.edit_note_rounded,
                      'Jelaskan bentuk pelanggaran',
                      maxLines: 2,
                    ),
                  ],
                  const SizedBox(height: 20),
                  Text(
                    'Bagaimana kami menghubungi Anda?',
                    style: TextStyle(
                      fontSize: 14,
                      fontWeight: FontWeight.bold,
                      color: Colors.grey.shade800,
                    ),
                  ),
                  const SizedBox(height: 10),
                  _buildCheckbox(
                    'Email',
                    _hubungiEmail,
                    (val) => setState(() => _hubungiEmail = val!),
                  ),
                  if (_hubungiEmail) ...[
                    const SizedBox(height: 10),
                    _buildTextField(
                      'Alamat Email',
                      _emailController,
                      Icons.email_rounded,
                      'contoh@email.com',
                      keyboardType: TextInputType.emailAddress,
                    ),
                  ],
                  _buildCheckbox(
                    'Telepon / Handphone',
                    _hubungiTelepon,
                    (val) => setState(() => _hubungiTelepon = val!),
                  ),
                  if (_hubungiTelepon) ...[
                    const SizedBox(height: 10),
                    _buildTextField(
                      'Nomor Telepon',
                      _telpController,
                      Icons.phone_rounded,
                      '08xxxxxxxxxx',
                      keyboardType: TextInputType.phone,
                    ),
                  ],
                  _buildCheckbox(
                    'WhatsApp',
                    _hubungiWhatsApp,
                    (val) => setState(() => _hubungiWhatsApp = val!),
                  ),
                  if (_hubungiWhatsApp) ...[
                    const SizedBox(height: 10),
                    _buildTextField(
                      'Nomor WhatsApp',
                      _whatsappController,
                      Icons.chat_bubble_rounded,
                      '08xxxxxxxxxx',
                      keyboardType: TextInputType.phone,
                    ),
                  ],
                ],
              ),

              const SizedBox(height: 20),

              _buildSectionCard(
                'TEMPAT & PERKIRAAN WAKTU KEJADIAN',
                Icons.location_on_rounded,
                [
                  _buildDateField(
                    'Tanggal Kejadian',
                    _tanggalKejadianController,
                    Icons.event_rounded,
                  ),
                  const SizedBox(height: 15),
                  _buildTimeField(
                    'Waktu / Jam Kejadian',
                    _waktuKejadianController,
                    Icons.access_time_rounded,
                  ),
                  const SizedBox(height: 15),
                  _buildDropdown(
                    'Tempat Kejadian',
                    _tempatKejadian,
                    ['GOR', 'Gedung A3', 'Gedung TI', 'Lainnya'],
                    Icons.business_rounded,
                    (value) => setState(() => _tempatKejadian = value),
                  ),
                ],
              ),

              const SizedBox(height: 20),

              // DATA TERLAPOR SECTION
              _buildSectionCard('DATA TERLAPOR', Icons.people_rounded, [
                _buildTextField(
                  'Nama Terlapor',
                  _namaTelaportController,
                  Icons.person_rounded,
                  'Masukkan nama lengkap',
                  maxLines: 1,
                ),
                const SizedBox(height: 15),
                _buildTextField(
                  'NIP',
                  _nipTelaportController,
                  Icons.badge_rounded,
                  'Masukkan NIP',
                  maxLines: 1,
                ),
                const SizedBox(height: 15),
                _buildDropdown(
                  'Satuan Kerja',
                  _satKerjaTelapor,
                  ['Balikpapan', 'Jember', 'Aceh'],
                  Icons.apartment_rounded,
                  (value) => setState(() => _satKerjaTelapor = value),
                ),
                const SizedBox(height: 15),
                _buildDropdown(
                  'Jabatan',
                  _jabatanTelapor,
                  ['Hakim', 'Jaksa', 'Sekretaris'],
                  Icons.work_outline_rounded,
                  (value) => setState(() => _jabatanTelapor = value),
                ),
                const SizedBox(height: 15),
                _buildDropdown(
                  'Jenis Kelamin',
                  _jenisKelaminTelapor,
                  ['Laki-laki', 'Perempuan', 'Tidak Diketahui'],
                  Icons.wc_rounded,
                  (value) => setState(() => _jenisKelaminTelapor = value),
                ),
                const SizedBox(height: 15),
                SizedBox(
                  width: double.infinity,
                  child: ElevatedButton.icon(
                    onPressed: _addTelaport,
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.blue.shade600,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12),
                      ),
                      padding: const EdgeInsets.symmetric(vertical: 12),
                    ),
                    icon: const Icon(Icons.add_rounded),
                    label: const Text(
                      'Tambah Terlapor',
                      style: TextStyle(fontWeight: FontWeight.bold),
                    ),
                  ),
                ),
                if (_dataTelaportList.isNotEmpty) ...[
                  const SizedBox(height: 20),
                  SingleChildScrollView(
                    scrollDirection: Axis.horizontal,
                    child: DataTable(
                      columns: const [
                        DataColumn(
                          label: Text(
                            'No',
                            style: TextStyle(fontWeight: FontWeight.bold),
                          ),
                        ),
                        DataColumn(
                          label: Text(
                            'Nama',
                            style: TextStyle(fontWeight: FontWeight.bold),
                          ),
                        ),
                        DataColumn(
                          label: Text(
                            'NIP',
                            style: TextStyle(fontWeight: FontWeight.bold),
                          ),
                        ),
                        DataColumn(
                          label: Text(
                            'Satuan Kerja',
                            style: TextStyle(fontWeight: FontWeight.bold),
                          ),
                        ),
                        DataColumn(
                          label: Text(
                            'Jabatan',
                            style: TextStyle(fontWeight: FontWeight.bold),
                          ),
                        ),
                        DataColumn(
                          label: Text(
                            'Jenis Kelamin',
                            style: TextStyle(fontWeight: FontWeight.bold),
                          ),
                        ),
                        DataColumn(
                          label: Text(
                            'Aksi',
                            style: TextStyle(fontWeight: FontWeight.bold),
                          ),
                        ),
                      ],
                      rows: List<DataRow>.generate(_dataTelaportList.length, (
                        index,
                      ) {
                        final data = _dataTelaportList[index];
                        return DataRow(
                          cells: [
                            DataCell(Text('${index + 1}')),
                            DataCell(Text(data['nama'] ?? '')),
                            DataCell(Text(data['nip'] ?? '')),
                            DataCell(Text(data['satKerja'] ?? '')),
                            DataCell(Text(data['jabatan'] ?? '')),
                            DataCell(Text(data['jenisKelamin'] ?? '')),
                            DataCell(
                              IconButton(
                                icon: Icon(
                                  Icons.delete_rounded,
                                  color: Colors.red.shade600,
                                ),
                                onPressed: () => _deleteTelaport(index),
                              ),
                            ),
                          ],
                        );
                      }),
                    ),
                  ),
                ],
              ]),

              const SizedBox(height: 20),

              // PERNYATAAN SECTION
              _buildSectionCard(
                'PERNYATAAN & INFORMASI PIHAK TERKAIT',
                Icons.announcement_rounded,
                [
                  Text(
                    'Apakah untuk pengaduan ini, identitas Anda ingin diketahui terlapor?',
                    style: TextStyle(
                      fontSize: 14,
                      fontWeight: FontWeight.bold,
                      color: Colors.grey.shade800,
                    ),
                  ),
                  const SizedBox(height: 10),
                  _buildRadioTile(
                    'Ya',
                    'ya',
                    _identitasDiketahui,
                    (value) => setState(() => _identitasDiketahui = value),
                  ),
                  _buildRadioTile(
                    'Tidak',
                    'tidak',
                    _identitasDiketahui,
                    (value) => setState(() => _identitasDiketahui = value),
                  ),
                  const SizedBox(height: 20),
                  _buildTextField(
                    'Sebutkan Pihak Terkait & Informasi Kontak',
                    _pihakTerkaitInfoController,
                    Icons.contacts_rounded,
                    'Nama, kontak, dan informasi pihak terkait yang memiliki informasi pendukung',
                    maxLines: 4,
                  ),
                ],
              ),

              const SizedBox(height: 30),

              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 20),
                child: SizedBox(
                  width: double.infinity,
                  height: 55,
                  child: ElevatedButton(
                    onPressed: _submitFormAPI, // panggil fungsi submit di sini
                    style: ElevatedButton.styleFrom(
                      backgroundColor: const Color(0xFFC62828),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(15),
                      ),
                      elevation: 5,
                      shadowColor: Colors.red.shade300,
                    ),
                    child: const Row(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Icon(Icons.send_rounded, color: Colors.white),
                        SizedBox(width: 10),
                        Text(
                          'Kirim Laporan',
                          style: TextStyle(
                            fontSize: 16,
                            fontWeight: FontWeight.bold,
                            color: Colors.white,
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
              ),
              const SizedBox(height: 40),
            ],
          ),
        ),
      ),
    );
  }

  // Widget Builders
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
              Expanded(
                child: Text(
                  title,
                  style: TextStyle(
                    fontSize: 16,
                    fontWeight: FontWeight.bold,
                    color: Colors.grey.shade800,
                  ),
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

  Widget _buildTextField(
    String label,
    TextEditingController controller,
    IconData icon,
    String hint, {
    int maxLines = 1,
    TextInputType keyboardType = TextInputType.text,
  }) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: TextStyle(
            fontSize: 14,
            fontWeight: FontWeight.bold,
            color: Colors.grey.shade700,
          ),
        ),
        const SizedBox(height: 8),
        TextFormField(
          controller: controller,
          maxLines: maxLines,
          keyboardType: keyboardType,
          decoration: InputDecoration(
            hintText: hint,
            hintStyle: TextStyle(color: Colors.grey.shade400, fontSize: 14),
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
              borderSide: const BorderSide(color: Color(0xFFC62828), width: 2),
            ),
            contentPadding: const EdgeInsets.symmetric(
              horizontal: 15,
              vertical: 15,
            ),
          ),
          validator: (value) {
            if (value == null || value.isEmpty) {
              return '$label tidak boleh kosong';
            }
            return null;
          },
        ),
      ],
    );
  }

  Widget _buildDateField(
    String label,
    TextEditingController controller,
    IconData icon,
  ) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: TextStyle(
            fontSize: 14,
            fontWeight: FontWeight.bold,
            color: Colors.grey.shade700,
          ),
        ),
        const SizedBox(height: 8),
        TextFormField(
          controller: controller,
          readOnly: true,
          onTap: () => _selectDate(context, controller),
          decoration: InputDecoration(
            hintText: 'Pilih tanggal',
            hintStyle: TextStyle(color: Colors.grey.shade400, fontSize: 14),
            prefixIcon: Icon(icon, color: const Color(0xFFC62828)),
            suffixIcon: const Icon(Icons.arrow_drop_down_rounded),
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
              borderSide: const BorderSide(color: Color(0xFFC62828), width: 2),
            ),
          ),
          validator: (value) {
            if (value == null || value.isEmpty) {
              return '$label tidak boleh kosong';
            }
            return null;
          },
        ),
      ],
    );
  }

  Widget _buildTimeField(
    String label,
    TextEditingController controller,
    IconData icon,
  ) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: TextStyle(
            fontSize: 14,
            fontWeight: FontWeight.bold,
            color: Colors.grey.shade700,
          ),
        ),
        const SizedBox(height: 8),
        TextFormField(
          controller: controller,
          readOnly: true,
          onTap: () => _selectTime(context, controller),
          decoration: InputDecoration(
            hintText: 'Pilih waktu',
            hintStyle: TextStyle(color: Colors.grey.shade400, fontSize: 14),
            prefixIcon: Icon(icon, color: const Color(0xFFC62828)),
            suffixIcon: const Icon(Icons.arrow_drop_down_rounded),
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
              borderSide: const BorderSide(color: Color(0xFFC62828), width: 2),
            ),
          ),
          validator: (value) {
            if (value == null || value.isEmpty) {
              return '$label tidak boleh kosong';
            }
            return null;
          },
        ),
      ],
    );
  }

  Widget _buildDropdown(
    String label,
    String? value,
    List<String> items,
    IconData icon,
    Function(String?) onChanged,
  ) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: TextStyle(
            fontSize: 14,
            fontWeight: FontWeight.bold,
            color: Colors.grey.shade700,
          ),
        ),
        const SizedBox(height: 8),
        DropdownButtonFormField<String>(
          value: value,
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
              borderSide: const BorderSide(color: Color(0xFFC62828), width: 2),
            ),
          ),
          hint: Text(
            'Pilih $label',
            style: TextStyle(color: Colors.grey.shade400, fontSize: 14),
          ),
          items: items.map((String item) {
            return DropdownMenuItem<String>(value: item, child: Text(item));
          }).toList(),
          onChanged: onChanged,
          validator: (value) {
            if (value == null || value.isEmpty) {
              return '$label tidak boleh kosong';
            }
            return null;
          },
        ),
      ],
    );
  }

  Widget _buildWaktuMenghubungi() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          'Waktu terbaik untuk kami menghubungi Anda',
          style: TextStyle(
            fontSize: 14,
            fontWeight: FontWeight.bold,
            color: Colors.grey.shade700,
          ),
        ),
        const SizedBox(height: 10),
        RadioListTile<String>(
          title: const Text('Baik kapan saja'),
          value: 'baik_kapan_saja',
          groupValue: _waktuMenghubungi,
          activeColor: const Color(0xFFC62828),
          onChanged: (value) {
            setState(() => _waktuMenghubungi = value!);
          },
          contentPadding: EdgeInsets.zero,
        ),
        RadioListTile<String>(
          title: const Text('Sebaiknya di waktu berikut'),
          value: 'waktu_tertentu',
          groupValue: _waktuMenghubungi,
          activeColor: const Color(0xFFC62828),
          onChanged: (value) {
            setState(() => _waktuMenghubungi = value!);
          },
          contentPadding: EdgeInsets.zero,
        ),
        if (_waktuMenghubungi == 'waktu_tertentu') ...[
          const SizedBox(height: 10),
          _buildTextField(
            'Tentukan waktu',
            _waktuTerbaikController,
            Icons.schedule_rounded,
            'Contoh: Senin-Jumat, 09.00-17.00 WIB',
            maxLines: 2,
          ),
        ],
      ],
    );
  }

  Widget _buildCheckbox(String title, bool value, Function(bool?) onChanged) {
    return CheckboxListTile(
      title: Text(
        title,
        style: TextStyle(fontSize: 14, color: Colors.grey.shade800),
      ),
      value: value,
      activeColor: const Color(0xFFC62828),
      onChanged: onChanged,
      controlAffinity: ListTileControlAffinity.leading,
      contentPadding: EdgeInsets.zero,
    );
  }

  Widget _buildRadioTile(
    String title,
    String value,
    String? groupValue,
    Function(String?) onChanged,
  ) {
    return RadioListTile<String>(
      title: Text(
        title,
        style: TextStyle(fontSize: 14, color: Colors.grey.shade800),
      ),
      value: value,
      groupValue: groupValue,
      activeColor: const Color(0xFFC62828),
      onChanged: onChanged,
      contentPadding: EdgeInsets.zero,
    );
  }

  Widget _buildUploadSection() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          'Upload File / Foto / Video (Opsional)',
          style: TextStyle(
            fontSize: 14,
            fontWeight: FontWeight.bold,
            color: Colors.grey.shade700,
          ),
        ),
        const SizedBox(height: 8),
        InkWell(
          onTap: _pickFiles,
          borderRadius: BorderRadius.circular(12),
          child: Container(
            padding: const EdgeInsets.all(20),
            decoration: BoxDecoration(
              color: Colors.grey.shade50,
              borderRadius: BorderRadius.circular(12),
              border: Border.all(
                color: Colors.grey.shade300,
                width: 2,
                style: BorderStyle.solid,
              ),
            ),
            child: Column(
              children: [
                Icon(
                  Icons.cloud_upload_rounded,
                  size: 50,
                  color: const Color(0xFFC62828).withOpacity(0.7),
                ),
                const SizedBox(height: 10),
                Text(
                  'Tap untuk upload file',
                  style: TextStyle(
                    fontSize: 14,
                    fontWeight: FontWeight.w600,
                    color: Colors.grey.shade700,
                  ),
                ),
                const SizedBox(height: 5),
                Text(
                  'Format: JPG, PNG, PDF, MP4, DOC',
                  style: TextStyle(fontSize: 12, color: Colors.grey.shade500),
                ),
                Text(
                  'Maksimal 10 MB per file',
                  style: TextStyle(fontSize: 12, color: Colors.grey.shade500),
                ),
              ],
            ),
          ),
        ),
        if (_uploadedFiles.isNotEmpty) ...[
          const SizedBox(height: 15),
          Text(
            'File yang diupload:',
            style: TextStyle(
              fontSize: 13,
              fontWeight: FontWeight.w600,
              color: Colors.grey.shade700,
            ),
          ),
          const SizedBox(height: 8),
          ListView.builder(
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            itemCount: _uploadedFiles.length,
            itemBuilder: (context, index) {
              return Container(
                margin: const EdgeInsets.only(bottom: 8),
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: Colors.green.shade50,
                  borderRadius: BorderRadius.circular(10),
                  border: Border.all(color: Colors.green.shade200),
                ),
                child: Row(
                  children: [
                    Icon(
                      Icons.insert_drive_file_rounded,
                      color: Colors.green.shade600,
                      size: 24,
                    ),
                    const SizedBox(width: 10),
                    Expanded(
                      child: Text(
                        _uploadedFiles[index].path.split('/').last,
                        style: TextStyle(
                          fontSize: 13,
                          color: Colors.grey.shade800,
                        ),
                        overflow: TextOverflow.ellipsis,
                      ),
                    ),
                    IconButton(
                      icon: Icon(
                        Icons.close_rounded,
                        color: Colors.red.shade600,
                        size: 20,
                      ),
                      onPressed: () {
                        setState(() {
                          _uploadedFiles.removeAt(index);
                        });
                      },
                    ),
                  ],
                ),
              );
            },
          ),
        ],
      ],
    );
  }
}
