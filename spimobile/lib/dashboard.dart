import 'package:flutter/material.dart';
import 'dart:math';
import 'BuatLaporanPage.dart';
import 'DaftarLaporanPage.dart';
import 'ProfilePage.dart';

// ---------------- Home Page (Dashboard SPI) - Fixed Version ----------------
class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage>
    with SingleTickerProviderStateMixin {
  late AnimationController _animController;
  late Animation<double> _fadeAnimation;
  late Animation<Offset> _slideAnimation;

  int _selectedIndex = 0;

  @override
  void initState() {
    super.initState();
    _animController = AnimationController(
      duration: const Duration(milliseconds: 800),
      vsync: this,
    );

    _fadeAnimation = Tween<double>(
      begin: 0.0,
      end: 1.0,
    ).animate(CurvedAnimation(parent: _animController, curve: Curves.easeIn));

    _slideAnimation =
        Tween<Offset>(begin: const Offset(0, 0.2), end: Offset.zero).animate(
          CurvedAnimation(parent: _animController, curve: Curves.easeOutCubic),
        );

    _animController.forward();
  }

  @override
  void dispose() {
    _animController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        decoration: BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
            colors: [
              const Color(0xFFF5F5F5),
              Colors.grey.shade100,
              Colors.white,
            ],
          ),
        ),
        child: SafeArea(
          child: FadeTransition(
            opacity: _fadeAnimation,
            child: SlideTransition(
              position: _slideAnimation,
              // SOLUSI 1: Tambahkan SingleChildScrollView dengan proper constraints
              child: LayoutBuilder(
                builder: (context, constraints) {
                  return SingleChildScrollView(
                    physics: const BouncingScrollPhysics(),
                    child: ConstrainedBox(
                      constraints: BoxConstraints(
                        minHeight: constraints.maxHeight,
                      ),
                      child: Column(
                        children: [
                          // Custom App Bar
                          _buildCustomHeader(),

                          // Info Card Auditor
                          _buildWelcomeCard(),

                          // Quick Actions untuk SPI
                          _buildQuickActions(),

                          // Statistik Laporan
                          _buildStatistics(),

                          // Laporan Terbaru
                          _buildRecentReports(),

                          // Jadwal Audit
                          _buildAuditSchedule(),

                          const SizedBox(
                            height: 100,
                          ), // Extra space for bottom nav
                        ],
                      ),
                    ),
                  );
                },
              ),
            ),
          ),
        ),
      ),
      bottomNavigationBar: _buildBottomNavBar(),
      floatingActionButton: _buildFloatingActionButton(),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerDocked,
    );
  }

  // Header dengan logo dan profil
  Widget _buildCustomHeader() {
    return Container(
      padding: const EdgeInsets.fromLTRB(20, 15, 20, 20),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Flexible(
            child: Row(
              children: [
                // Logo Polije
                Container(
                  padding: const EdgeInsets.all(8),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(15),
                    boxShadow: [
                      BoxShadow(
                        color: Colors.red.shade100,
                        blurRadius: 10,
                        offset: const Offset(0, 4),
                      ),
                    ],
                  ),
                  child: Image.asset(
                    'images/logoPolije2.png',
                    width: 40,
                    height: 40,
                  ),
                ),
                const SizedBox(width: 12),
                Flexible(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        'SPI POLIJE',
                        style: TextStyle(
                          fontSize: 20,
                          fontWeight: FontWeight.bold,
                          color: const Color(0xFFC62828),
                        ),
                      ),
                      Text(
                        'Satuan Pengawas Internal',
                        style: TextStyle(
                          fontSize: 12,
                          color: Colors.grey.shade600,
                        ),
                        overflow: TextOverflow.ellipsis,
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),
          // Notification & Profile
          Row(
            mainAxisSize: MainAxisSize.min,
            children: [
              Container(
                decoration: BoxDecoration(
                  color: Colors.white,
                  borderRadius: BorderRadius.circular(12),
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black.withOpacity(0.05),
                      blurRadius: 8,
                      offset: const Offset(0, 2),
                    ),
                  ],
                ),
                child: IconButton(
                  icon: Stack(
                    children: [
                      const Icon(Icons.notifications_outlined, size: 26),
                      Positioned(
                        right: 0,
                        top: 0,
                        child: Container(
                          width: 10,
                          height: 10,
                          decoration: BoxDecoration(
                            color: Colors.red.shade600,
                            shape: BoxShape.circle,
                            border: Border.all(color: Colors.white, width: 1.5),
                          ),
                        ),
                      ),
                    ],
                  ),
                  onPressed: () {},
                  color: const Color(0xFFC62828),
                ),
              ),
              const SizedBox(width: 10),
              Container(
                decoration: BoxDecoration(
                  gradient: LinearGradient(
                    colors: [const Color(0xFFC62828), Colors.red.shade400],
                  ),
                  borderRadius: BorderRadius.circular(12),
                  boxShadow: [
                    BoxShadow(
                      color: Colors.red.shade200,
                      blurRadius: 8,
                      offset: const Offset(0, 2),
                    ),
                  ],
                ),
                child: IconButton(
                  icon: const Icon(Icons.person_outline, size: 26),
                  color: Colors.white,
                  onPressed: () async {
                    // Tampilkan loading animasi
                    _showFancyLoading(context);

                    // Tunggu sebentar (bisa ganti dengan proses async misalnya ambil data user)
                    await Future.delayed(const Duration(seconds: 1));

                    // Tutup loading
                    Navigator.of(context).pop();

                    // Navigasi ke halaman lain (ganti BuatLaporanPage sesuai tujuan)
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (_) => const ProfilePage(),
                      ),
                    );
                  },
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }

  // Welcome Card untuk Auditor
  Widget _buildWelcomeCard() {
    return Container(
      margin: const EdgeInsets.fromLTRB(20, 10, 20, 25),
      padding: const EdgeInsets.all(25),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: [
            const Color(0xFFC62828),
            const Color(0xFFD32F2F),
            Colors.orange.shade700,
          ],
        ),
        borderRadius: BorderRadius.circular(25),
        boxShadow: [
          BoxShadow(
            color: Colors.red.shade300.withOpacity(0.5),
            blurRadius: 20,
            offset: const Offset(0, 10),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      'Selamat Datang! 👋',
                      style: TextStyle(
                        fontSize: 16,
                        color: Colors.white.withOpacity(0.95),
                        fontWeight: FontWeight.w500,
                      ),
                    ),
                    const SizedBox(height: 5),
                    const Text(
                      'Dr. Bambang Suryono, M.Si',
                      style: TextStyle(
                        fontSize: 22,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                      overflow: TextOverflow.ellipsis,
                      maxLines: 1,
                    ),
                    const SizedBox(height: 5),
                    Container(
                      padding: const EdgeInsets.symmetric(
                        horizontal: 12,
                        vertical: 6,
                      ),
                      decoration: BoxDecoration(
                        color: Colors.white.withOpacity(0.2),
                        borderRadius: BorderRadius.circular(20),
                      ),
                      child: const Text(
                        'Kepala SPI • Auditor Senior',
                        style: TextStyle(
                          fontSize: 13,
                          color: Colors.white,
                          fontWeight: FontWeight.w500,
                        ),
                        overflow: TextOverflow.ellipsis,
                      ),
                    ),
                  ],
                ),
              ),
              Container(
                padding: const EdgeInsets.all(12),
                decoration: BoxDecoration(
                  color: Colors.white.withOpacity(0.15),
                  borderRadius: BorderRadius.circular(15),
                ),
                child: const Icon(
                  Icons.shield_outlined,
                  size: 40,
                  color: Colors.white,
                ),
              ),
            ],
          ),
          const SizedBox(height: 20),
          // Statistik Ringkas
          Row(
            children: [
              Expanded(
                child: _buildInfoChip(
                  'Laporan',
                  '24',
                  Icons.description_rounded,
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: _buildInfoChip(
                  'Proses',
                  '8',
                  Icons.pending_actions_rounded,
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: _buildInfoChip(
                  'Selesai',
                  '16',
                  Icons.check_circle_rounded,
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildInfoChip(String label, String value, IconData icon) {
    return Container(
      padding: const EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: Colors.white.withOpacity(0.2),
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: Colors.white.withOpacity(0.3), width: 1),
      ),
      child: Column(
        children: [
          Icon(icon, color: Colors.white, size: 22),
          const SizedBox(height: 6),
          Text(
            value,
            style: const TextStyle(
              fontSize: 18,
              fontWeight: FontWeight.bold,
              color: Colors.white,
            ),
          ),
          Text(
            label,
            style: TextStyle(
              fontSize: 11,
              color: Colors.white.withOpacity(0.9),
              fontWeight: FontWeight.w500,
            ),
            overflow: TextOverflow.ellipsis,
          ),
        ],
      ),
    );
  }

  //loadingnya disini
  void _showFancyLoading(BuildContext context) {
    showDialog(
      context: context,
      barrierDismissible: false,
      builder: (context) => Center(
        child: Container(
          width: 180,
          height: 200,
          padding: const EdgeInsets.all(16),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(24),
            boxShadow: [
              BoxShadow(
                color: Colors.black.withOpacity(0.15),
                blurRadius: 20,
                spreadRadius: 5,
              ),
            ],
          ),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              SizedBox(
                width: 100,
                height: 100,
                child: Stack(
                  alignment: Alignment.center,
                  children: [
                    // Outer gradient ring
                    TweenAnimationBuilder<double>(
                      tween: Tween(begin: 0, end: 360),
                      duration: const Duration(seconds: 2),
                      curve: Curves.linear,
                      builder: (context, value, child) {
                        return Transform.rotate(
                          angle: (value * pi) / 180,
                          child: Container(
                            width: 100,
                            height: 100,
                            decoration: BoxDecoration(
                              shape: BoxShape.circle,
                              gradient: SweepGradient(
                                colors: [
                                  Color(0xFF42A5F5),
                                  Color(0xFF478DE0),
                                  Color(0xFF5C6BC0),
                                  Color(0xFF42A5F5),
                                ],
                              ),
                            ),
                            child: Padding(
                              padding: const EdgeInsets.all(4),
                              child: Container(
                                decoration: BoxDecoration(
                                  shape: BoxShape.circle,
                                  color: Colors.white,
                                ),
                              ),
                            ),
                          ),
                        );
                      },
                    ),
                    // Middle thin ring (slower)
                    TweenAnimationBuilder<double>(
                      tween: Tween(begin: 0, end: -360),
                      duration: const Duration(seconds: 3),
                      curve: Curves.linear,
                      builder: (context, value, child) {
                        return Transform.rotate(
                          angle: (value * pi) / 180,
                          child: Container(
                            width: 70,
                            height: 70,
                            decoration: BoxDecoration(
                              shape: BoxShape.circle,
                              border: Border.all(
                                color: Color(0xFF64B5F6),
                                width: 2,
                              ),
                            ),
                          ),
                        );
                      },
                    ),
                    // Pulsing center dot
                    TweenAnimationBuilder<double>(
                      tween: Tween(begin: 0.6, end: 1.0),
                      duration: const Duration(seconds: 1),
                      curve: Curves.easeInOut,
                      builder: (context, value, child) {
                        return Transform.scale(
                          scale: value,
                          child: Container(
                            width: 16,
                            height: 16,
                            decoration: BoxDecoration(
                              shape: BoxShape.circle,
                              gradient: RadialGradient(
                                colors: [Color(0xFF42A5F5), Color(0xFF478DE0)],
                              ),
                              boxShadow: [
                                BoxShadow(
                                  color: Color(0xFF42A5F5).withOpacity(0.6),
                                  blurRadius: 10,
                                  spreadRadius: 2,
                                ),
                              ],
                            ),
                          ),
                        );
                      },
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 20),
              const Text(
                'Memuat...',
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                  fontSize: 16,
                  color: Color(0xFF333333),
                  letterSpacing: 1.2,
                ),
              ),
              const SizedBox(height: 12),
              // Mini loading bar di bawah
              SizedBox(
                width: 60,
                height: 4,
                child: TweenAnimationBuilder<double>(
                  tween: Tween(begin: 0, end: 1),
                  duration: const Duration(seconds: 1),
                  curve: Curves.easeInOut,
                  builder: (context, value, child) {
                    return Container(
                      decoration: BoxDecoration(
                        color: Color(0xFFE0E0E0),
                        borderRadius: BorderRadius.circular(2),
                      ),
                      child: Stack(
                        children: [
                          Container(
                            width: 60 * value,
                            height: 4,
                            decoration: BoxDecoration(
                              gradient: LinearGradient(
                                colors: [Color(0xFF42A5F5), Color(0xFF64B5F6)],
                              ),
                              borderRadius: BorderRadius.circular(2),
                            ),
                          ),
                        ],
                      ),
                    );
                  },
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  // Quick Actions untuk SPI
  Widget _buildQuickActions() {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 20),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            'Menu Utama',
            style: TextStyle(
              fontSize: 20,
              fontWeight: FontWeight.bold,
              color: Colors.grey.shade800,
            ),
          ),
          const SizedBox(height: 15),
          GridView.count(
            crossAxisCount: 4,
            shrinkWrap: true,
            physics: const NeverScrollableScrollPhysics(),
            mainAxisSpacing: 15,
            crossAxisSpacing: 15,
            childAspectRatio: 0.85,
            children: [
              _buildQuickActionItem(
                'Buat\nLaporan',
                Icons.add_box_rounded,
                [Colors.blue.shade600, Colors.blue.shade400],
                () async {
                  _showFancyLoading(context); // kirim context
                  await Future.delayed(const Duration(seconds: 1));
                  Navigator.of(context).pop(); // tutup loading
                  Navigator.push(
                    context,
                    MaterialPageRoute(builder: (_) => const BuatLaporanPage()),
                  );
                },
              ),

              _buildQuickActionItem(
                'Daftar\nLaporan',
                Icons.list_alt_rounded,
                [Colors.orange.shade600, Colors.orange.shade400],
                () async {
                  _showFancyLoading(context); // kirim context
                  await Future.delayed(const Duration(seconds: 1));
                  Navigator.of(context).pop(); // tutup loading
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (_) => const DaftarLaporanPage(),
                    ),
                  );
                },
              ),
              // Tambahkan item lainnya jika perlu
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildQuickActionItem(
    String title,
    IconData icon,
    List<Color> colors,
    VoidCallback onTap, // Tambahkan parameter onTap
  ) {
    return GestureDetector(
      onTap: onTap, // Panggil fungsi onTap di sini
      child: Container(
        decoration: BoxDecoration(
          color: Colors.white,
          borderRadius: BorderRadius.circular(18),
          boxShadow: [
            BoxShadow(
              color: colors[0].withOpacity(0.2),
              blurRadius: 10,
              offset: const Offset(0, 4),
            ),
          ],
        ),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          mainAxisSize: MainAxisSize.min,
          children: [
            Container(
              padding: const EdgeInsets.all(10),
              decoration: BoxDecoration(
                gradient: LinearGradient(colors: colors),
                borderRadius: BorderRadius.circular(12),
              ),
              child: Icon(icon, color: Colors.white, size: 24),
            ),
            const SizedBox(height: 6),
            Flexible(
              child: Padding(
                padding: const EdgeInsets.symmetric(horizontal: 4),
                child: Text(
                  title,
                  textAlign: TextAlign.center,
                  style: TextStyle(
                    fontSize: 10,
                    fontWeight: FontWeight.w600,
                    color: Colors.grey.shade700,
                    height: 1.2,
                  ),
                  maxLines: 2,
                  overflow: TextOverflow.ellipsis,
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }

  // Statistik Laporan
  Widget _buildStatistics() {
    return Container(
      margin: const EdgeInsets.fromLTRB(20, 25, 20, 0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            'Statistik Laporan',
            style: TextStyle(
              fontSize: 20,
              fontWeight: FontWeight.bold,
              color: Colors.grey.shade800,
            ),
          ),
          const SizedBox(height: 15),
          Row(
            children: [
              Expanded(
                child: _buildStatCard(
                  'Tulis\nLaporan',
                  '5',
                  Icons.hourglass_empty_rounded,
                  Colors.orange.shade600,
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: _buildStatCard(
                  'Proses\nVerifikasi',
                  '8',
                  Icons.pending_rounded,
                  Colors.blue.shade600,
                ),
              ),
            ],
          ),
          const SizedBox(height: 12),
          Row(
            children: [
              Expanded(
                child: _buildStatCard(
                  'Tindak\nLanjut',
                  '3',
                  Icons.priority_high_rounded,
                  Colors.red.shade600,
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: _buildStatCard(
                  'Tanggapan\nPelapor',
                  '16',
                  Icons.check_circle_outline_rounded,
                  Colors.green.shade600,
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _buildStatCard(
    String title,
    String count,
    IconData icon,
    Color color,
  ) {
    return Container(
      height: 100,
      padding: const EdgeInsets.all(14), // Reduced padding
      decoration: BoxDecoration(
        color: color.withOpacity(0.1),
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: color.withOpacity(0.4), width: 1),
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(10),
            decoration: BoxDecoration(
              color: color,
              borderRadius: BorderRadius.circular(8),
            ),
            child: Icon(icon, color: Colors.white, size: 24),
          ),
          const SizedBox(width: 12),
          Expanded(
            // SOLUSI 5: Wrap dengan Expanded
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Flexible(
                  child: Text(
                    title,
                    style: TextStyle(
                      fontSize: 13,
                      fontWeight: FontWeight.bold,
                      color: Colors.grey.shade800,
                      height: 1.2,
                    ),
                    maxLines: 2,
                    overflow: TextOverflow.ellipsis,
                  ),
                ),
                const SizedBox(height: 4),
                Text(
                  count,
                  style: TextStyle(
                    fontSize: 20,
                    fontWeight: FontWeight.bold,
                    color: color,
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  // Laporan Terbaru
  Widget _buildRecentReports() {
    return Container(
      margin: const EdgeInsets.fromLTRB(20, 25, 20, 0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text(
                'Laporan Terbaru',
                style: TextStyle(
                  fontSize: 20,
                  fontWeight: FontWeight.bold,
                  color: Colors.grey.shade800,
                ),
              ),
              TextButton(
                onPressed: () {},
                child: Text(
                  'Lihat Semua',
                  style: TextStyle(
                    color: const Color(0xFFC62828),
                    fontWeight: FontWeight.w600,
                  ),
                ),
              ),
            ],
          ),
          const SizedBox(height: 10),
          _buildReportCard(
            'Audit Keuangan Fakultas Teknik Q1 2025',
            'Menunggu Verifikasi',
            '2 jam yang lalu',
            Colors.orange.shade600,
            Icons.account_balance_rounded,
          ),
          const SizedBox(height: 12),
          _buildReportCard(
            'Pemeriksaan Aset Laboratorium Komputer',
            'Dalam Proses',
            '1 hari yang lalu',
            Colors.blue.shade600,
            Icons.computer_rounded,
          ),
          const SizedBox(height: 12),
          _buildReportCard(
            'Evaluasi Sistem Pengadaan Barang',
            'Perlu Tindak Lanjut',
            '3 hari yang lalu',
            Colors.red.shade600,
            Icons.shopping_cart_rounded,
          ),
        ],
      ),
    );
  }

  Widget _buildReportCard(
    String title,
    String status,
    String time,
    Color statusColor,
    IconData icon,
  ) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(18),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.05),
            blurRadius: 10,
            offset: const Offset(0, 4),
          ),
        ],
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(14),
            decoration: BoxDecoration(
              color: statusColor.withOpacity(0.1),
              borderRadius: BorderRadius.circular(14),
            ),
            child: Icon(icon, color: statusColor, size: 28),
          ),
          const SizedBox(width: 15),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  title,
                  style: TextStyle(
                    fontSize: 14,
                    fontWeight: FontWeight.bold,
                    color: Colors.grey.shade800,
                  ),
                  maxLines: 2,
                  overflow: TextOverflow.ellipsis,
                ),
                const SizedBox(height: 6),
                Container(
                  padding: const EdgeInsets.symmetric(
                    horizontal: 10,
                    vertical: 4,
                  ),
                  decoration: BoxDecoration(
                    color: statusColor.withOpacity(0.1),
                    borderRadius: BorderRadius.circular(8),
                  ),
                  child: Text(
                    status,
                    style: TextStyle(
                      fontSize: 11,
                      color: statusColor,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                ),
                const SizedBox(height: 4),
                Row(
                  children: [
                    Icon(
                      Icons.access_time_rounded,
                      size: 13,
                      color: Colors.grey.shade500,
                    ),
                    const SizedBox(width: 4),
                    Text(
                      time,
                      style: TextStyle(
                        fontSize: 12,
                        color: Colors.grey.shade500,
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),
          Icon(
            Icons.arrow_forward_ios_rounded,
            size: 18,
            color: Colors.grey.shade400,
          ),
        ],
      ),
    );
  }

  // Jadwal Audit
  Widget _buildAuditSchedule() {
    return Container(
      margin: const EdgeInsets.fromLTRB(20, 25, 20, 0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text(
                'Jadwal Audit Mendatang',
                style: TextStyle(
                  fontSize: 20,
                  fontWeight: FontWeight.bold,
                  color: Colors.grey.shade800,
                ),
              ),
              TextButton(
                onPressed: () {},
                child: Text(
                  'Kalender',
                  style: TextStyle(
                    color: const Color(0xFFC62828),
                    fontWeight: FontWeight.w600,
                  ),
                ),
              ),
            ],
          ),
          const SizedBox(height: 10),
          _buildScheduleCard(
            'Audit Sistem Informasi Akademik',
            '15 Oktober 2025',
            '09.00 - 12.00 WIB',
            'Gedung Rektorat Lt. 3',
          ),
          const SizedBox(height: 12),
          _buildScheduleCard(
            'Review Laporan Keuangan Semester',
            '18 Oktober 2025',
            '13.00 - 16.00 WIB',
            'Ruang Pertemuan SPI',
          ),
        ],
      ),
    );
  }

  Widget _buildScheduleCard(
    String title,
    String date,
    String time,
    String location,
  ) {
    return Container(
      padding: const EdgeInsets.all(18),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(18),
        border: Border.all(color: Colors.blue.shade100, width: 2),
        boxShadow: [
          BoxShadow(
            color: Colors.blue.shade50,
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
                  gradient: LinearGradient(
                    colors: [Colors.blue.shade600, Colors.blue.shade400],
                  ),
                  borderRadius: BorderRadius.circular(12),
                ),
                child: const Icon(
                  Icons.event_rounded,
                  color: Colors.white,
                  size: 24,
                ),
              ),
              const SizedBox(width: 12),
              Expanded(
                child: Text(
                  title,
                  style: TextStyle(
                    fontSize: 15,
                    fontWeight: FontWeight.bold,
                    color: Colors.grey.shade800,
                  ),
                  maxLines: 2,
                  overflow: TextOverflow.ellipsis,
                ),
              ),
            ],
          ),
          const SizedBox(height: 15),
          Wrap(
            // SOLUSI 6: Gunakan Wrap untuk Row yang bisa overflow
            spacing: 16,
            runSpacing: 8,
            children: [
              Row(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Icon(
                    Icons.calendar_today_rounded,
                    size: 16,
                    color: Colors.grey.shade600,
                  ),
                  const SizedBox(width: 8),
                  Text(
                    date,
                    style: TextStyle(
                      fontSize: 13,
                      color: Colors.grey.shade700,
                      fontWeight: FontWeight.w500,
                    ),
                  ),
                ],
              ),
              Row(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Icon(
                    Icons.access_time_rounded,
                    size: 16,
                    color: Colors.grey.shade600,
                  ),
                  const SizedBox(width: 8),
                  Text(
                    time,
                    style: TextStyle(
                      fontSize: 13,
                      color: Colors.grey.shade700,
                      fontWeight: FontWeight.w500,
                    ),
                  ),
                ],
              ),
            ],
          ),
          const SizedBox(height: 8),
          Row(
            children: [
              Icon(
                Icons.location_on_rounded,
                size: 16,
                color: Colors.grey.shade600,
              ),
              const SizedBox(width: 8),
              Expanded(
                child: Text(
                  location,
                  style: TextStyle(
                    fontSize: 13,
                    color: Colors.grey.shade700,
                    fontWeight: FontWeight.w500,
                  ),
                  overflow: TextOverflow.ellipsis,
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }

  // Floating Action Button - Buat Laporan Baru
  Widget _buildFloatingActionButton() {
    return Container(
      width: 65,
      height: 65,
      decoration: BoxDecoration(
        gradient: LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: [
            const Color(0xFFC62828),
            Colors.red.shade400,
            Colors.orange.shade600,
          ],
        ),
        shape: BoxShape.circle,
        boxShadow: [
          BoxShadow(
            color: Colors.red.shade300.withOpacity(0.5),
            blurRadius: 15,
            offset: const Offset(0, 8),
          ),
        ],
      ),
      child: FloatingActionButton(
        onPressed: () {
          // Navigate to create report page
        },
        backgroundColor: Colors.transparent,
        elevation: 0,
        child: const Icon(Icons.add_rounded, size: 35, color: Colors.white),
      ),
    );
  }

  // Bottom Navigation Bar
 Widget _buildBottomNavBar() {
  return Container(
    decoration: BoxDecoration(
      color: Colors.white,
      boxShadow: [
        BoxShadow(
          color: Colors.black.withOpacity(0.1),
          blurRadius: 20,
          offset: const Offset(0, -5),
        ),
      ],
      borderRadius: const BorderRadius.only(
        topLeft: Radius.circular(25),
        topRight: Radius.circular(25),
      ),
    ),
    child: ClipRRect(
      borderRadius: const BorderRadius.only(
        topLeft: Radius.circular(25),
        topRight: Radius.circular(25),
      ),
      child: BottomNavigationBar(
        currentIndex: _selectedIndex,
        onTap: (index) {
          // Handle navigation untuk middle button (index 2)
          if (index == 2) {
            Navigator.push(
              context,
              MaterialPageRoute(builder: (context) => const BuatLaporanPage()),
            );
            return;
          }
          
          setState(() => _selectedIndex = index);
        },
        type: BottomNavigationBarType.fixed,
        backgroundColor: Colors.white,
        selectedItemColor: const Color(0xFFC62828),
        unselectedItemColor: Colors.grey.shade400,
        selectedFontSize: 12,
        unselectedFontSize: 11,
        elevation: 0,
        items: const [
          BottomNavigationBarItem(
            icon: Icon(Icons.home_rounded),
            label: 'Beranda',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.description_rounded),
            label: 'Laporan',
          ),
          BottomNavigationBarItem(
            icon: SizedBox(width: 40), // Space for FAB
            label: '',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.event_note_rounded),
            label: 'Jadwal',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.person_rounded),
            label: 'Profil',
          ),
        ],
      ),
    ),
  );
}
}
