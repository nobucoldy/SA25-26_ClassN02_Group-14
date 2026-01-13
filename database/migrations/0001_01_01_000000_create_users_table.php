<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            
            // THÊM SỐ ĐIỆN THOẠI (Để đăng ký/đăng nhập)
            $table->string('phone')->unique()->nullable(); 
            
            // THÊM ẢNH ĐẠI DIỆN VÀ SỞ THÍCH (Để đồng bộ trang Profile)
            $table->string('avatar')->nullable();
            $table->text('hobbies')->nullable();
            
            $table->string('password');
            $table->enum('role', ['customer', 'admin'])->default('customer');
            
            // DÒNG NÀY ĐỂ FIX LỖI "GHI NHỚ TÔI" (Rất quan trọng)
            $table->rememberToken(); 
            
            $table->timestamps();
        });
    }
}
