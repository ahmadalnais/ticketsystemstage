<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->string('url');
            $table->string('device');
            $table->string('type')->nullable();
            $table->string('device_name')->nullable();
            $table->string('status')->nullable();
            $table->unsignedInteger('project_id');
            $table->text('browser');
            $table->String('version_number')->nullable();
            $table->string('attachment')->nullable();
            $table->string('attachment_name')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
