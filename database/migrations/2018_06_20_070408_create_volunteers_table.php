<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->integer('activity_category');
            $table->boolean('children');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('sponsor')->nullable();
            $table->string('file')->nullable();
            $table->string('activity_date')->nullable();
            $table->string('deadline')->nullable();
            $table->string('venue')->nullable();
            $table->string('capacity')->nullable();
            $table->string('number_of_perople')->nullable();
            $table->string('orientation')->nullable();
            $table->string('cost')->nullable();
            $table->string('subscription')->nullable();
            $table->longText('content')->nullable();
            $table->string('url')->nullable();
            $table->string('phone')->nullable();
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
        Schema::dropIfExists('volunteers');
    }
}
