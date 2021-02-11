<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->decimal('price', 8, 2)->unsigned()->default(0);
            $table->integer('bedroom')->unsigned()->default(1);
            $table->integer('bathroom')->unsigned()->default(1);
            $table->integer('storey')->default(1);
            $table->integer('garage')->unsigned()->default(0);

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
        Schema::dropIfExists('houses');
    }
}
