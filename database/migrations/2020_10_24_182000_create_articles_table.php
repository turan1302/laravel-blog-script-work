<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id');
            $table->string('title');
            $table->string('image');
            $table->string('slug');
            $table->text('text');
            $table->integer('hit')->default(0);
            $table->integer('status')->default(0)->comment('0 ise pasif 1 ise aktif');
           // $table->foreign('category_id')->references('id')->on('categories'); // İLİŞKİ İÇİN BU LAZIM :)
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
        Schema::dropIfExists('articles');
    }
}
