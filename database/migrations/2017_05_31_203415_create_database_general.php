<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabaseGeneral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            /* Foreign key Users */
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
      });

      Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            /* Foreign key Categories */
            $table->integer('categoryId')->unsigned();
            $table->foreign('categoryId')
                ->references('id')->on('Categories')
                ->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->string('type')->nullable();
            $table->string('keywords')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
      });

      Schema::create('audios', function (Blueprint $table) {
            $table->increments('id');
            /* Foreign key Categories */
            $table->integer('categoryId')->unsigned();
            $table->foreign('categoryId')
                ->references('id')->on('Categories')
                ->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->string('type')->nullable();
            $table->string('keywords')->nullable();
            $table->text('description')->nullable();
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
        //
    }
}
