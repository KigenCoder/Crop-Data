<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regionWhereClause', function (Blueprint $table) {
            $table->increments('id');
            $table->string("region");
            $table->unsignedInteger("zone_id");
            $table->timestamps();

            $table->foreign("zone_id")
                ->references("id")
                ->on("zoneWhereClause")
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
        Schema::dropIfExists('regionWhereClause');
    }
}