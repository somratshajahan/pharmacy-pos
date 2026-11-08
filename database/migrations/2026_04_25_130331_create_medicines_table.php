<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('name');                 // Medicine name
            $table->string('generic_name')->nullable();
            $table->string('brand')->nullable();
            $table->string('category')->nullable();  // tablet, syrup, capsule etc.

            // Barcode for POS scanning
            $table->string('barcode')->unique()->nullable();

            // Pricing (optional base price, batch will override in real sales)
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->decimal('sell_price', 10, 2)->nullable();

            // Status
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};