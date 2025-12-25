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

    'title' => 'Shopping Cart',
    'empty' => 'Your cart is empty',
    'empty_description' => 'Add some tests to get started',
    'add_to_cart' => 'Add to Cart',
    'remove_from_cart' => 'Remove from Cart',
    'update_quantity' => 'Update Quantity',
    'clear_cart' => 'Clear Cart',
    'checkout' => 'Checkout',
    'continue_shopping' => 'Continue Shopping',

    // Cart items
    'items' => 'Items',
    'item' => 'Item',
    'quantity' => 'Quantity',
    'price' => 'Price',
    'total' => 'Total',
    'subtotal' => 'Subtotal',
    'tax' => 'Tax',
    'discount' => 'Discount',
    'grand_total' => 'Grand Total',

    // Cart actions
    'increase_quantity' => 'Increase Quantity',
    'decrease_quantity' => 'Decrease Quantity',
    'remove_item' => 'Remove Item',

    // Cart validation
    'item_added' => 'Item added to cart successfully',
    'item_removed' => 'Item removed from cart successfully',
    'quantity_updated' => 'Quantity updated successfully',
    'cart_cleared' => 'Cart cleared successfully',
    'cart_expired' => 'Your cart has expired. Please refresh and try again.',

    // Cart errors
    'item_not_found' => 'Item not found in cart',
    'invalid_quantity' => 'Invalid quantity',
    'test_not_available' => 'Test is not available for purchase',
    'already_purchased' => 'You have already purchased this test',
    'cart_not_found' => 'Cart not found',
    'cart_empty_checkout' => 'Cannot checkout with empty cart',

    // Cart limits
    'max_quantity_reached' => 'Maximum quantity reached for this item',
    'max_items_reached' => 'Maximum items reached in cart',

    // Coupons
    'coupon' => 'Coupon',
    'coupon_code' => 'Coupon Code',
    'apply_coupon' => 'Apply Coupon',
    'remove_coupon' => 'Remove Coupon',
    'coupon_applied' => 'Coupon applied successfully',
    'coupon_removed' => 'Coupon removed successfully',
    'invalid_coupon' => 'Invalid coupon code',
    'expired_coupon' => 'Coupon has expired',
    'coupon_not_found' => 'Coupon not found',

    // Cart summary
    'cart_summary' => 'Cart Summary',
    'order_summary' => 'Order Summary',
    'items_count' => '{0} No items|{1} :count item|[2,*] :count items',
    'expires_in' => 'Expires in :time',

    // Checkout
    'proceed_to_checkout' => 'Proceed to Checkout',
    'checkout_title' => 'Checkout',
    'billing_information' => 'Billing Information',
    'payment_information' => 'Payment Information',
    'review_order' => 'Review Order',
    'place_order' => 'Place Order',

    // Cart persistence
    'cart_saved' => 'Cart saved for later',
    'cart_restored' => 'Cart restored from previous session',
    'save_cart' => 'Save Cart',
    'restore_cart' => 'Restore Cart',

    // Bulk operations
    'add_multiple' => 'Add Multiple Items',
    'remove_selected' => 'Remove Selected',
    'update_selected' => 'Update Selected',

    // Cart notifications
    'added_to_cart' => ':name has been added to your cart',
    'removed_from_cart' => ':name has been removed from your cart',
    'quantity_changed' => 'Quantity for :name changed to :quantity',

    // Cart validation messages
    'validation' => [
        'cart_empty' => 'Your cart is empty',
        'invalid_items' => 'Some items in your cart are no longer available',
        'price_changed' => 'Prices have been updated for some items',
        'quantity_adjusted' => 'Some quantities have been adjusted',
    ],
];
