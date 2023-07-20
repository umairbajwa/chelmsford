<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coverages', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('name');
            $table->text('surname');
            $table->string('post_code')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('town')->nullable();
            $table->string('county')->nullable();
            $table->string('phone_number');
            $table->string('email');
            $table->string('referred_by')->nullable();
            $table->string('plan')->nullable();
            $table->string('billing_request_id')->nullable();
            $table->string('status')->default('Draft');
            $table->string('redirect_url')->nullable();
            $table->text('session_token')->nullable();
            $table->text('mandate_id')->nullable();
            $table->text('subscription_id')->nullable();
            $table->boolean('marketing')->default(false);
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
        Schema::dropIfExists('coverages');
    }
}
