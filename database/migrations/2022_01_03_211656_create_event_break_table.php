<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventBreakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_break', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_5569083')->references('id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('cawader_id');
            $table->foreign('cawader_id', 'cawader_id_fk_5226083')->references('id')->on('cawaders')->onDelete('cascade'); 
            $table->string('break');
            $table->text('reason')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('event_break');
    }
}
