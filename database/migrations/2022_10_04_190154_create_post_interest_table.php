<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_interest', function (Blueprint $table) {
            $table->id();
            $table->string('notification_id');
            $table->string('entity_id');
            $table->boolean('status')->default(0)->comment("0 => 'not interested', 1 =>'interested'");
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
        Schema::dropIfExists('post_interest');
    }
}
