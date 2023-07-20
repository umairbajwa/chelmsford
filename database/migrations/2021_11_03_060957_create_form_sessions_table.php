<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_sessions', function (Blueprint $table) {
            $table->id();
            $table->text('session_id')->nullable();
            $table->text('form_data')->nullable();
            $table->string('email')->nullable();
            $table->string('post_code')->nullable();
            $table->boolean('mail_sent')->default(false);
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
        Schema::dropIfExists('form_sessions');
    }
}
