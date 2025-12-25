<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Orders Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for order management and payments.
    |
    */

    'title' => 'Pesanan',
    'create_order' => 'Buat Pesanan',
    'view_order' => 'Lihat Pesanan',
    'edit_order' => 'Edit Pesanan',
    'cancel_order' => 'Batalkan Pesanan',
    'refund_order' => 'Kembalikan Pesanan',
    'order_details' => 'Detail Pesanan',
    'order_history' => 'Riwayat Pesanan',
    'order_number' => 'Nomor Pesanan',
    'order_date' => 'Tanggal Pesanan',
    'order_status' => 'Status Pesanan',

    // Order types
    'order_types' => [
        'test_purchase' => 'Pembelian Tes',
        'subscription' => 'Langganan',
        'bulk_purchase' => 'Pembelian Massal',
    ],

    // Order statuses
    'order_statuses' => [
        'pending' => 'Menunggu',
        'payment_pending' => 'Menunggu Pembayaran',
        'paid' => 'Dibayar',
        'processing' => 'Diproses',
        'completed' => 'Selesai',
        'cancelled' => 'Dibatalkan',
        'refunded' => 'Dikembalikan',
        'failed' => 'Gagal',
    ],

    // Order items
    'order_items' => 'Item Pesanan',
    'item_name' => 'Nama Item',
    'item_type' => 'Tipe Item',
    'quantity' => 'Jumlah',
    'unit_price' => 'Harga Satuan',
    'total_price' => 'Total Harga',
    'item_options' => 'Opsi Item',

    // Pricing
    'subtotal' => 'Subtotal',
    'tax' => 'Pajak',
    'tax_amount' => 'Jumlah Pajak',
    'discount' => 'Diskon',
    'discount_amount' => 'Jumlah Diskon',
    'shipping' => 'Pengiriman',
    'shipping_amount' => 'Biaya Pengiriman',
    'total' => 'Total',
    'grand_total' => 'Total Keseluruhan',

    // Payment
    'payment' => 'Pembayaran',
    'payment_method' => 'Metode Pembayaran',
    'payment_gateway' => 'Gateway Pembayaran',
    'payment_reference' => 'Referensi Pembayaran',
    'payment_status' => 'Status Pembayaran',
    'payment_date' => 'Tanggal Pembayaran',
    'paid_amount' => 'Jumlah Dibayar',
    'outstanding_amount' => 'Sisa Pembayaran',

    // Payment methods
    'payment_methods' => [
        'bank_transfer' => 'Transfer Bank',
        'credit_card' => 'Kartu Kredit',
        'debit_card' => 'Kartu Debit',
        'digital_wallet' => 'Dompet Digital',
        'virtual_account' => 'Virtual Account',
        'ewallet' => 'E-Wallet',
        'manual' => 'Pembayaran Manual',
    ],

    // Billing information
    'billing_information' => 'Informasi Penagihan',
    'billing_name' => 'Nama Penagihan',
    'billing_email' => 'Email Penagihan',
    'billing_address' => 'Alamat Penagihan',
    'billing_city' => 'Kota Penagihan',
    'billing_state' => 'Provinsi Penagihan',
    'billing_postal_code' => 'Kode Pos Penagihan',
    'billing_country' => 'Negara Penagihan',
    'billing_phone' => 'Telepon Penagihan',

    // Order actions
    'process_payment' => 'Proses Pembayaran',
    'mark_as_paid' => 'Tandai sebagai Dibayar',
    'mark_as_completed' => 'Tandai sebagai Selesai',
    'generate_invoice' => 'Generate Invoice',
    'download_invoice' => 'Unduh Invoice',
    'send_invoice' => 'Kirim Invoice',
    'view_receipt' => 'Lihat Receipt',

    // Order validation
    'order_not_found' => 'Pesanan tidak ditemukan',
    'invalid_order_status' => 'Status pesanan tidak valid',
    'payment_already_processed' => 'Pembayaran sudah diproses',
    'order_already_completed' => 'Pesanan sudah selesai',
    'cannot_cancel_paid_order' => 'Tidak dapat membatalkan pesanan yang sudah dibayar',
    'cannot_refund_unpaid_order' => 'Tidak dapat mengembalikan pesanan yang belum dibayar',

    // Order notifications
    'order_created' => 'Pesanan berhasil dibuat',
    'order_updated' => 'Pesanan berhasil diperbarui',
    'order_cancelled' => 'Pesanan berhasil dibatalkan',
    'order_refunded' => 'Pesanan berhasil dikembalikan',
    'order_completed' => 'Pesanan berhasil diselesaikan',
    'payment_received' => 'Pembayaran berhasil diterima',
    'payment_failed' => 'Pembayaran gagal',
    'invoice_sent' => 'Invoice berhasil dikirim',

    // Order reports
    'order_reports' => 'Laporan Pesanan',
    'sales_report' => 'Laporan Penjualan',
    'revenue_report' => 'Laporan Pendapatan',
    'payment_report' => 'Laporan Pembayaran',
    'refund_report' => 'Laporan Pengembalian',

    // Order search & filter
    'search_orders' => 'Cari Pesanan',
    'filter_by_status' => 'Filter berdasarkan Status',
    'filter_by_type' => 'Filter berdasarkan Tipe',
    'filter_by_date' => 'Filter berdasarkan Tanggal',
    'filter_by_amount' => 'Filter berdasarkan Jumlah',
    'advanced_filters' => 'Filter Lanjutan',

    // Checkout process
    'checkout' => 'Checkout',
    'checkout_success' => 'Pesanan berhasil dibuat!',
    'checkout_failed' => 'Checkout gagal. Silakan coba lagi.',
    'payment_processing' => 'Memproses pembayaran...',
    'order_confirmation' => 'Konfirmasi Pesanan',
    'thank_you_for_order' => 'Terima kasih atas pesanan Anda',

    // Refunds
    'refund' => 'Pengembalian',
    'refund_amount' => 'Jumlah Pengembalian',
    'refund_reason' => 'Alasan Pengembalian',
    'partial_refund' => 'Pengembalian Sebagian',
    'full_refund' => 'Pengembalian Penuh',
    'refund_processed' => 'Pengembalian berhasil diproses',
    'refund_failed' => 'Pengembalian gagal',

    // Order tracking
    'track_order' => 'Lacak Pesanan',
    'order_tracking' => 'Pelacakan Pesanan',
    'tracking_number' => 'Nomor Pelacakan',
    'estimated_delivery' => 'Estimasi Pengiriman',
    'order_delivered' => 'Pesanan Diterima',

    // Order statistics
    'total_orders' => 'Total Pesanan',
    'total_revenue' => 'Total Pendapatan',
    'average_order_value' => 'Rata-rata Nilai Pesanan',
    'conversion_rate' => 'Tingkat Konversi',
    'refund_rate' => 'Tingkat Pengembalian',
];
