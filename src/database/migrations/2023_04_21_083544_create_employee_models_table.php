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
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code')->length(100);
            $table->string('employee_name')->length(100);
            $table->date('birth_date')->nullable();
            $table->string('gender')->length(100)->nullable();
            $table->string('marital_status')->nullable();
            $table->string('job_title')->length(100)->nullable();
            $table->string('address')->length(100)->nullable();
            $table->date('join_date');
            $table->integer('status');
            $table->string('npwp')->length(100)->nullable();
            $table->integer('id_bank')->nullable();
            $table->string('account_bank')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable(); 
            $table->timestamps();
        });

        DB::table('employee')->insert([
            'employee_code' => 0000001,
            'employee_name' => 'Super Admin',
            'join_date' => '1970-01-01',
            'status' => 1,
            'email' => 'admin@superuser.id'
        ]);
 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
