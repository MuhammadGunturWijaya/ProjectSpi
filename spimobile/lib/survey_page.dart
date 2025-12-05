import 'dart:async';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class SurveyPage extends StatefulWidget {
  const SurveyPage({super.key});

  @override
  State<SurveyPage> createState() => _SurveyPageState();
}

class _SurveyPageState extends State<SurveyPage> {
  final PageController _pageController = PageController();
  final GlobalKey<FormState> _dataDiriFormKey = GlobalKey<FormState>();

  // Variabel Data Diri
  String? _jenisKelamin;
  String? _pendidikan;
  final TextEditingController _pekerjaanController = TextEditingController();
  DateTime _tanggalMengisi = DateTime.now();

  // Variabel Jawaban Survey (1 sampai 9)
  final List<int?> _jawabanValues = List.filled(9, null);

  // Daftar Pertanyaan
  final List<String> _questions = [
    'Saya mendapatkan kemudahan informasi tentang persyaratan pelayanan yang harus dipenuhi.', 
    'Bagaimana kualitas pelayanan kami?', 
    'Bagaimana kecepatan tanggapan kami?', 
    'Seberapa puas Anda secara keseluruhan?', 
    'Pertanyaan 5: Seberapa mudah Anda menemukan informasi yang relevan?', 
    'Pertanyaan 6: Bagaimana kejelasan prosedur pelayanan?', 
    'Pertanyaan 7: Apakah petugas memberikan pelayanan dengan ramah?', 
    'Pertanyaan 8: Apakah hasil pelayanan sesuai harapan Anda?', 
    'Pertanyaan 9: Apakah Anda akan merekomendasikan layanan ini kepada orang lain?', 
  ];

  // Opsi Jawaban (Rating 1-4)
  final List<Map<String, dynamic>> _ratingOptions = [
    {'label': 'Sangat Puas', 'value': 4, 'icon': '🤩', 'mainColor': Colors.green.shade700}, 
    {'label': 'Puas', 'value': 3, 'icon': '😊', 'mainColor': Colors.amber.shade700}, 
    {'label': 'Cukup Puas', 'value': 2, 'icon': '😐', 'mainColor': Colors.deepOrange.shade600}, 
    {'label': 'Kurang Puas', 'value': 1, 'icon': '😔', 'mainColor': Colors.red.shade700}, 
  ];

  bool _isSubmitting = false;

  @override
  void dispose() {
    _pageController.dispose();
    _pekerjaanController.dispose();
    super.dispose();
  }

  /// ➡️ Pindah ke Halaman/Langkah berikutnya
  void _nextPage() {
    if (_pageController.page == 0) {
      if (!_dataDiriFormKey.currentState!.validate() || _jenisKelamin == null || _pendidikan == null) {
        _showSnackbar('Mohon lengkapi semua Data Diri.', Colors.red);
        return;
      }
    } else {
      int currentQuestionIndex = (_pageController.page! - 1).toInt();
      if (_jawabanValues[currentQuestionIndex] == null) {
        _showSnackbar('Mohon pilih jawaban untuk pertanyaan ini.', Colors.red);
        return;
      }
    }

    if (_pageController.page! < _questions.length) {
      _pageController.nextPage(
        duration: const Duration(milliseconds: 400),
        curve: Curves.easeInOut,
      );
    } else {
      _submitSurvey();
    }
  }

  /// ⬅️ Pindah ke Halaman/Langkah sebelumnya
  void _previousPage() {
    if (_pageController.page! > 0) {
      _pageController.previousPage(
        duration: const Duration(milliseconds: 400),
        curve: Curves.easeInOut,
      );
    }
  }

  /// 🚀 Fungsi untuk kirim data ke API
  Future<void> _submitSurvey() async {
  if (_jawabanValues.contains(null)) {
    _showSnackbar('Mohon jawab semua pertanyaan survey.', Colors.red);
    return;
  }

  setState(() => _isSubmitting = true);

  try {
    final Map<String, dynamic> body = {
      'jenis_kelamin': _jenisKelamin,
      'pendidikan': _pendidikan,
      'pekerjaan': _pekerjaanController.text.trim(),
      'tanggal': _tanggalMengisi.toIso8601String().split('T')[0], // Format: YYYY-MM-DD
      for (int i = 0; i < 9; i++) 'jawaban_${i + 1}': _jawabanValues[i],
    };

    print('📤 Mengirim survey: ${jsonEncode(body)}');

    final response = await http.post(
      Uri.parse('http://localhost/backend/api/survey.php'), // Untuk Android emulator
      // Uri.parse('http://localhost/backend/api/survey.php'), // Untuk web
      headers: {
        'Content-Type': 'application/json; charset=utf-8',
        'Accept': 'application/json',
      },
      body: jsonEncode(body),
    ).timeout(const Duration(seconds: 10));

    print('📥 Status: ${response.statusCode}');
    print('📥 Body: ${response.body}');

    final Map<String, dynamic> data = jsonDecode(response.body);

    if (response.statusCode == 201 || response.statusCode == 200) {
      if (data['status'] == 'success') {
        _showSnackbar(data['message'] ?? 'Survey berhasil dikirim!', Colors.green);
        
        await Future.delayed(const Duration(seconds: 1));
        _resetForm();
        if (mounted) Navigator.pop(context);
      } else {
        throw Exception(data['message'] ?? 'Gagal mengirim survey');
      }
    } else {
      String errorMsg = data['message'] ?? 'Error ${response.statusCode}';
      if (data.containsKey('missing_fields')) {
        errorMsg = 'Data tidak lengkap: ${data['missing_fields'].join(', ')}';
      }
      throw Exception(errorMsg);
    }
  } on TimeoutException {
    _showSnackbar('Timeout: Server tidak merespons', Colors.red);
  } on FormatException catch (e) {
    _showSnackbar('Format data tidak valid: $e', Colors.red);
  } catch (e) {
    _showSnackbar('Error: ${e.toString()}', Colors.red);
  } finally {
    if (mounted) {
      setState(() => _isSubmitting = false);
    }
  }
}

  void _showSnackbar(String message, Color color) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Text(message), 
        backgroundColor: color,
        behavior: SnackBarBehavior.floating,
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
        margin: const EdgeInsets.all(16),
      ),
    );
  }

  void _resetForm() {
    setState(() {
      _jenisKelamin = null;
      _pendidikan = null;
      _pekerjaanController.clear();
      _tanggalMengisi = DateTime.now();
      _jawabanValues.fillRange(0, _jawabanValues.length, null);
    });
    _pageController.jumpToPage(0);
  }

  // --- WIDGET BAGIAN 1: DATA DIRI ---

  Widget _buildDataDiriPage() {
    return Form(
      key: _dataDiriFormKey,
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            'Data Diri Partisipan', 
            style: Theme.of(context).textTheme.headlineMedium?.copyWith(fontWeight: FontWeight.bold),
          ),
          const SizedBox(height: 20),
          _buildDropdownField(
              'Jenis Kelamin', _jenisKelamin, ['Laki-laki', 'Perempuan'],
              (value) => setState(() => _jenisKelamin = value)),
          const SizedBox(height: 24),
          _buildDropdownField(
              'Pendidikan Terakhir', _pendidikan, ['SD', 'SMP/MTs', 'SMA/SMK', 'D3', 'S1/D4', 'S2/S3'],
              (value) => setState(() => _pendidikan = value)),
          const SizedBox(height: 24),
          _buildTextField('Pekerjaan', 'Isi Pekerjaan Anda', _pekerjaanController),
          const SizedBox(height: 28),
          _buildTanggalMengisi(),
          const SizedBox(height: 36),
          _buildNavigationButtons(0),
        ],
      ),
    );
  }
  
  Widget _buildDropdownField(String label, String? value, List<String> items, Function(String?) onChanged) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(label, style: Theme.of(context).textTheme.titleMedium?.copyWith(fontWeight: FontWeight.w700)),
        const SizedBox(height: 8),
        DropdownButtonFormField<String>(
          value: value,
          hint: Text('Pilih $label'),
          items: items.map((String item) {
            return DropdownMenuItem(value: item, child: Text(item));
          }).toList(),
          onChanged: onChanged,
          validator: (val) => val == null ? 'Wajib dipilih' : null,
          decoration: InputDecoration(
            border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
            contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
          ),
        ),
      ],
    );
  }

  Widget _buildTextField(String label, String hint, TextEditingController controller) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(label, style: Theme.of(context).textTheme.titleMedium?.copyWith(fontWeight: FontWeight.w700)),
        const SizedBox(height: 8),
        TextFormField(
          controller: controller,
          decoration: InputDecoration(
            hintText: hint, 
            border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
            contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
          ),
          validator: (val) => val!.isEmpty ? 'Wajib diisi' : null,
        ),
      ],
    );
  }

  Widget _buildTanggalMengisi() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Row(
          children: [
            const Icon(Icons.calendar_today, color: Colors.blueAccent),
            const SizedBox(width: 8),
            Text('Tanggal Mengisi', style: Theme.of(context).textTheme.titleMedium?.copyWith(fontWeight: FontWeight.w700)),
          ],
        ),
        const SizedBox(height: 8),
        GestureDetector(
          onTap: () async {
            DateTime? pickedDate = await showDatePicker(
              context: context,
              initialDate: _tanggalMengisi,
              firstDate: DateTime(2000),
              lastDate: DateTime.now(),
              builder: (context, child) {
                return Theme(
                  data: Theme.of(context).copyWith(
                    colorScheme: ColorScheme.light(
                      primary: Colors.blueAccent.shade700,
                      onPrimary: Colors.white,
                      onSurface: Colors.black,
                    ),
                    textButtonTheme: TextButtonThemeData(
                      style: TextButton.styleFrom(foregroundColor: Colors.blueAccent.shade700),
                    ),
                  ),
                  child: child!,
                );
              },
            );
            if (pickedDate != null) {
              setState(() => _tanggalMengisi = pickedDate);
            }
          },
          child: InputDecorator(
            decoration: InputDecoration(
              border: OutlineInputBorder(borderRadius: BorderRadius.circular(12)),
              suffixIcon: const Icon(Icons.calendar_month, color: Colors.blueAccent),
              contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
            ),
            child: Text(
              '${_tanggalMengisi.day}/${_tanggalMengisi.month}/${_tanggalMengisi.year}',
              style: Theme.of(context).textTheme.titleMedium,
            ),
          ),
        ),
        const SizedBox(height: 4),
        Text('Pilih tanggal saat Anda mengisi survey', style: Theme.of(context).textTheme.bodySmall?.copyWith(color: Colors.grey.shade600)),
      ],
    );
  }
  
  // --- WIDGET BAGIAN 2: PERTANYAAN SURVEY ---

  Widget _buildQuestionPage(int index) {
    int currentQuestionNumber = index + 1;
    String question = _questions[index];
    int? currentValue = _jawabanValues[index];

    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        // Progress Bar
        ClipRRect(
          borderRadius: BorderRadius.circular(10),
          child: LinearProgressIndicator(
            value: currentQuestionNumber / _questions.length,
            color: Theme.of(context).colorScheme.primary, 
            backgroundColor: Colors.grey.shade200,
            minHeight: 10,
          ),
        ),
        const SizedBox(height: 24),
        // Judul Pertanyaan
        Text(
          'Pertanyaan $currentQuestionNumber dari ${_questions.length}',
          style: Theme.of(context).textTheme.bodyLarge?.copyWith(color: Colors.grey.shade600, fontWeight: FontWeight.w500),
        ),
        const SizedBox(height: 10),
        // Teks Pertanyaan
        Text(
          question,
          style: Theme.of(context).textTheme.headlineMedium?.copyWith(fontWeight: FontWeight.w800),
        ),
        const SizedBox(height: 30), // DIKURANGI DARI 36 MENJADI 30
        // Opsi Jawaban (Rating Grid)
        GridView.builder(
          shrinkWrap: true,
          physics: const NeverScrollableScrollPhysics(),
          gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
            crossAxisCount: 2,
            childAspectRatio: 1.25, 
            crossAxisSpacing: 12, // DIKURANGI DARI 20 MENJADI 12
            mainAxisSpacing: 12, // DIKURANGI DARI 20 MENJADI 12
          ),
          itemCount: _ratingOptions.length,
          itemBuilder: (context, i) {
            final option = _ratingOptions[i];
            bool isSelected = currentValue == option['value'];

            return _buildRatingOptionTile(
              option['icon'] as String,
              option['label']!,
              isSelected,
              option['mainColor'] as Color, 
              () {
                setState(() {
                  _jawabanValues[index] = option['value'] as int;
                });
              },
            );
          },
        ),
        const SizedBox(height: 20), // DIKURANGI DARI 40 MENJADI 20
        _buildNavigationButtons(currentQuestionNumber),
      ],
    );
  }

  // WIDGET OPSI RATING (EMOTE ASLI DENGAN EFEK 3D & PROFESIONAL)
  Widget _buildRatingOptionTile(String emoji, String label, bool isSelected, Color optionColor, VoidCallback onTap) {
    Color finalTextColor = isSelected ? Colors.white : Colors.white;
    Color finalBackgroundColor = optionColor; 
    
    // Efek Interaktif
    double elevation = isSelected ? 15 : 5;
    double scale = isSelected ? 1.05 : 1.0;
    
    Color shadowColor = isSelected ? optionColor.withOpacity(0.9) : Colors.black.withOpacity(0.2); 
    Color borderColor = isSelected ? Colors.white : Colors.white.withOpacity(0.0); 

    return AnimatedScale(
      scale: scale,
      duration: const Duration(milliseconds: 200),
      curve: Curves.easeOut,
      child: Material( 
        color: finalBackgroundColor, // Background SOLID PENUH
        borderRadius: BorderRadius.circular(16),
        elevation: elevation, 
        shadowColor: shadowColor, 
        child: InkWell( 
          onTap: onTap,
          borderRadius: BorderRadius.circular(16),
          child: Container(
            padding: const EdgeInsets.all(10), // DIKURANGI DARI 16 MENJADI 10
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(16),
              border: Border.all(
                color: borderColor, 
                width: isSelected ? 5.0 : 0.0,
              ),
            ),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Text(
                  emoji, 
                  style: TextStyle(
                    fontSize: 40, // DIKURANGI DARI 48 MENJADI 40
                    shadows: [
                      Shadow(color: Colors.black.withOpacity(0.4), offset: const Offset(2, 2), blurRadius: 4),
                      Shadow(color: Colors.black.withOpacity(0.2), offset: const Offset(-1, -1), blurRadius: 2),
                      if (isSelected) Shadow(color: Colors.white.withOpacity(0.8), offset: const Offset(0, 0), blurRadius: 8),
                    ],
                  ),
                ), 
                const SizedBox(height: 8), // DIKURANGI DARI 10 MENJADI 8
                Text(
                  label,
                  textAlign: TextAlign.center,
                  style: TextStyle(
                    fontWeight: isSelected ? FontWeight.w900 : FontWeight.w700,
                    fontSize: 14, // DIKURANGI DARI 16 MENJADI 14
                    color: finalTextColor, 
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  // --- WIDGET NAVIGASI ---

  Widget _buildNavigationButtons(int currentStep) {
    bool isFirstStep = currentStep == 0;
    bool isLastQuestion = currentStep == _questions.length;

    return Row(
      mainAxisAlignment: isFirstStep ? MainAxisAlignment.end : MainAxisAlignment.spaceBetween,
      children: [
        if (!isFirstStep)
          ElevatedButton.icon(
            onPressed: _previousPage,
            icon: const Icon(Icons.arrow_back),
            label: const Text('Kembali'),
            style: ElevatedButton.styleFrom(
              backgroundColor: Colors.white,
              foregroundColor: Theme.of(context).colorScheme.primary,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(25),
                side: BorderSide(color: Colors.grey.shade400, width: 1),
              ),
              padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
              elevation: 2,
            ),
          ),
        
        ElevatedButton.icon(
          onPressed: _isSubmitting ? null : (isLastQuestion ? _submitSurvey : _nextPage),
          icon: _isSubmitting 
              ? const SizedBox.shrink() 
              : Icon(isLastQuestion ? Icons.send : Icons.arrow_forward),
          label: _isSubmitting
              ? const SizedBox(
                  height: 20,
                  width: 20,
                  child: CircularProgressIndicator(color: Colors.white, strokeWidth: 2),
                )
              : Text(isLastQuestion ? 'Kirim Survey' : 'Lanjut'),
          style: ElevatedButton.styleFrom(
            backgroundColor: isLastQuestion ? Theme.of(context).colorScheme.error : Theme.of(context).colorScheme.primary, 
            foregroundColor: Colors.white,
            shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(25)),
            padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
            elevation: 4,
            textStyle: const TextStyle(fontSize: 16, fontWeight: FontWeight.w600),
          ),
        ),
      ],
    );
  }

  // --- WIDGET UTAMA BUILD ---

  @override
  Widget build(BuildContext context) {
    final ThemeData theme = Theme.of(context).copyWith(
      colorScheme: ColorScheme.fromSeed(
        seedColor: const Color(0xFFC62828), 
        primary: Colors.blue.shade700,
        error: Colors.red.shade700, 
      ),
      textTheme: const TextTheme(
        headlineMedium: TextStyle(fontWeight: FontWeight.w800), 
        bodyLarge: TextStyle(fontWeight: FontWeight.w600),
        titleMedium: TextStyle(fontWeight: FontWeight.w700),
      )
    );

    return Theme(
      data: theme,
      child: Scaffold(
        backgroundColor: Colors.grey.shade50, 
        appBar: AppBar(
          title: const Text(
            'Survey Kepuasan Pelanggan',
            style: TextStyle(fontWeight: FontWeight.w900, fontSize: 20),
          ),
          centerTitle: true,
          backgroundColor: theme.colorScheme.error,
          foregroundColor: Colors.white,
          elevation: 0,
        ),
        // PERBAIKAN RESPONSIVITAS TINGGI CARD (ANTI-OVERFLOW)
        body: Builder(
          builder: (context) {
            final viewInsets = MediaQuery.of(context).viewInsets.bottom;
            final screenHeight = MediaQuery.of(context).size.height;
            final cardHeight = screenHeight - viewInsets - 80;
            
            return Center(
              child: ConstrainedBox(
                constraints: const BoxConstraints(maxWidth: 700),
                child: AnimatedContainer(
                  duration: const Duration(milliseconds: 300),
                  height: viewInsets > 0 ? cardHeight : null,
                  child: Card(
                    margin: const EdgeInsets.all(20),
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20)),
                    elevation: 10,
                    child: Padding(
                      padding: const EdgeInsets.all(30.0),
                      child: PageView.builder(
                        controller: _pageController,
                        physics: const NeverScrollableScrollPhysics(),
                        itemCount: 1 + _questions.length,
                        itemBuilder: (context, index) {
                          return SingleChildScrollView( 
                            padding: const EdgeInsets.symmetric(vertical: 10),
                            child: index == 0 ? _buildDataDiriPage() : _buildQuestionPage(index - 1),
                          );
                        },
                      ),
                    ),
                  ),
                ),
              ),
            );
          }
        ),
      ),
    );
  }
}