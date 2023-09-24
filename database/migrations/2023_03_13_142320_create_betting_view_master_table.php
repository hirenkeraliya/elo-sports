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
        if (!Schema::hasTable('betting_view_master')) {
        Schema::create('betting_view_master', function (Blueprint $table) {
            $table->id();
            $table->integer('no_of_views');
            $table->integer('no_of_bet');
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
        Schema::dropIfExists('betting_view_master');
    }
};
