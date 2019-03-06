<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['news','analytics','interview','opinion','gallery','video','digests','anons','curious','card','test','poll','afisha'])->default('news')->index();
            $table->enum('office', ['news','daily','styler','lite'])->default('news')->index();
            $table->enum('status', ['normal', 'inactive','deleted'])->default('normal')->index();
            $table->dateTimeTz('dtpub')->index();
            $table->dateTimeTz('dtend')->nullable();
            $table->unsignedInteger('rubric_id')->default(0)->index();
            $table->unsignedInteger('region_id')->default(0);
            $table->unsignedInteger('story_id')->default(0)->index();
            $table->unsignedInteger('ukrnet_id')->default(0);
            $table->string('slug', 194)->unique();
            $table->boolean('bold')->default(false);
            $table->unsignedInteger('color')->default(0);
            $table->boolean('exclusive')->default(false);
            $table->boolean('has_photo')->default(false);
            $table->boolean('has_video')->default(false);
            $table->boolean('maindomain')->default(false);
            $table->boolean('webpush')->default(false);
            $table->boolean('webpush_sended')->default(false);
            $table->string('image')->default('');
            $table->json('extra')->nullable();
            $table->json('tags')->nullable();
            $table->json('readalso')->nullable();
            $table->json('authors')->nullable();
            $table->unsignedInteger('editor_id');
            $table->unsignedInteger('corrector_id');
            $table->unsignedInteger('locked')->default(0);
            $table->timestamps();

            $table->index(['status', 'dtpub']);
            $table->index(['webpush', 'webpush_sended']);
        });

        Schema::create('publication_letters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('publication_id');
            $table->char('locale', 2)->index();
            $table->string('prefix', 255)->default('');
            $table->string('heading', 255)->default('');
            $table->string('lead', 4000)->default('');
            $table->string('imagealt', 255)->default('');
            $table->text('text');
            $table->string('title')->default('');
            $table->json('title_extra');
            $table->string('keywords')->default('');
            $table->string('description')->default('');

            $table->unique(['publication_id','locale']);
            $table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publication_letters');
        Schema::dropIfExists('publications');
    }
}
