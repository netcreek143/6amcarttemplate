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
