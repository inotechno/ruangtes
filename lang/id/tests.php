<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Tests Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for test management and taking.
    |
    */

    'title' => 'Tes',
    'create_test' => 'Buat Tes',
    'edit_test' => 'Edit Tes',
    'view_test' => 'Lihat Tes',
    'delete_test' => 'Hapus Tes',
    'test_details' => 'Detail Tes',
    'test_settings' => 'Pengaturan Tes',
    'test_results' => 'Hasil Tes',

    // Test properties
    'name' => 'Nama Tes',
    'code' => 'Kode Tes',
    'description' => 'Deskripsi',
    'short_description' => 'Deskripsi Singkat',
    'category' => 'Kategori',
    'type' => 'Tipe',
    'price' => 'Harga',
    'duration' => 'Durasi',
    'questions' => 'Pertanyaan',
    'passing_score' => 'Nilai Kelulusan',
    'max_attempts' => 'Maksimal Percobaan',
    'instructions' => 'Instruksi',

    // Test types
    'types' => [
        'public' => 'Publik',
        'company' => 'Perusahaan',
        'all' => 'Semua Pengguna',
    ],

    // Test statuses
    'status' => [
        'draft' => 'Draft',
        'active' => 'Aktif',
        'inactive' => 'Tidak Aktif',
        'archived' => 'Diarsipkan',
    ],

    // Test taking
    'start_test' => 'Mulai Tes',
    'resume_test' => 'Lanjutkan Tes',
    'submit_test' => 'Kirim Tes',
    'test_completed' => 'Tes Selesai',
    'test_expired' => 'Tes Kedaluwarsa',
    'time_remaining' => 'Waktu Tersisa',
    'questions_remaining' => 'Pertanyaan Tersisa',

    // Test validation
    'test_not_found' => 'Tes tidak ditemukan',
    'test_not_available' => 'Tes tidak tersedia',
    'test_expired' => 'Tes telah kedaluwarsa',
    'max_attempts_reached' => 'Maksimal percobaan tercapai',
    'profile_required' => 'Pelengkapan profil diperlukan',
    'payment_required' => 'Pembayaran diperlukan',

    // Test results
    'score' => 'Skor',
    'percentage' => 'Persentase',
    'percentile' => 'Persentil',
    'interpretation' => 'Interpretasi',
    'recommendations' => 'Rekomendasi',
    'certificate' => 'Sertifikat',
    'download_certificate' => 'Unduh Sertifikat',
    'view_results' => 'Lihat Hasil',
    'share_results' => 'Bagikan Hasil',

    // Test categories
    'categories' => 'Kategori',
    'create_category' => 'Buat Kategori',
    'edit_category' => 'Edit Kategori',
    'category_name' => 'Nama Kategori',
    'category_description' => 'Deskripsi Kategori',

    // Test management
    'publish_test' => 'Publikasikan Tes',
    'unpublish_test' => 'Batal Publikasikan Tes',
    'duplicate_test' => 'Duplikat Tes',
    'preview_test' => 'Pratinjau Tes',
    'test_statistics' => 'Statistik Tes',
    'total_attempts' => 'Total Percobaan',
    'average_score' => 'Rata-rata Skor',
    'completion_rate' => 'Tingkat Penyelesaian',

    // Test taking interface
    'question' => 'Pertanyaan',
    'previous_question' => 'Pertanyaan Sebelumnya',
    'next_question' => 'Pertanyaan Selanjutnya',
    'mark_for_review' => 'Tandai untuk Ditinjau',
    'clear_answer' => 'Hapus Jawaban',
    'time_up' => 'Waktu habis!',
    'auto_submit_warning' => 'Tes akan otomatis dikirim dalam :seconds detik',

    // Test security
    'security_warning' => 'Peringatan Keamanan',
    'tab_change_detected' => 'Perubahan tab terdeteksi',
    'copy_paste_detected' => 'Copy/paste terdeteksi',
    'right_click_detected' => 'Klik kanan terdeteksi',
    'fullscreen_required' => 'Mode layar penuh diperlukan',
    'camera_required' => 'Akses kamera diperlukan',
    'microphone_required' => 'Akses mikrofon diperlukan',

    // Test handlers
    'handlers' => [
        'disc' => 'Tes Kepribadian DISC',
        'iq' => 'Tes IQ',
        'mbti' => 'Tes Kepribadian MBTI',
        'tpa' => 'Tes TPA',
        'custom' => 'Tes Kustom',
    ],

    // Test configuration
    'randomize_questions' => 'Acak Pertanyaan',
    'show_results_immediately' => 'Tampilkan Hasil Segera',
    'allow_retake' => 'Izinkan Ulang',
    'require_fullscreen' => 'Wajib Layar Penuh',
    'enable_camera' => 'Aktifkan Monitoring Kamera',
    'enable_screen_capture' => 'Aktifkan Capture Layar',

    // Test analytics
    'analytics' => 'Analytics',
    'performance_metrics' => 'Metrik Performa',
    'user_engagement' => 'Keterlibatan Pengguna',
    'completion_trends' => 'Tren Penyelesaian',
    'popular_tests' => 'Tes Populer',

    // Bulk operations
    'bulk_actions' => 'Aksi Massal',
    'bulk_publish' => 'Publikasikan Massal',
    'bulk_unpublish' => 'Batal Publikasikan Massal',
    'bulk_delete' => 'Hapus Massal',
    'bulk_export' => 'Ekspor Massal',

    // Test import/export
    'import_tests' => 'Impor Tes',
    'export_tests' => 'Ekspor Tes',
    'import_success' => 'Tes berhasil diimpor',
    'import_failed' => 'Impor tes gagal',
    'export_success' => 'Tes berhasil diekspor',

    // Test notifications
    'test_published' => 'Tes berhasil dipublikasikan',
    'test_unpublished' => 'Tes berhasil dibatalkan publikasi',
    'test_created' => 'Tes berhasil dibuat',
    'test_updated' => 'Tes berhasil diperbarui',
    'test_deleted' => 'Tes berhasil dihapus',

    // Test taking flow
    'welcome_message' => 'Selamat datang di tes',
    'read_instructions' => 'Silakan baca instruksi dengan teliti',
    'begin_test' => 'Mulai Tes',
    'test_paused' => 'Tes dijeda',
    'test_resumed' => 'Tes dilanjutkan',
    'test_submitted' => 'Tes berhasil dikirim',
    'test_timeout' => 'Tes kehabisan waktu',
];
