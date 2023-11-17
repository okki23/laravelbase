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
        Schema::create('t_pos', function (Blueprint $table) {
            $table->id();    
            $table->integer('trans_code');
            $table->date('date_trans');
            $table->integer('id_member');
            $table->integer('visit_type');
            $table->integer('id_marketing');
            $table->integer('id_member_referal');
            $table->integer('payment_type');
            $table->integer('amount_total');
            $table->integer('debit_card');
            $table->integer('credit_cartd');
            $table->integer('discount');
            $table->integer('number_card'); 
            $table->timestamps(); 
        });
        Schema::create('t_pos_detail', function (Blueprint $table) {
            $table->id();
            $table->string('id_trans_code');  
            $table->string('id_service'); 
            $table->string('qty');   
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pos');
    }
};
