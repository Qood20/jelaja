<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('transactions')) {
            Schema::table('transactions', function (Blueprint $table) {
                if (! Schema::hasColumn('transactions', 'visit_date')) {
                    $table->date('visit_date')->nullable()->after('midtrans_redirect_url');
                }

                if (! Schema::hasColumn('transactions', 'quantity')) {
                    $table->unsignedInteger('quantity')->default(1)->after('visit_date');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('transactions')) {
            Schema::table('transactions', function (Blueprint $table) {
                if (Schema::hasColumn('transactions', 'quantity')) {
                    $table->dropColumn('quantity');
                }
                if (Schema::hasColumn('transactions', 'visit_date')) {
                    $table->dropColumn('visit_date');
                }
            });
        }
    }
};
