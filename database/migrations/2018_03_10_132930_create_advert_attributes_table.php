<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('advert_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->references('id')->on('advert_categories')->onDelete('CASCADE');
            $table->string('name_am');
            $table->string('name_ru');
            $table->string('name_en');
            $table->string('type');
            $table->boolean('required');
            $table->json('variants');
            $table->integer('sort');
        });
    }

    public function down()
    {
        Schema::dropIfExists('advert_attributes');
    }
}
