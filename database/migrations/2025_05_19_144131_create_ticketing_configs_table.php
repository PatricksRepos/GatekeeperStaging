<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketingConfigsTable extends Migration
{
  public function up()
  {
    Schema::create('ticketing_configs', function (Blueprint $table) {
      $table->id();
      $table->string('status');  // active or inactive
      $table->integer('max_tickets');  // Max tickets allowed
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('ticketing_configs');
  }
}
