<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Email Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for email content and subjects.
    |
    */

    'verification' => [
        'subject' => 'Verifikasi Alamat Email Anda - RuangTes',
        'greeting' => 'Halo :name!',
        'line_1' => 'Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda.',
        'action' => 'Verifikasi Email',
        'line_2' => 'Jika Anda tidak membuat akun, tidak ada tindakan lebih lanjut yang diperlukan.',
        'line_3' => 'Link verifikasi ini akan kedaluwarsa dalam :count menit.',
        'salutation' => 'Salam,',
        'subcopy' => 'Jika Anda mengalami kesulitan mengklik tombol ":actionText", salin dan tempel URL di bawah ini ke browser web Anda:',
    ],

    'password_reset' => [
        'subject' => 'Reset Password Anda - RuangTes',
        'greeting' => 'Halo :name!',
        'line_1' => 'Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.',
        'action' => 'Reset Password',
        'line_2' => 'Link reset password ini akan kedaluwarsa dalam :count menit.',
        'line_3' => 'Jika Anda tidak meminta reset password, tidak ada tindakan lebih lanjut yang diperlukan.',
        'salutation' => 'Salam,',
        'subcopy' => 'Jika Anda mengalami kesulitan mengklik tombol ":actionText", salin dan tempel URL di bawah ini ke browser web Anda:',
    ],

    'welcome' => [
        'subject' => 'Selamat Datang di RuangTes!',
        'greeting' => 'Selamat datang di RuangTes, :name!',
        'line_1' => 'Terima kasih telah bergabung dengan RuangTes. Akun Anda telah berhasil diverifikasi dan diaktifkan.',
        'line_2' => 'Sekarang Anda dapat mengakses semua fitur platform kami termasuk mengikuti tes, mengelola penilaian, dan melihat hasil Anda.',
        'get_started' => 'Mulai Sekarang',
        'features' => [
            'title' => 'Yang dapat Anda lakukan:',
            'take_tests' => 'Mengikuti berbagai tes psikologi dan keterampilan',
            'view_results' => 'Melihat hasil tes dan interpretasi yang detail',
            'manage_profile' => 'Mengelola profil dan riwayat tes Anda',
            'get_certificates' => 'Mengunduh sertifikat setelah menyelesaikan tes',
        ],
        'support' => [
            'title' => 'Butuh Bantuan?',
            'line_1' => 'Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi tim dukungan kami.',
            'contact' => 'Hubungi Dukungan',
        ],
        'salutation' => 'Salam hormat,',
        'team' => 'Tim RuangTes',
    ],

    'company_verification' => [
        'subject' => 'Verifikasi Perusahaan Diperlukan - RuangTes',
        'greeting' => 'Halo :name!',
        'line_1' => 'Pendaftaran perusahaan Anda telah diterima dan sedang menunggu verifikasi.',
        'line_2' => 'Kami akan meninjau aplikasi Anda dan memberikan tanggapan dalam 1-2 hari kerja.',
        'line_3' => 'Setelah diverifikasi, Anda akan memiliki akses ke dashboard perusahaan dimana Anda dapat:',
        'features' => [
            'manage_employees' => 'Mengelola akun karyawan dan akses',
            'create_tests' => 'Membuat dan mengelola tes kustom',
            'view_reports' => 'Melihat laporan dan analitik yang detail',
            'invite_participants' => 'Mengundang peserta untuk mengikuti tes',
        ],
        'salutation' => 'Salam,',
    ],

    'company_approved' => [
        'subject' => 'Akun Perusahaan Disetujui - RuangTes',
        'greeting' => 'Selamat :name!',
        'line_1' => 'Akun perusahaan Anda telah disetujui dan sekarang aktif.',
        'line_2' => 'Sekarang Anda dapat mengakses dashboard perusahaan dan mulai menggunakan semua fitur.',
        'action' => 'Akses Dashboard',
        'next_steps' => [
            'title' => 'Langkah Selanjutnya:',
            'step_1' => 'Masuk ke dashboard perusahaan Anda',
            'step_2' => 'Lengkapi profil perusahaan',
            'step_3' => 'Undang anggota tim dan administrator',
            'step_4' => 'Buat tes atau penilaian pertama Anda',
        ],
        'salutation' => 'Selamat bergabung,',
    ],

    'participant_invitation' => [
        'subject' => 'Anda Diundang Mengikuti Tes - RuangTes',
        'greeting' => 'Halo :name!',
        'line_1' => ':company_name telah mengundang Anda untuk berpartisipasi dalam penilaian.',
        'line_2' => 'Silakan klik tombol di bawah ini untuk mengakses dashboard tes Anda.',
        'action' => 'Akses Dashboard Tes',
        'test_details' => [
            'title' => 'Detail Tes:',
            'name' => 'Nama Tes: :test_name',
            'deadline' => 'Deadline: :deadline',
            'duration' => 'Durasi: :duration menit',
        ],
        'instructions' => [
            'title' => 'Instruksi:',
            'line_1' => 'Pastikan Anda memiliki koneksi internet yang stabil',
            'line_2' => 'Temukan tempat yang tenang untuk mengikuti tes',
            'line_3' => 'Anda mungkin perlu mengaktifkan akses kamera dan mikrofon',
            'line_4' => 'Selesaikan tes dalam batas waktu yang diberikan',
        ],
        'salutation' => 'Salam hormat,',
    ],

    'test_completed' => [
        'subject' => 'Tes Berhasil Diselesaikan - RuangTes',
        'greeting' => 'Selamat :name!',
        'line_1' => 'Anda telah berhasil menyelesaikan tes ":test_name".',
        'line_2' => 'Hasil Anda sekarang tersedia untuk ditinjau.',
        'action' => 'Lihat Hasil',
        'results_summary' => [
            'title' => 'Ringkasan Hasil:',
            'score' => 'Skor: :score/:total (:percentage%)',
            'completion_time' => 'Waktu Penyelesaian: :time',
            'status' => 'Status: :status',
        ],
        'next_steps' => 'Sekarang Anda dapat melihat hasil detail, mengunduh sertifikat (jika tersedia), dan melihat interpretasi hasil tes Anda.',
        'salutation' => 'Kerja bagus,',
    ],

    'test_reminder' => [
        'subject' => 'Pengingat Tes - RuangTes',
        'greeting' => 'Halo :name!',
        'line_1' => 'Ini adalah pengingat ramah bahwa Anda memiliki tes yang akan segera jatuh tempo.',
        'line_2' => 'Pastikan untuk menyelesaikan tes Anda sebelum deadline.',
        'action' => 'Ikuti Tes Sekarang',
        'test_details' => [
            'name' => 'Tes: :test_name',
            'deadline' => 'Deadline: :deadline',
            'time_remaining' => 'Waktu Tersisa: :time',
        ],
        'salutation' => 'Salam,',
    ],

    'account_suspended' => [
        'subject' => 'Akun Ditangguhkan - RuangTes',
        'greeting' => 'Halo :name!',
        'line_1' => 'Akun Anda telah ditangguhkan sementara.',
        'line_2' => 'Alasan: :reason',
        'line_3' => 'Jika Anda yakin ini adalah kesalahan, silakan hubungi tim dukungan kami.',
        'action' => 'Hubungi Dukungan',
        'salutation' => 'Salam,',
    ],

    'account_reactivated' => [
        'subject' => 'Akun Diaktifkan Kembali - RuangTes',
        'greeting' => 'Halo :name!',
        'line_1' => 'Akun Anda telah diaktifkan kembali dan sekarang Anda dapat mengakses semua fitur.',
        'line_2' => 'Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.',
        'action' => 'Akses Dashboard',
        'salutation' => 'Selamat datang kembali,',
    ],
];
