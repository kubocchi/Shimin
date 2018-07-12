<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->string('type');
            $table->integer('regist_management');
            $table->string('open_situation');
            $table->string('active_status');
            $table->date('pause_date')->nullable();
            $table->date('application_date')->nullable();
            $table->date('registration_date')->nullable();
            $table->date('establishment_date')->nullable();
            $table->string('name');
            $table->string('name_phonetic');
            $table->string('representative_name')->nullable();
            $table->string('representative_name_phonetic')->nullable();
            $table->string('disclosure_name')->nullable();
            $table->string('representative_phone')->nullable();
            $table->string('disclosure_representative_phone')->nullable();
            $table->string('representative_phone_2')->nullable();
            $table->string('disclosure_representative_phone_2')->nullable();
            $table->string('representative_fax')->nullable();
            $table->string('disclosure_representative_fax')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_name_phonetic')->nullable();
            $table->string('disclosure_contact_name')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('contact_address');
            $table->string('contact_address_name')->nullable();
            $table->string('contact_address_title')->nullable();
            $table->string('disclosure_contact_address')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('disclosure_contact_phone')->nullable();
            $table->string('contact_phone_2')->nullable();
            $table->string('disclosure_contact_phone_2')->nullable();
            $table->string('contact_fax')->nullable();
            $table->string('disclosure_contact_fax')->nullable();
            $table->string('contact_mail')->nullable();
            $table->string('disclosure_contact_mail')->nullable();
            $table->string('contact_url')->nullable();
            $table->string('disclosure_contact_url')->nullable();
            $table->string('activity_category');
            $table->string('active_category_supplement')->nullable();
            $table->string('membership_male')->nullable();
            $table->string('membership_female')->nullable();
            $table->string('all_member')->nullable();
            $table->string('activity_frequency')->nullable();
            $table->integer('activity_day')->nullable();
            $table->string('dues')->nullable();
            $table->string('dues_price')->nullable();
            $table->longText('content')->nullable();
            $table->string('rocker')->nullable();
            $table->string('mail_box')->nullable();
            $table->string('method')->nullable();
            $table->longText('supplement')->nullable();
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
        Schema::dropIfExists('group_informations');
    }
}
