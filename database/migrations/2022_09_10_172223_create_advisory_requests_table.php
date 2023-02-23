<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvisoryRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advisory_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('category')->nullable();
            $table->integer('user_id');
            $table->integer('advisor_id');
            $table->string('listing_name')->nullable();
            $table->string('state_name')->nullable();
            $table->string('city_name')->nullable();
            $table->text('image')->nullable();
            $table->text('description')->nullable();
            $table->enum('status',['1', '2', '3','4','5','6'])->default('1')->comment("1=>'Pending',2=>'Accepted',3=>'Rejected',4=>'Payment Done',5=>'Satisfied',6=>'Dissatisfied'");
            $table->string('req_type')->nullable();
            $table->tinyInteger('satisfied')->nullable();
            $table->text('comment')->nullable();
            $table->float('comm')->nullable();
            $table->string('fees')->nullable();
            $table->integer('query_box')->nullable();
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
        Schema::dropIfExists('advisory_requests');
    }
}
