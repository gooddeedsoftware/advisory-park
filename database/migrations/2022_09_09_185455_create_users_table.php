<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('name');
            $table->string('advisory_park_id');
            $table->string('desingation');
            $table->string('email')->unique();
            $table->string('gender');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('plain_password');
            $table->rememberToken();
            $table->string('image');
            $table->string('cover_image');
            $table->string('contact');
            $table->string('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('pincode');
            $table->string('work_status');
            $table->string('language_known');
            $table->longtext('overview');
            $table->text('qualifications');
            $table->text('about_us');
            $table->text('education');
            $table->text('experience');
            $table->string('google_id');
            $table->string('is_active');
            $table->string('is_email_verified');
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
        Schema::dropIfExists('users');
    }
};
