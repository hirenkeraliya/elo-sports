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
       
            Schema::table('betting_master', function (Blueprint $table) {
                    if(!Schema::hasColumn('betting_master', 'is_active')) {
                        $table->boolean('is_active')->default(1);
                    }
                
            });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::table('betting_master', function (Blueprint $table) {
                
                if(!Schema::hasColumn('betting_master', 'is_active')) {
                        $table->dropColumn('is_active');
                    }
              
            });
    }
};
