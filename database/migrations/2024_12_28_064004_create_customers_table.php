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
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // Tự tăng, primary key
            $table->string('email')->unique(); // Email, unique
            $table->string('password'); // Mật khẩu mã hóa
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active'); // Trạng thái tài khoản
            $table->enum('account_type', ['basic', 'premium', 'enterprise'])->default('basic'); // Loại tài khoản
            $table->dateTime('last_login')->nullable(); // Thời gian đăng nhập gần nhất
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
