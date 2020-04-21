<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_id');
            $table->unsignedTinyInteger('level');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(
            'locations', function (Blueprint $table) {
                $table->foreign('parent_id')
                      ->references('id')
                      ->on('locations')
                      ->onDelete('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
