<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Participants Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for participant management.
    |
    */

    'title' => 'Peserta',
    'create_participant' => 'Buat Peserta',
    'edit_participant' => 'Edit Peserta',
    'view_participant' => 'Lihat Peserta',
    'delete_participant' => 'Hapus Peserta',
    'participant_details' => 'Detail Peserta',
    'participant_profile' => 'Profil Peserta',
    'participant_progress' => 'Progress Peserta',

    // Participant properties
    'name' => 'Nama',
    'email' => 'Email',
    'phone' => 'Telepon',
    'employee_id' => 'ID Karyawan',
    'department' => 'Departemen',
    'position' => 'Posisi',
    'unique_code' => 'Kode Unik',
    'date_of_birth' => 'Tanggal Lahir',
    'gender' => 'Jenis Kelamin',
    'education' => 'Pendidikan',
    'profile_completed' => 'Profil Lengkap',
    'test_period' => 'Periode Tes',
    'status' => 'Status',

    // Participant statuses
    'statuses' => [
        'pending' => 'Menunggu',
        'active' => 'Aktif',
        'testing' => 'Sedang Tes',
        'completed' => 'Selesai',
        'banned' => 'Diblokir',
        'expired' => 'Kedaluwarsa',
    ],

    // Participant management
    'invite_participants' => 'Undang Peserta',
    'bulk_import' => 'Impor Massal',
    'send_invitations' => 'Kirim Undangan',
    'resend_invitation' => 'Kirim Ulang Undangan',
    'view_progress' => 'Lihat Progress',
    'assign_tests' => 'Tetapkan Tes',
    'remove_assignments' => 'Hapus Penetapan',

    // Participant profile
    'complete_profile' => 'Lengkapi Profil',
    'profile_completion_required' => 'Pelengkapan profil diperlukan untuk memulai tes',
    'save_profile' => 'Simpan Profil',
    'profile_saved' => 'Profil berhasil disimpan',

    // Test assignments
    'test_assignments' => 'Penetapan Tes',
    'assigned_tests' => 'Tes yang Ditetapkan',
    'available_tests' => 'Tes yang Tersedia',
    'completed_tests' => 'Tes yang Selesai',
    'pending_tests' => 'Tes yang Menunggu',
    'in_progress_tests' => 'Tes yang Sedang Berlangsung',
    'test_order' => 'Urutan Tes',
    'assignment_status' => 'Status Penetapan',

    // Assignment statuses
    'assignment_statuses' => [
        'pending' => 'Menunggu',
        'available' => 'Tersedia',
        'started' => 'Dimulai',
        'completed' => 'Selesai',
    ],

    // Access management
    'access_token' => 'Token Akses',
    'generate_token' => 'Generate Token',
    'invalidate_token' => 'Invalidasi Token',
    'token_generated' => 'Token akses berhasil dibuat',
    'token_invalidated' => 'Token akses berhasil diinvalidasi',
    'access_link' => 'Link Akses',
    'direct_access' => 'Akses Langsung',

    // Participant validation
    'participant_not_found' => 'Peserta tidak ditemukan',
    'invalid_access_token' => 'Token akses tidak valid',
    'expired_access_token' => 'Token akses telah kedaluwarsa',
    'profile_incomplete' => 'Profil peserta belum lengkap',
    'no_assigned_tests' => 'Tidak ada tes yang ditetapkan untuk peserta ini',
    'test_not_available' => 'Tes tidak tersedia untuk peserta ini',

    // Bulk operations
    'bulk_create' => 'Buat Massal',
    'bulk_update' => 'Update Massal',
    'bulk_delete' => 'Hapus Massal',
    'bulk_invite' => 'Undang Massal',
    'bulk_assign' => 'Tetapkan Massal',

    // Import/Export
    'import_participants' => 'Impor Peserta',
    'export_participants' => 'Ekspor Peserta',
    'import_template' => 'Unduh Template Impor',
    'import_success' => 'Peserta berhasil diimpor',
    'import_failed' => 'Impor gagal',
    'export_success' => 'Peserta berhasil diekspor',

    // Statistics
    'total_participants' => 'Total Peserta',
    'active_participants' => 'Peserta Aktif',
    'completed_participants' => 'Peserta Selesai',
    'profile_completion_rate' => 'Tingkat Kelengkapan Profil',
    'test_completion_rate' => 'Tingkat Penyelesaian Tes',

    // Participant actions
    'ban_participant' => 'Blokir Peserta',
    'unban_participant' => 'Buka Blokir Peserta',
    'reset_progress' => 'Reset Progress',
    'extend_access' => 'Perpanjang Akses',
    'participant_banned' => 'Peserta berhasil diblokir',
    'participant_unbanned' => 'Peserta berhasil dibuka blokir',

    // Notifications
    'invitation_sent' => 'Undangan berhasil dikirim',
    'invitation_failed' => 'Gagal mengirim undangan',
    'invitations_sent' => ':count undangan dikirim',
    'participant_created' => 'Peserta berhasil dibuat',
    'participant_updated' => 'Peserta berhasil diperbarui',
    'participant_deleted' => 'Peserta berhasil dihapus',

    // Participant dashboard (for participants)
    'my_tests' => 'Tes Saya',
    'available_tests' => 'Tes yang Tersedia',
    'test_progress' => 'Progress Tes',
    'completion_percentage' => 'Persentase Penyelesaian',
    'time_remaining' => 'Waktu Tersisa',
    'deadline' => 'Deadline',
    'start_date' => 'Tanggal Mulai',
    'end_date' => 'Tanggal Selesai',

    // Security
    'access_logged' => 'Percobaan akses dicatat',
    'suspicious_activity' => 'Aktivitas mencurigakan terdeteksi',
    'multiple_login_attempts' => 'Beberapa percobaan login terdeteksi',

    // Reports
    'participant_reports' => 'Laporan Peserta',
    'individual_report' => 'Laporan Individu',
    'group_report' => 'Laporan Kelompok',
    'progress_report' => 'Laporan Progress',
    'completion_report' => 'Laporan Penyelesaian',

    // Search & Filter
    'search_participants' => 'Cari Peserta',
    'filter_by_status' => 'Filter berdasarkan Status',
    'filter_by_department' => 'Filter berdasarkan Departemen',
    'filter_by_completion' => 'Filter berdasarkan Penyelesaian',
    'advanced_filters' => 'Filter Lanjutan',
];
