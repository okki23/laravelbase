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
        Schema::create('instruktur', function (Blueprint $table) {
            $table->id();
            $table->string('instructur_code')->length(100);
            $table->string('instructur_name')->length(100);
            $table->date('birth_date')->nullable();
            $table->string('gender')->length(100)->nullable();
            $table->string('marital_status')->nullable();
            $table->string('address')->length(100)->nullable();
            $table->date('join_date');
            $table->string('npwp')->length(100)->nullable();
            $table->integer('id_bank')->nullable();
            $table->string('account_bank')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->integer('id_group')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instruktur');
    }
};
