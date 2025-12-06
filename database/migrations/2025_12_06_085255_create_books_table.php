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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tên sách
            $table->string('cover_image')->nullable(); // Ảnh bìa
            $table->text('description')->nullable(); // Mô tả
            $table->unsignedBigInteger('category_id')->nullable(); // ID thể loại
            $table->unsignedBigInteger('author_id')->nullable(); // ID tác giả
            $table->integer('quantity')->default(0); // Số lượng
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};