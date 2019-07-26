<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFromsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formbuilder_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->boolean('active')->default(0);
            $table->text('emails')->nullable();
            $table->text('success_message')->nullable();
            $table->text('redirect_url')->nullable();
            $table->boolean('confirm_email')->default(0);
            $table->boolean('send_email')->default(0);
            $table->boolean('save_data')->default(0);
            $table->boolean('recaptcha')->default(0);
            $table->text('recaptcha_private_key')->nullable();
            $table->text('recaptcha_public_key')->nullable();
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
        Schema::dropIfExists('formbuilder_forms');
    }
}
