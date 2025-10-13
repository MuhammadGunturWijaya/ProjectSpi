import 'package:flutter/material.dart';
import 'dart:io';

class DaftarLaporanPage extends StatefulWidget {
  const DaftarLaporanPage({super.key});

  @override
  State<DaftarLaporanPage> createState() => _DaftarLaporanPageState();
}

class _DaftarLaporanPageState extends State<DaftarLaporanPage> {
  final TextEditingController _searchController = TextEditingController();
  
  // Filter
  String _filterStatus = 'Semua';
  String _filterBentuk = 'Semua';
  
  // Mock data - ganti dengan data dari backend/database
  List<Map<String, dynamic>> _allLaporanList = [
    {
      'id': '2025001',
      'tanggal': '15/01/2025',
      'perihal': 'Pengaduan Penyuapan di Kantor Pusat',
      'status': 'Diproses',
      'bentuk': 'Penyuapan',
      'pengguna': 'Budi Santoso',
      'terlapor': 'Ahmad Wijaya',
      'nip': '12345678',
      'satKerja': 'Jember',
      'jabatan': 'Hakim',
      'tglKejadian': '10/01/2025',
      'tempatKejadian': 'Gedung A3',
      'progress': 45,
    },
    {
      'id': '2025002',
      'tanggal': '16/01/2025',
      'perihal': 'Laporan Pemerasan oleh Pegawai',
      'status': 'Selesai',
      'bentuk': 'Pemerasan / Pungutan',
      'pengguna': 'Siti Nurhaliza',
      'terlapor': 'Rudi Hartono',
      'nip': '87654321',
      'satKerja': 'Balikpapan',
      'jabatan': 'Jaksa',
      'tglKejadian': '05/01/2025',
      'tempatKejadian': 'GOR',
      'progress': 100,
    },
    {
      'id': '2025003',
      'tanggal': '17/01/2025',
      'perihal': 'Pengaduan Gratifikasi',
      'status': 'Ditolak',
      'bentuk': 'Gratifikasi',
      'pengguna': 'Hendra Kusuma',
      'terlapor': 'Bambang Setiawan',
      'nip': '11223344',
      'satKerja': 'Aceh',
      'jabatan': 'Sekretaris',
      'tglKejadian': '12/01/2025',
      'tempatKejadian': 'Gedung TI',
      'progress': 0,
    },
    {
      'id': '2025004',
      'tanggal': '18/01/2025',
      'perihal': 'Laporan Perilaku Tidak Profesional',
      'status': 'Diproses',
      'bentuk': 'Lainnya',
      'pengguna': 'Dewi Lestari',
      'terlapor': 'Eka Putri',
      'nip': '55667788',
      'satKerja': 'Jember',
      'jabatan': 'Hakim',
      'tglKejadian': '14/01/2025',
      'tempatKejadian': 'Gedung A3',
      'progress': 60,
    },
  ];

  late List<Map<String, dynamic>> _filteredLaporanList;

  @override
  void initState() {
    super.initState();
    _filteredLaporanList = _allLaporanList;
    _searchController.addListener(_filterLaporan);
  }

  @override
  void dispose() {
    _searchController.dispose();
    super.dispose();
  }

  void _filterLaporan() {
    final query = _searchController.text.toLowerCase();
    
    setState(() {
      _filteredLaporanList = _allLaporanList.where((laporan) {
        final matchQuery = laporan['id'].toLowerCase().contains(query) ||
            laporan['perihal'].toLowerCase().contains(query) ||
            laporan['pengguna'].toLowerCase().contains(query) ||
            laporan['terlapor'].toLowerCase().contains(query);
        
        final matchStatus = _filterStatus == 'Semua' || laporan['status'] == _filterStatus;
        final matchBentuk = _filterBentuk == 'Semua' || laporan['bentuk'] == _filterBentuk;
        
        return matchQuery && matchStatus && matchBentuk;
      }).toList();
    });
  }

  Color _getStatusColor(String status) {
    switch (status) {
      case 'Selesai':
        return Colors.green;
      case 'Diproses':
        return Colors.blue;
      case 'Ditolak':
        return Colors.red;
      default:
        return Colors.grey;
    }
  }

  IconData _getStatusIcon(String status) {
    switch (status) {
      case 'Selesai':
        return Icons.check_circle_rounded;
      case 'Diproses':
        return Icons.hourglass_top_rounded;
      case 'Ditolak':
        return Icons.cancel_rounded;
      default:
        return Icons.help_outline_rounded;
    }
  }

  void _showDetailLaporan(Map<String, dynamic> laporan) {
    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      shape: const RoundedRectangleBorder(
        borderRadius: BorderRadius.vertical(top: Radius.circular(25)),
      ),
      builder: (context) => DraggableScrollableSheet(
        expand: false,
        initialChildSize: 0.7,
        minChildSize: 0.5,
        maxChildSize: 0.95,
        builder: (context, scrollController) {
          return SingleChildScrollView(
            controller: scrollController,
            child: Padding(
              padding: const EdgeInsets.all(20),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // Header
                  Row(
                    children: [
                      Container(
                        padding: const EdgeInsets.all(10),
                        decoration: BoxDecoration(
                          color: _getStatusColor(laporan['status']).withOpacity(0.2),
                          shape: BoxShape.circle,
                        ),
                        child: Icon(
                          _getStatusIcon(laporan['status']),
                          color: _getStatusColor(laporan['status']),
                          size: 28,
                        ),
                      ),
                      const SizedBox(width: 15),
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(
                              'Laporan #${laporan['id']}',
                              style: const TextStyle(
                                fontSize: 18,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                            Text(
                              laporan['status'],
                              style: TextStyle(
                                fontSize: 13,
                                color: _getStatusColor(laporan['status']),
                                fontWeight: FontWeight.w600,
                              ),
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                  const SizedBox(height: 25),

                  // Progress Bar
                  Text(
                    'Progress Penanganan',
                    style: TextStyle(
                      fontSize: 14,
                      fontWeight: FontWeight.bold,
                      color: Colors.grey.shade800,
                    ),
                  ),
                  const SizedBox(height: 10),
                  ClipRRect(
                    borderRadius: BorderRadius.circular(10),
                    child: LinearProgressIndicator(
                      value: laporan['progress'] / 100,
                      minHeight: 8,
                      backgroundColor: Colors.grey.shade300,
                      valueColor: AlwaysStoppedAnimation<Color>(
                        _getStatusColor(laporan['status']),
                      ),
                    ),
                  ),
                  const SizedBox(height: 5),
                  Text(
                    '${laporan['progress']}% Selesai',
                    style: TextStyle(
                      fontSize: 12,
                      color: Colors.grey.shade600,
                    ),
                  ),
                  const SizedBox(height: 25),

                  // Detail Laporan
                  _buildDetailSection('DETAIL PENGADUAN', [
                    _buildDetailRow('No. Laporan', laporan['id']),
                    _buildDetailRow('Tanggal Pengaduan', laporan['tanggal']),
                    _buildDetailRow('Perihal', laporan['perihal']),
                    _buildDetailRow('Bentuk Pelanggaran', laporan['bentuk']),
                  ]),
                  const SizedBox(height: 15),

                  _buildDetailSection('DATA TERLAPOR', [
                    _buildDetailRow('Nama', laporan['terlapor']),
                    _buildDetailRow('NIP', laporan['nip']),
                    _buildDetailRow('Satuan Kerja', laporan['satKerja']),
                    _buildDetailRow('Jabatan', laporan['jabatan']),
                  ]),
                  const SizedBox(height: 15),

                  _buildDetailSection('INFORMASI KEJADIAN', [
                    _buildDetailRow('Tanggal Kejadian', laporan['tglKejadian']),
                    _buildDetailRow('Tempat Kejadian', laporan['tempatKejadian']),
                  ]),
                  const SizedBox(height: 15),

                  _buildDetailSection('PENGADU', [
                    _buildDetailRow('Nama Pengadu', laporan['pengguna']),
                  ]),
                  const SizedBox(height: 25),

                  // Action Buttons
                  Row(
                    children: [
                      Expanded(
                        child: OutlinedButton.icon(
                          onPressed: () => Navigator.pop(context),
                          icon: const Icon(Icons.close_rounded),
                          label: const Text('Tutup'),
                          style: OutlinedButton.styleFrom(
                            foregroundColor: Colors.grey.shade700,
                            side: BorderSide(color: Colors.grey.shade300),
                            padding: const EdgeInsets.symmetric(vertical: 12),
                          ),
                        ),
                      ),
                      const SizedBox(width: 12),
                      Expanded(
                        child: ElevatedButton.icon(
                          onPressed: () {
                            ScaffoldMessenger.of(context).showSnackBar(
                              const SnackBar(
                                content: Text('Laporan diunduh'),
                                backgroundColor: Colors.green,
                              ),
                            );
                          },
                          icon: const Icon(Icons.download_rounded),
                          label: const Text('Unduh'),
                          style: ElevatedButton.styleFrom(
                            backgroundColor: const Color(0xFFC62828),
                            padding: const EdgeInsets.symmetric(vertical: 12),
                          ),
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),
          );
        },
      ),
    );
  }

  Widget _buildDetailSection(String title, List<Widget> children) {
    return Container(
      padding: const EdgeInsets.all(15),
      decoration: BoxDecoration(
        color: Colors.grey.shade50,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: Colors.grey.shade200),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            title,
            style: TextStyle(
              fontSize: 13,
              fontWeight: FontWeight.bold,
              color: Colors.grey.shade800,
            ),
          ),
          const SizedBox(height: 12),
          ...children,
        ],
      ),
    );
  }

  Widget _buildDetailRow(String label, String value) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 8),
      child: Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Expanded(
            flex: 2,
            child: Text(
              label,
              style: TextStyle(
                fontSize: 12,
                color: Colors.grey.shade600,
              ),
            ),
          ),
          Expanded(
            flex: 3,
            child: Text(
              value,
              style: TextStyle(
                fontSize: 12,
                fontWeight: FontWeight.w600,
                color: Colors.grey.shade800,
              ),
            ),
          ),
        ],
      ),
    );
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
          'Daftar Laporan',
          style: TextStyle(
            color: Colors.white,
            fontWeight: FontWeight.bold,
          ),
        ),
        centerTitle: true,
      ),
      body: Column(
        children: [
          // Search & Filter
          Container(
            padding: const EdgeInsets.all(20),
            color: Colors.white,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // Search Bar
                TextField(
                  controller: _searchController,
                  decoration: InputDecoration(
                    hintText: 'Cari berdasarkan No. Laporan, Perihal, Pengadu...',
                    hintStyle: TextStyle(color: Colors.grey.shade400, fontSize: 14),
                    prefixIcon: Icon(Icons.search_rounded, color: Colors.grey.shade500),
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
                    contentPadding: const EdgeInsets.symmetric(horizontal: 15, vertical: 12),
                  ),
                ),
                const SizedBox(height: 15),

                // Filter Chips
                Wrap(
                  spacing: 10,
                  children: [
                    FilterChip(
                      label: Text(_filterStatus),
                      onSelected: (selected) {
                        showDialog(
                          context: context,
                          builder: (context) => AlertDialog(
                            title: const Text('Filter Status'),
                            content: SingleChildScrollView(
                              child: Column(
                                mainAxisSize: MainAxisSize.min,
                                children: ['Semua', 'Diproses', 'Selesai', 'Ditolak']
                                    .map((status) {
                                  return RadioListTile<String>(
                                    title: Text(status),
                                    value: status,
                                    groupValue: _filterStatus,
                                    onChanged: (value) {
                                      setState(() => _filterStatus = value!);
                                      _filterLaporan();
                                      Navigator.pop(context);
                                    },
                                  );
                                }).toList(),
                              ),
                            ),
                          ),
                        );
                      },
                      backgroundColor: _filterStatus == 'Semua'
                          ? Colors.grey.shade100
                          : Colors.blue.shade100,
                      labelStyle: TextStyle(
                        color: Colors.grey.shade800,
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                    FilterChip(
                      label: Text(_filterBentuk),
                      onSelected: (selected) {
                        showDialog(
                          context: context,
                          builder: (context) => AlertDialog(
                            title: const Text('Filter Bentuk Pelanggaran'),
                            content: SingleChildScrollView(
                              child: Column(
                                mainAxisSize: MainAxisSize.min,
                                children: [
                                  'Semua',
                                  'Pemerasan / Pungutan',
                                  'Penyuapan',
                                  'Gratifikasi',
                                  'Lainnya'
                                ]
                                    .map((bentuk) {
                                  return RadioListTile<String>(
                                    title: Text(bentuk),
                                    value: bentuk,
                                    groupValue: _filterBentuk,
                                    onChanged: (value) {
                                      setState(() => _filterBentuk = value!);
                                      _filterLaporan();
                                      Navigator.pop(context);
                                    },
                                  );
                                }).toList(),
                              ),
                            ),
                          ),
                        );
                      },
                      backgroundColor: _filterBentuk == 'Semua'
                          ? Colors.grey.shade100
                          : Colors.orange.shade100,
                      labelStyle: TextStyle(
                        color: Colors.grey.shade800,
                        fontWeight: FontWeight.w600,
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),

          // Laporan List
          Expanded(
            child: _filteredLaporanList.isEmpty
                ? Center(
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Icon(
                          Icons.inbox_rounded,
                          size: 80,
                          color: Colors.grey.shade300,
                        ),
                        const SizedBox(height: 16),
                        Text(
                          'Tidak ada laporan ditemukan',
                          style: TextStyle(
                            fontSize: 16,
                            fontWeight: FontWeight.w600,
                            color: Colors.grey.shade600,
                          ),
                        ),
                        const SizedBox(height: 8),
                        Text(
                          'Coba ubah filter atau cari kata kunci lain',
                          style: TextStyle(
                            fontSize: 13,
                            color: Colors.grey.shade500,
                          ),
                        ),
                      ],
                    ),
                  )
                : ListView.builder(
                    padding: const EdgeInsets.all(15),
                    itemCount: _filteredLaporanList.length,
                    itemBuilder: (context, index) {
                      final laporan = _filteredLaporanList[index];
                      return GestureDetector(
                        onTap: () => _showDetailLaporan(laporan),
                        child: Container(
                          margin: const EdgeInsets.only(bottom: 12),
                          padding: const EdgeInsets.all(16),
                          decoration: BoxDecoration(
                            color: Colors.white,
                            borderRadius: BorderRadius.circular(15),
                            boxShadow: [
                              BoxShadow(
                                color: Colors.black.withOpacity(0.05),
                                blurRadius: 8,
                                offset: const Offset(0, 2),
                              ),
                            ],
                          ),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              // Header
                              Row(
                                children: [
                                  Container(
                                    padding: const EdgeInsets.all(8),
                                    decoration: BoxDecoration(
                                      color: _getStatusColor(laporan['status'])
                                          .withOpacity(0.2),
                                      shape: BoxShape.circle,
                                    ),
                                    child: Icon(
                                      _getStatusIcon(laporan['status']),
                                      color: _getStatusColor(laporan['status']),
                                      size: 20,
                                    ),
                                  ),
                                  const SizedBox(width: 12),
                                  Expanded(
                                    child: Column(
                                      crossAxisAlignment: CrossAxisAlignment.start,
                                      children: [
                                        Text(
                                          'Laporan #${laporan['id']}',
                                          style: const TextStyle(
                                            fontSize: 14,
                                            fontWeight: FontWeight.bold,
                                          ),
                                        ),
                                        Text(
                                          laporan['tanggal'],
                                          style: TextStyle(
                                            fontSize: 12,
                                            color: Colors.grey.shade600,
                                          ),
                                        ),
                                      ],
                                    ),
                                  ),
                                  Container(
                                    padding: const EdgeInsets.symmetric(
                                      horizontal: 10,
                                      vertical: 5,
                                    ),
                                    decoration: BoxDecoration(
                                      color: _getStatusColor(laporan['status'])
                                          .withOpacity(0.1),
                                      borderRadius: BorderRadius.circular(8),
                                    ),
                                    child: Text(
                                      laporan['status'],
                                      style: TextStyle(
                                        fontSize: 11,
                                        fontWeight: FontWeight.w600,
                                        color: _getStatusColor(laporan['status']),
                                      ),
                                    ),
                                  ),
                                ],
                              ),
                              const SizedBox(height: 12),

                              // Perihal
                              Text(
                                laporan['perihal'],
                                style: const TextStyle(
                                  fontSize: 13,
                                  fontWeight: FontWeight.w600,
                                  color: Colors.grey,
                                ),
                                maxLines: 2,
                                overflow: TextOverflow.ellipsis,
                              ),
                              const SizedBox(height: 10),

                              // Info Row
                              Row(
                                children: [
                                  Expanded(
                                    child: _buildInfoChip(
                                      Icons.person_rounded,
                                      'Terlapor',
                                      laporan['terlapor'],
                                    ),
                                  ),
                                  const SizedBox(width: 10),
                                  Expanded(
                                    child: _buildInfoChip(
                                      Icons.category_rounded,
                                      'Bentuk',
                                      laporan['bentuk'],
                                    ),
                                  ),
                                ],
                              ),
                              const SizedBox(height: 12),

                              // Progress Bar
                              ClipRRect(
                                borderRadius: BorderRadius.circular(8),
                                child: LinearProgressIndicator(
                                  value: laporan['progress'] / 100,
                                  minHeight: 6,
                                  backgroundColor: Colors.grey.shade300,
                                  valueColor: AlwaysStoppedAnimation<Color>(
                                    _getStatusColor(laporan['status']),
                                  ),
                                ),
                              ),
                              const SizedBox(height: 8),
                              Text(
                                'Progress: ${laporan['progress']}%',
                                style: TextStyle(
                                  fontSize: 11,
                                  color: Colors.grey.shade600,
                                  fontWeight: FontWeight.w600,
                                ),
                              ),
                            ],
                          ),
                        ),
                      );
                    },
                  ),
          ),
        ],
      ),
    );
  }

  Widget _buildInfoChip(IconData icon, String label, String value) {
    return Container(
      padding: const EdgeInsets.all(8),
      decoration: BoxDecoration(
        color: Colors.grey.shade50,
        borderRadius: BorderRadius.circular(8),
      ),
      child: Row(
        children: [
          Icon(icon, size: 14, color: const Color(0xFFC62828)),
          const SizedBox(width: 6),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  label,
                  style: TextStyle(
                    fontSize: 10,
                    color: Colors.grey.shade600,
                  ),
                ),
                Text(
                  value,
                  style: const TextStyle(
                    fontSize: 11,
                    fontWeight: FontWeight.w600,
                    color: Colors.grey,
                  ),
                  maxLines: 1,
                  overflow: TextOverflow.ellipsis,
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}