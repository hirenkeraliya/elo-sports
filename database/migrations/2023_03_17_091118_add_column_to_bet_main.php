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
        Schema::table('bet_main', function (Blueprint $table) {
            

            $table->enum('won_side',['for','against']);
            $table->date('declaration_date')->nullable();
            $table->foreign('declaration_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('declaration_by')->nullable();
            $table->boolean('is_declared_result')->default(0);
            $table->decimal('streamer_fee', 8, 2)->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bet_main', function (Blueprint $table) {
            $table->dropColumn('won_side');
            $table->dropColumn('declaration_date');
            $table->dropColumn('streamer_fee');
            $table->dropColumn('is_declared_result');
            $table->dropForeign('declaration_by');
            $table->dropColumn('declaration_by');
        });
    }
};
