<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameRequirementIdInPostInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_interest', function (Blueprint $table) {
            $table->renameColumn('requirement_id', 'post_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_interest', function (Blueprint $table) {
            $table->renameColumn('post_id', 'requirement_id');
        });
    }
}
