<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobusInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('globus_infos', function (Blueprint $table) {
            $table->id();
            $table->string("address");
            $table->string("phone");
            $table->string("social_url")->nullable();
            $table->string("work_time")->nullable();
            $table->string("lang")->default("ru");
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
        Schema::dropIfExists('globus_infos');
    }
}
