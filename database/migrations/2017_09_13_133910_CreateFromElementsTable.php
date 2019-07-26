<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFromElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formbuilder_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('formbuilder_form_id');
            $table->boolean('active')->default(0);
            $table->integer('order')->nullable();
            $table->boolean('required')->default(0);
            $table->string('name');
            $table->string('placeholder')->nullable();
            $table->text('help_block')->nullable();
            $table->string('type');
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
        Schema::dropIfExists('formbuilder_elements');
    }
}
