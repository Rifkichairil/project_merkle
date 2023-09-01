<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // membuat table user dengan migrate
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('role'); // saya tambahkan role untuk user
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });


        // Untuk membuat user admin pada table user
        DB::table('users')->insert([
            'name'      => 'Admin',
            'email'     => 'Admin@merkle.com',
            'role'      => 99,
            'password'  => Hash::make('PasswordWeeding123')
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
