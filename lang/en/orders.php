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

    'title' => 'Orders',
    'create_order' => 'Create Order',
    'view_order' => 'View Order',
    'edit_order' => 'Edit Order',
    'cancel_order' => 'Cancel Order',
    'refund_order' => 'Refund Order',
    'order_details' => 'Order Details',
    'order_history' => 'Order History',
    'order_number' => 'Order Number',
    'order_date' => 'Order Date',
    'order_status' => 'Order Status',

    // Order types
    'order_types' => [
        'test_purchase' => 'Test Purchase',
        'subscription' => 'Subscription',
        'bulk_purchase' => 'Bulk Purchase',
    ],

    // Order statuses
    'order_statuses' => [
        'pending' => 'Pending',
        'payment_pending' => 'Payment Pending',
        'paid' => 'Paid',
        'processing' => 'Processing',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'refunded' => 'Refunded',
        'failed' => 'Failed',
    ],

    // Order items
    'order_items' => 'Order Items',
    'item_name' => 'Item Name',
    'item_type' => 'Item Type',
    'quantity' => 'Quantity',
    'unit_price' => 'Unit Price',
    'total_price' => 'Total Price',
    'item_options' => 'Item Options',

    // Pricing
    'subtotal' => 'Subtotal',
    'tax' => 'Tax',
    'tax_amount' => 'Tax Amount',
    'discount' => 'Discount',
    'discount_amount' => 'Discount Amount',
    'shipping' => 'Shipping',
    'shipping_amount' => 'Shipping Amount',
    'total' => 'Total',
    'grand_total' => 'Grand Total',

    // Payment
    'payment' => 'Payment',
    'payment_method' => 'Payment Method',
    'payment_gateway' => 'Payment Gateway',
    'payment_reference' => 'Payment Reference',
    'payment_status' => 'Payment Status',
    'payment_date' => 'Payment Date',
    'paid_amount' => 'Paid Amount',
    'outstanding_amount' => 'Outstanding Amount',

    // Payment methods
    'payment_methods' => [
        'bank_transfer' => 'Bank Transfer',
        'credit_card' => 'Credit Card',
        'debit_card' => 'Debit Card',
        'digital_wallet' => 'Digital Wallet',
        'virtual_account' => 'Virtual Account',
        'ewallet' => 'E-Wallet',
        'manual' => 'Manual Payment',
    ],

    // Billing information
    'billing_information' => 'Billing Information',
    'billing_name' => 'Billing Name',
    'billing_email' => 'Billing Email',
    'billing_address' => 'Billing Address',
    'billing_city' => 'Billing City',
    'billing_state' => 'Billing State',
    'billing_postal_code' => 'Billing Postal Code',
    'billing_country' => 'Billing Country',
    'billing_phone' => 'Billing Phone',

    // Order actions
    'process_payment' => 'Process Payment',
    'mark_as_paid' => 'Mark as Paid',
    'mark_as_completed' => 'Mark as Completed',
    'generate_invoice' => 'Generate Invoice',
    'download_invoice' => 'Download Invoice',
    'send_invoice' => 'Send Invoice',
    'view_receipt' => 'View Receipt',

    // Order validation
    'order_not_found' => 'Order not found',
    'invalid_order_status' => 'Invalid order status',
    'payment_already_processed' => 'Payment already processed',
    'order_already_completed' => 'Order already completed',
    'cannot_cancel_paid_order' => 'Cannot cancel paid order',
    'cannot_refund_unpaid_order' => 'Cannot refund unpaid order',

    // Order notifications
    'order_created' => 'Order created successfully',
    'order_updated' => 'Order updated successfully',
    'order_cancelled' => 'Order cancelled successfully',
    'order_refunded' => 'Order refunded successfully',
    'order_completed' => 'Order completed successfully',
    'payment_received' => 'Payment received successfully',
    'payment_failed' => 'Payment failed',
    'invoice_sent' => 'Invoice sent successfully',

    // Order reports
    'order_reports' => 'Order Reports',
    'sales_report' => 'Sales Report',
    'revenue_report' => 'Revenue Report',
    'payment_report' => 'Payment Report',
    'refund_report' => 'Refund Report',

    // Order search & filter
    'search_orders' => 'Search Orders',
    'filter_by_status' => 'Filter by Status',
    'filter_by_type' => 'Filter by Type',
    'filter_by_date' => 'Filter by Date',
    'filter_by_amount' => 'Filter by Amount',
    'advanced_filters' => 'Advanced Filters',

    // Checkout process
    'checkout' => 'Checkout',
    'checkout_success' => 'Order placed successfully!',
    'checkout_failed' => 'Checkout failed. Please try again.',
    'payment_processing' => 'Processing payment...',
    'order_confirmation' => 'Order Confirmation',
    'thank_you_for_order' => 'Thank you for your order',

    // Refunds
    'refund' => 'Refund',
    'refund_amount' => 'Refund Amount',
    'refund_reason' => 'Refund Reason',
    'partial_refund' => 'Partial Refund',
    'full_refund' => 'Full Refund',
    'refund_processed' => 'Refund processed successfully',
    'refund_failed' => 'Refund failed',

    // Order tracking
    'track_order' => 'Track Order',
    'order_tracking' => 'Order Tracking',
    'tracking_number' => 'Tracking Number',
    'estimated_delivery' => 'Estimated Delivery',
    'order_delivered' => 'Order Delivered',

    // Order statistics
    'total_orders' => 'Total Orders',
    'total_revenue' => 'Total Revenue',
    'average_order_value' => 'Average Order Value',
    'conversion_rate' => 'Conversion Rate',
    'refund_rate' => 'Refund Rate',
];
