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
        if (!Schema::hasTable('bet_main')) {
        Schema::create('bet_main', function (Blueprint $table) {
            $table->id();
            $table->decimal('betting_amount', 8, 2);
            $table->string('for_text');
            $table->string('against_text');
            $table->text('description');
            $table->unsignedBigInteger('master_betting_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('livestream_id');
            $table->foreign('master_betting_id')->references('id')->on('betting_master')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('livestream_id')->references('id')->on('livestreams')->onDelete('cascade');
            $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bet_main');
    }
};
