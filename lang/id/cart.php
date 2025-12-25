<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cart Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for shopping cart functionality.
    |
    */

    'title' => 'Keranjang Belanja',
    'empty' => 'Keranjang Anda kosong',
    'empty_description' => 'Tambahkan beberapa tes untuk memulai',
    'add_to_cart' => 'Tambah ke Keranjang',
    'remove_from_cart' => 'Hapus dari Keranjang',
    'update_quantity' => 'Update Jumlah',
    'clear_cart' => 'Kosongkan Keranjang',
    'checkout' => 'Checkout',
    'continue_shopping' => 'Lanjut Belanja',

    // Cart items
    'items' => 'Item',
    'item' => 'Item',
    'quantity' => 'Jumlah',
    'price' => 'Harga',
    'total' => 'Total',
    'subtotal' => 'Subtotal',
    'tax' => 'Pajak',
    'discount' => 'Diskon',
    'grand_total' => 'Total Keseluruhan',

    // Cart actions
    'increase_quantity' => 'Tambah Jumlah',
    'decrease_quantity' => 'Kurangi Jumlah',
    'remove_item' => 'Hapus Item',

    // Cart validation
    'item_added' => 'Item berhasil ditambahkan ke keranjang',
    'item_removed' => 'Item berhasil dihapus dari keranjang',
    'quantity_updated' => 'Jumlah berhasil diperbarui',
    'cart_cleared' => 'Keranjang berhasil dikosongkan',
    'cart_expired' => 'Keranjang Anda telah kedaluwarsa. Silakan refresh dan coba lagi.',

    // Cart errors
    'item_not_found' => 'Item tidak ditemukan di keranjang',
    'invalid_quantity' => 'Jumlah tidak valid',
    'test_not_available' => 'Tes tidak tersedia untuk dibeli',
    'already_purchased' => 'Anda telah membeli tes ini',
    'cart_not_found' => 'Keranjang tidak ditemukan',
    'cart_empty_checkout' => 'Tidak dapat checkout dengan keranjang kosong',

    // Cart limits
    'max_quantity_reached' => 'Jumlah maksimal tercapai untuk item ini',
    'max_items_reached' => 'Jumlah item maksimal tercapai di keranjang',

    // Coupons
    'coupon' => 'Kupon',
    'coupon_code' => 'Kode Kupon',
    'apply_coupon' => 'Terapkan Kupon',
    'remove_coupon' => 'Hapus Kupon',
    'coupon_applied' => 'Kupon berhasil diterapkan',
    'coupon_removed' => 'Kupon berhasil dihapus',
    'invalid_coupon' => 'Kode kupon tidak valid',
    'expired_coupon' => 'Kupon telah kedaluwarsa',
    'coupon_not_found' => 'Kupon tidak ditemukan',

    // Cart summary
    'cart_summary' => 'Ringkasan Keranjang',
    'order_summary' => 'Ringkasan Pesanan',
    'items_count' => '{0} Tidak ada item|{1} :count item|[2,*] :count item',
    'expires_in' => 'Kedaluwarsa dalam :time',

    // Checkout
    'proceed_to_checkout' => 'Lanjut ke Checkout',
    'checkout_title' => 'Checkout',
    'billing_information' => 'Informasi Penagihan',
    'payment_information' => 'Informasi Pembayaran',
    'review_order' => 'Tinjau Pesanan',
    'place_order' => 'Buat Pesanan',

    // Cart persistence
    'cart_saved' => 'Keranjang disimpan untuk nanti',
    'cart_restored' => 'Keranjang dipulihkan dari sesi sebelumnya',
    'save_cart' => 'Simpan Keranjang',
    'restore_cart' => 'Pulihkan Keranjang',

    // Bulk operations
    'add_multiple' => 'Tambah Beberapa Item',
    'remove_selected' => 'Hapus yang Dipilih',
    'update_selected' => 'Update yang Dipilih',

    // Cart notifications
    'added_to_cart' => ':name telah ditambahkan ke keranjang Anda',
    'removed_from_cart' => ':name telah dihapus dari keranjang Anda',
    'quantity_changed' => 'Jumlah untuk :name diubah menjadi :quantity',

    // Cart validation messages
    'validation' => [
        'cart_empty' => 'Keranjang Anda kosong',
        'invalid_items' => 'Beberapa item di keranjang Anda tidak lagi tersedia',
        'price_changed' => 'Harga telah diperbarui untuk beberapa item',
        'quantity_adjusted' => 'Beberapa jumlah telah disesuaikan',
    ],
];
