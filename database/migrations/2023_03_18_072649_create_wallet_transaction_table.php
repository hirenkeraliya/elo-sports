<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('bet_id')->nullable();
            $table->foreign('bet_id')->references('id')->on('bets')->onDelete('cascade');
            $table->unsignedBigInteger('bet_main_id')->nullable();
            $table->foreign('bet_main_id')->references('id')->on('bet_main')->onDelete('cascade');
            $table->unsignedBigInteger('game_id')->nullable();
            $table->foreign('game_id')->references('id')->on('livestreams')->onDelete('cascade');
        
            $table->decimal('transaction_amount', 8, 2);
            $table->enum('transaction_type',['credit','debit']);
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_transaction');
    }
};
