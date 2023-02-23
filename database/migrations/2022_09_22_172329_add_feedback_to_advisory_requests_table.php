<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeedbackToAdvisoryRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advisory_requests', function (Blueprint $table) {
            $table->text('feedback')->nullable()->after('reason_for_reject');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advisory_requests', function (Blueprint $table) {
            $table->dropColumn('feedback');
        });
    }
}
