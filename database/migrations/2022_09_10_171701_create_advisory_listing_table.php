<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvisoryListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advisory_listing', function (Blueprint $table) {
            $table->increments('id');
            $table->string('listing_name');
            $table->string('slug');
            $table->string('type')->nullable();
            $table->string('category')->nullable();
            $table->string('duration_in_hours')->nullable();
            $table->string('duration_in_minutes')->nullable();
            $table->string('fees')->nullable();
            $table->text('image')->nullable();
            $table->text('about_listing')->nullable();
            $table->text('experience')->nullable();
            $table->string('mode')->nullable();
            $table->string('exp_in_years')->nullable();
            $table->string('exp_in_months')->nullable();
            $table->string('added_by');
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
        Schema::dropIfExists('advisory_listing');
    }
}
