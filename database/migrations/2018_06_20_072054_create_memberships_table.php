<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('organizer');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('file')->nullable();
            $table->longText('content');
            $table->decimal('amount', 8, 0);
            $table->boolean('payment_type');
            $table->string('linkname');
            $table->longText('contact');
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
        Schema::dropIfExists('memberships');
    }
}
