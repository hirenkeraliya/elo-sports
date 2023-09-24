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
        Schema::table('bets', function (Blueprint $table) {
           
            $table->date('claimed_date')->nullable();
            $table->boolean('is_claimed')->default(0);
            $table->boolean('is_win')->default(0);
            $table->decimal('win_amount', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bets', function (Blueprint $table) {
            $table->dropColumn('claimed_date');
            $table->dropColumn('is_claimed')->default(0);
            $table->dropColumn('is_win')->default(0);
            $table->dropColumn('win_amount', 8, 2);
        });
    }
};
