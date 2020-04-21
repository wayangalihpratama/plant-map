<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_trees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tree_id');
            $table->foreignId('area_id');
            $table->unsignedInteger('age')->comment('by week');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(
            'area_trees', function (Blueprint $table) {
                $table->foreign('tree_id')
                      ->references('id')
                      ->on('trees')
                      ->onDelete('cascade');

                $table->foreign('area_id')
                      ->references('id')
                      ->on('areas')
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
        Schema::dropIfExists('area_trees');
    }
}
