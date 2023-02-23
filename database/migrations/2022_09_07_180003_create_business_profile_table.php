<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('org_name');
            $table->string('org_address_line_1')->nullable();
            $table->string('org_address_line_2')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('org_type')->nullable();
            $table->text('about_org')->nullable();
            $table->string('org_images')->nullable();
            $table->string('iso_cert')->nullable();
            $table->text('desc_iso_cert')->nullable();
            $table->string('achievement')->nullable();
            $table->text('desc_achievement')->nullable();
            $table->string('trademark')->nullable();
            $table->text('desc_trademark')->nullable();
            $table->string('business_sector')->nullable();
            $table->string('nature_of_business')->nullable();
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
        Schema::dropIfExists('business_profile');
    }
}
