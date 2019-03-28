<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCropDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('district_id');
            $table->unsignedInteger('crop_id');
            $table->unsignedInteger('livelihood_system_id');
            $table->unsignedInteger('season_id');
            $table->integer('year');
            $table->string('season_production')->nullable();
            $table->string('off_season_production')->nullable();
            $table->timestamps();

            //Districts Foreign Key
            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            //Crops Foreign Key
            $table->foreign("crop_id")
                ->references("id")
                ->on("crops")
                ->onDelete("cascade")
                ->onUpdate("cascade");


            //Livelihood Systems
            $table->foreign("livelihood_system_id")
                ->references("id")
                ->on("livelihood_systems")
                ->onDelete("cascade")
                ->onUpdate("cascade");


            //Seasons
            $table->foreign("season_id")
                ->references("id")
                ->on("seasons")
                ->onDelete("cascade")
                ->onUpdate("cascade");


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crop_data');
    }
}
