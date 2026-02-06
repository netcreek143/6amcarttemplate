<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ScrubFutureColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Orders Table - Scrub Future Columns
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                $columnsToDrop = [
                    'refund_request_canceled',
                    'cancellation_reason',
                    'canceled_by',
                    'coupon_created_by',
                    'discount_on_product_by',
                    'processing_time',
                    'unavailable_item_note',
                    'cutlery',
                    'delivery_instruction',
                    'tax_percentage',
                    'additional_charge',
                    'order_proof',
                    'partially_paid_amount',
                    'is_guest',
                    'flash_admin_discount_amount',
                    'flash_store_discount_amount',
                    'cash_back_id',
                    'extra_packaging_amount',
                    'ref_bonus_amount',
                    'tax_type',
                    'bring_change_amount',
                    'cancellation_note',
                    // Re-verifying previous ones to be safe
                    'free_delivery_by',
                    'dm_tips',
                    'prescription_order',
                    'tax_status',
                ];

                foreach ($columnsToDrop as $column) {
                    if (Schema::hasColumn('orders', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        // Users Table - Scrub Future Columns (just in case)
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $columnsToDrop = [
                    'wallet_balance',
                    'loyalty_point',
                    'ref_code',
                    'current_language_key',
                    'ref_by',
                    'temp_token',
                    'module_ids',
                    'is_email_verified',
                    'is_from_pos',
                    'login_medium',
                    'social_id'
                ];
                foreach ($columnsToDrop as $column) {
                    if (Schema::hasColumn('users', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        // Order Transactions
        if (Schema::hasTable('order_transactions')) {
            Schema::table('order_transactions', function (Blueprint $table) {
                $columnsToDrop = [
                    'dm_tips',
                    'delivery_fee_comission',
                    'admin_expense',
                    'store_expense',
                    'discount_amount_by_store',
                    'additional_charge',
                    'extra_packaging_amount',
                    'ref_bonus_amount',
                    'commission_percentage',
                    'is_subscribed'
                ];
                foreach ($columnsToDrop as $column) {
                    if (Schema::hasColumn('order_transactions', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        // Parcel Categories
        if (Schema::hasTable('parcel_categories')) {
            Schema::table('parcel_categories', function (Blueprint $table) {
                $columnsToDrop = ['parcel_per_km_shipping_charge', 'parcel_minimum_shipping_charge'];
                foreach ($columnsToDrop as $column) {
                    if (Schema::hasColumn('parcel_categories', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        // Module Zone
        if (Schema::hasTable('module_zone')) {
            Schema::table('module_zone', function (Blueprint $table) {
                $columnsToDrop = [
                    'maximum_cod_order_amount',
                    'maximum_shipping_charge',
                    'fixed_shipping_charge'
                ];
                foreach ($columnsToDrop as $column) {
                    if (Schema::hasColumn('module_zone', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        // Vendors
        if (Schema::hasTable('vendors')) {
            Schema::table('vendors', function (Blueprint $table) {
                $columnsToDrop = ['firebase_token', 'auth_token', 'login_remember_token'];
                foreach ($columnsToDrop as $column) {
                    if (Schema::hasColumn('vendors', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        // Vendor Employees
        if (Schema::hasTable('vendor_employees')) {
            Schema::table('vendor_employees', function (Blueprint $table) {
                $columnsToDrop = ['firebase_token', 'auth_token', 'login_remember_token'];
                foreach ($columnsToDrop as $column) {
                    if (Schema::hasColumn('vendor_employees', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        // Add Ons
        if (Schema::hasTable('add_ons')) {
            Schema::table('add_ons', function (Blueprint $table) {
                if (Schema::hasColumn('add_ons', 'addon_category_id')) {
                    $table->dropColumn('addon_category_id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No reverse needed
    }
}
