<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->integer('activity_category');
            $table->boolean('children');
            $table->date('event_start_date');
            $table->date('event_end_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('datetime');
            $table->string('organizer')->nullable();
            $table->string('file')->nullable();
            $table->string('deadline')->nullable();
            $table->string('venue')->nullable();
            $table->string('capacity')->nullable();
            $table->string('target')->nullable();
            $table->string('how_to_apply')->nullable();
            $table->string('cost')->nullable();
            $table->longText('detail')->nullable();
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
        Schema::dropIfExists('events');
    }
}
