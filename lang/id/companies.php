<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Companies Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for company management.
    |
    */

    'title' => 'Perusahaan',
    'create_company' => 'Buat Perusahaan',
    'edit_company' => 'Edit Perusahaan',
    'view_company' => 'Lihat Perusahaan',
    'delete_company' => 'Hapus Perusahaan',
    'company_details' => 'Detail Perusahaan',
    'company_profile' => 'Profil Perusahaan',
    'company_settings' => 'Pengaturan Perusahaan',

    // Company properties
    'name' => 'Nama Perusahaan',
    'code' => 'Kode Perusahaan',
    'email' => 'Email Perusahaan',
    'phone' => 'Telepon',
    'website' => 'Website',
    'address' => 'Alamat',
    'city' => 'Kota',
    'province' => 'Provinsi',
    'country' => 'Negara',
    'postal_code' => 'Kode Pos',
    'tax_id' => 'NPWP',
    'logo' => 'Logo',
    'favicon' => 'Favicon',
    'primary_color' => 'Warna Utama',
    'secondary_color' => 'Warna Sekunder',

    // Company subscription
    'subscription' => 'Langganan',
    'subscription_type' => 'Tipe Langganan',
    'subscription_start' => 'Tanggal Mulai Langganan',
    'subscription_end' => 'Tanggal Berakhir Langganan',
    'max_participants' => 'Maksimal Peserta',
    'current_participants' => 'Peserta Saat Ini',
    'remaining_participants' => 'Peserta Tersisa',

    // Subscription types
    'subscription_types' => [
        'trial' => 'Percobaan',
        'prepaid' => 'Prabayar',
        'postpaid' => 'Pascabayar',
    ],

    // Company statuses
    'status' => [
        'pending' => 'Menunggu',
        'active' => 'Aktif',
        'inactive' => 'Tidak Aktif',
        'suspended' => 'Ditangguhkan',
    ],

    // Company verification
    'verification' => 'Verifikasi',
    'is_verified' => 'Terverifikasi',
    'verification_status' => 'Status Verifikasi',
    'verify_company' => 'Verifikasi Perusahaan',
    'reject_verification' => 'Tolak Verifikasi',
    'verification_documents' => 'Dokumen Verifikasi',

    // Company management
    'manage_companies' => 'Kelola Perusahaan',
    'company_administrators' => 'Administrator Perusahaan',
    'add_administrator' => 'Tambah Administrator',
    'remove_administrator' => 'Hapus Administrator',
    'primary_administrator' => 'Administrator Utama',

    // Company branding
    'branding' => 'Branding',
    'custom_branding' => 'Branding Kustom',
    'white_label' => 'White Label',
    'custom_domain' => 'Domain Kustom',

    // Company settings
    'timezone' => 'Timezone',
    'language' => 'Bahasa',
    'date_format' => 'Format Tanggal',
    'time_format' => 'Format Waktu',
    'currency' => 'Mata Uang',

    // Company validation
    'company_not_found' => 'Perusahaan tidak ditemukan',
    'company_code_exists' => 'Kode perusahaan sudah ada',
    'invalid_company_data' => 'Data perusahaan tidak valid',
    'subscription_required' => 'Langganan diperlukan',
    'max_participants_reached' => 'Maksimal peserta tercapai',

    // Company actions
    'activate_company' => 'Aktifkan Perusahaan',
    'deactivate_company' => 'Nonaktifkan Perusahaan',
    'suspend_company' => 'Tangguhkan Perusahaan',
    'reactivate_company' => 'Reaktifkan Perusahaan',
    'upgrade_subscription' => 'Upgrade Langganan',
    'downgrade_subscription' => 'Downgrade Langganan',
    'extend_subscription' => 'Perpanjang Langganan',

    // Company notifications
    'company_created' => 'Perusahaan berhasil dibuat',
    'company_updated' => 'Perusahaan berhasil diperbarui',
    'company_deleted' => 'Perusahaan berhasil dihapus',
    'company_activated' => 'Perusahaan berhasil diaktifkan',
    'company_deactivated' => 'Perusahaan berhasil dinonaktifkan',
    'company_suspended' => 'Perusahaan berhasil ditangguhkan',
    'company_verified' => 'Perusahaan berhasil diverifikasi',

    // Company statistics
    'company_statistics' => 'Statistik Perusahaan',
    'total_participants' => 'Total Peserta',
    'active_participants' => 'Peserta Aktif',
    'completed_tests' => 'Tes Selesai',
    'total_tests_taken' => 'Total Tes Diambil',
    'average_completion_rate' => 'Rata-rata Tingkat Penyelesaian',
    'subscription_utilization' => 'Utilisasi Langganan',

    // Company reports
    'company_reports' => 'Laporan Perusahaan',
    'participant_reports' => 'Laporan Peserta',
    'test_reports' => 'Laporan Tes',
    'usage_reports' => 'Laporan Penggunaan',
    'billing_reports' => 'Laporan Penagihan',

    // Bulk operations
    'bulk_actions' => 'Aksi Massal',
    'bulk_activate' => 'Aktifkan Massal',
    'bulk_deactivate' => 'Nonaktifkan Massal',
    'bulk_verify' => 'Verifikasi Massal',
    'bulk_suspend' => 'Tangguhkan Massal',

    // Company search & filter
    'search_companies' => 'Cari Perusahaan',
    'filter_by_status' => 'Filter berdasarkan Status',
    'filter_by_subscription' => 'Filter berdasarkan Langganan',
    'filter_by_verification' => 'Filter berdasarkan Verifikasi',
    'filter_by_size' => 'Filter berdasarkan Ukuran',
    'advanced_filters' => 'Filter Lanjutan',

    // Company onboarding
    'onboarding' => 'Onboarding',
    'onboarding_welcome' => 'Selamat Datang di RuangTes',
    'onboarding_steps' => 'Langkah Onboarding',
    'setup_profile' => 'Setup Profil',
    'invite_administrators' => 'Undang Administrator',
    'configure_tests' => 'Konfigurasi Tes',
    'setup_billing' => 'Setup Penagihan',
    'onboarding_completed' => 'Onboarding Selesai',

    // Company communication
    'send_notification' => 'Kirim Notifikasi',
    'bulk_email' => 'Email Massal',
    'email_templates' => 'Template Email',
    'notification_history' => 'Riwayat Notifikasi',

    // Company API
    'api_access' => 'Akses API',
    'api_keys' => 'API Keys',
    'generate_api_key' => 'Generate API Key',
    'revoke_api_key' => 'Cabut API Key',
    'api_documentation' => 'Dokumentasi API',

    // Company security
    'security_settings' => 'Pengaturan Keamanan',
    'two_factor_auth' => 'Two-Factor Authentication',
    'password_policy' => 'Kebijakan Password',
    'session_timeout' => 'Timeout Sesi',
    'ip_whitelist' => 'IP Whitelist',
];
