<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_centers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->date('start_date');
            $table->date('end_date');
            $table->longText('content');
            $table->string('file')->nullable();
            $table->boolean('deactivate');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('active_centers');
    }
}
