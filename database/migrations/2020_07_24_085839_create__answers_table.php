<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            //foreign key liink answers to questions
            $table->bigInteger('question_id')->unsigned();
            //content column
            $table->text('content');
            $table->timestamps();
            //establish foreign key relationship
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //delete any foreign key index
        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeign(['answers_question_id_foreign']);
            $table->column('question_id');
        });
        Schema::dropIfExists('answers');
    }
}
