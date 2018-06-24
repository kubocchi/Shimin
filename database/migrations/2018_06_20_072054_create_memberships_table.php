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
            $table->longText('content')->nullable();
            $table->boolean('is_payment')->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->string('payment_type')->nullable();
            $table->string('linkname')->nullable();
            $table->longText('contact')->nullable();
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
