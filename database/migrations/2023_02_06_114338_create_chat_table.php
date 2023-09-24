<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {if (!Schema::hasTable('chat')) {
        Schema::create('chat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('livestreams_id');
            $table->longText('message')->nullable();
            $table->timestamps();
        });
    }

//        $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
//        foreach ($tableNames as $name) {
//            Schema::dropIfExists($name);
//        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat');
    }
};
