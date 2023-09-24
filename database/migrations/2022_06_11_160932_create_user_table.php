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
        Schema::create('user', function (Blueprint $table) {
           $table->id();
           $table->string('Email')->unique();
           $table->string('Password');
           $table->string('FirstName');
           $table->string('LastName');
           $table->string('Username');
           $table->string('Phone')->nullable();
           $table->string('Business_info')->nullable();
           $table->string('Profile')->nullable();
           $table->string('Address')->nullable();
           $table->integer('Elo_balance')->default(0);
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
        Schema::dropIfExists('user');
    }
};
