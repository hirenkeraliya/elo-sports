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
        Schema::create('user_livestream_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->nullable()->default(null);
            $table->unsignedBigInteger('livestreams_id')->unsigned()->nullable()->default(null);
            $table->text('avatar_username')->nullable();
            $table->text('avatar_image')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('SET NULL');
                $table->foreign('livestreams_id')
                ->references('id')
                ->on('livestreams')
                ->onDelete('SET NULL');
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
        Schema::dropIfExists('user_livestream_details');
    }
};
