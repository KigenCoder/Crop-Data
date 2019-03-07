<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districtsWhereClause', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district');
            $table->unsignedInteger('region_id');
            $table->timestamps();

            $table->foreign('region_id')
                ->references('id')
                ->on('regionWhereClause')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districtsWhereClause');
    }
}
