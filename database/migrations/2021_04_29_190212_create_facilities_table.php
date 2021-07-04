<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->longText("description");
            $table->string("logo")->nullable();
            $table->string("image")->nullable();
            $table->integer("category_id")->default(1);
            $table->string("lang")->default("ru");
            $table->string("floor")->nullable();
            $table->string("work_time")->nullable();
            $table->string("web_url")->nullable();
            $table->string("social_url")->nullable();
            $table->string("map_coords")->nullable();
            $table->boolean("is_active")->default(1);
            $table->integer("order")->default(0);
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
        Schema::dropIfExists('facilities');
    }
}
