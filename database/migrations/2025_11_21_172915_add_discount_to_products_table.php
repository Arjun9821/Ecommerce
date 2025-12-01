<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->decimal('discount_price', 10, 2)->nullable()->after('price');
        $table->integer('discount_percent')->nullable()->after('discount_price');
        $table->timestamp('discount_expires_at')->nullable()->after('discount_percent');
    });
}

public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['discount_price', 'discount_percent', 'discount_expires_at']);
    });
}
};