<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('match_day_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('answer');
            $table->timestamps();
            $table->foreign('match_day_id')
                ->references('id')
                ->on('matches_day')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->unique(['match_day_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_responses');
    }
}
