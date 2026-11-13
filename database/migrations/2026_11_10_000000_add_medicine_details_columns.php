<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            if (! Schema::hasColumn('medicines', 'batch_no')) {
                $table->string('batch_no', 25)->nullable();
            }

            if (! Schema::hasColumn('medicines', 'expiry')) {
                $table->date('expiry')->nullable();
            }

            if (! Schema::hasColumn('medicines', 'stock_alert')) {
                $table->integer('stock_alert')->default(5);
            }
        });
    }

    public function down(): void
    {
        Schema::table('medicines', function (Blueprint $table) {
            $columns = array_filter(
                ['batch_no', 'expiry', 'stock_alert'],
                fn (string $column) => Schema::hasColumn('medicines', $column)
            );

            if ($columns) {
                $table->dropColumn($columns);
            }
        });
    }
};
