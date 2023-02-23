<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequirementInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirement_interest', function (Blueprint $table) {
            $table->id();
            $table->string('notification_id');
            $table->string('entity_id');
            $table->boolean('status')->default(0)->comment("0 => 'pending', 1 => 'interested', 2 =>'not interested'");
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
        Schema::dropIfExists('requirement_interest');
    }
}
