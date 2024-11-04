<?php

use Carbon\Traits\Timestamp;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->unique()->required();
            $table->string('name')->required();
            $table->text('description')->nullable();
            $table->decimal('price')->required();
            $table->integer('stock')->nullable();
            $table->string('image')->nullable();
            $table->timestamps('created_at');
            $table->timestamps('updated_at');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
