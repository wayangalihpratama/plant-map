<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarbonHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carbon_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_tree_id');
            $table->unsignedDecimal('carbon', 8, 2);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(
            'carbon_histories', function (Blueprint $table) {
                $table->foreign('area_tree_id')
                      ->references('id')
                      ->on('area_trees')
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
        Schema::dropIfExists('carbon_histories');
    }
}
