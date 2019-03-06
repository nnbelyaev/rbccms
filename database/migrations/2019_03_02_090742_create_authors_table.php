<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('office', ['daily','dailyoutside','styler','styleoutside']);
            $table->string('image')->default('');
            $table->timestamps();
        });

        Schema::create('author_names', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author_id');
            $table->char('locale', 2)->index();
            $table->string('name', 255)->default('');
            $table->string('regalia', 255)->default('');
            $table->text('dossie', 255);
            $table->unique(['author_id','locale']);
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        });

        Schema::create('authors_top', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('office', ['daily','styler']);
            $table->unsignedInteger('author_id')->default(0);
            $table->unsignedInteger('position')->default(0)->index();
            $table->unique(['office', 'author_id']);
        });
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors_top');
        Schema::dropIfExists('author_names');
        Schema::dropIfExists('authors');
    }
}
