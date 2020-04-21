<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id');
            $table->string('name');
            $table->point('geometry');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });

        Schema::table(
            'areas', function(Blueprint $table) {
                $table->foreign('location_id')
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
        Schema::dropIfExists('areas');
    }
}
