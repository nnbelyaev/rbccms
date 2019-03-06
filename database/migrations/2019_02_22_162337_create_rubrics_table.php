<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRubricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubrics', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['normal', 'inactive', 'deleted'])->default('normal');
            $table->enum('category', ['news', 'styler', 'afisha', 'lite', 'all'])->default('news');
            $table->string('slug', 196)->unique();
            $table->string('google_news', 255)->default('');
            $table->enum('banner_zone', ['other', 'business'])->default('other');
            $table->boolean('subdomain')->default(false);
            $table->unsignedInteger('order')->default(100);
            $table->timestamps();
        });

        Schema::create('rubric_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rubric_id');
            $table->char('locale', 2)->index();
            $table->string('name', 255)->default('');
            $table->string('h1', 255)->default('');
            $table->string('title', 255)->default('');
            $table->string('keywords', 255)->default('');
            $table->string('description', 255)->default('');
            $table->unique(['rubric_id','locale']);
            $table->foreign('rubric_id')->references('id')->on('rubrics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rubric_translations');
        Schema::dropIfExists('rubrics');
    }
}
