<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->after('category_id')
                ->constrained('users')
                ->nullOnDelete();

            $table->string('title')->nullable()->after('slug');
            $table->string('keywords')->nullable()->after('title');
            $table->text('detail')->nullable()->after('description');
            $table->integer('minstock')->default(0)->after('stock');
            $table->integer('discount')->default(0)->after('minstock');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id',
                'title',
                'keywords',
                'detail',
                'minstock',
                'discount',
            ]);
        });
    }
};