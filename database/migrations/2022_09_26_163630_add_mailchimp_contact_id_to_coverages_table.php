<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMailchimpContactIdToCoveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('coverages', 'mailchimp_contact_id')) {
            Schema::table('coverages', function (Blueprint $table) {
                $table->text('mailchimp_contact_id')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coverages', function (Blueprint $table) {
            //
        });
    }
}
