<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationTopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications_top', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('list_id')->default(0);
            $table->unsignedInteger('publication_id')->default(0);
            $table->unsignedInteger('position')->default(0)->index();
            $table->string('note');
            $table->unique(['list_id', 'publication_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications_top');
    }
}
