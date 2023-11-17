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
        Schema::create('member', function (Blueprint $table) {
            $table->id();
            $table->string('barcode');
            $table->string('title');
            $table->string('member_name');
            $table->string('id_number')->nullable();
            $table->date('dob')->nullable();
            $table->string('pob')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('emer_contact')->nullable();
            $table->string('referal')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member');
    }
};
