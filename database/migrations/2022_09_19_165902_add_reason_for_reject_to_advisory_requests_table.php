<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReasonForRejectToAdvisoryRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advisory_requests', function (Blueprint $table) {
            $table->text('reason_for_reject')->nullable()->after('query_box');
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
            $table->dropColumn('reason_for_reject');
        });
    }
}
