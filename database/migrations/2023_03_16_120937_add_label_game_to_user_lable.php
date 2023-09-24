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
        Schema::table('user_lable', function (Blueprint $table) {
            if(!Schema::hasColumn('user_lable', 'label_game')) {
                $table->string('label_game');
                };
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_lable', function (Blueprint $table) {
            $table->dropColumn('label_game');
        });
    }
};
