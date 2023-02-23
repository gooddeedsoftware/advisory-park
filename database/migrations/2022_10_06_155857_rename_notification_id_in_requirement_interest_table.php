<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameNotificationIdInRequirementInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requirement_interest', function (Blueprint $table) {
            $table->renameColumn('notification_id', 'requirement_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requirement_interest', function (Blueprint $table) {
            $table->renameColumn('requirement_id', 'notification_id');
        });
    }
}
