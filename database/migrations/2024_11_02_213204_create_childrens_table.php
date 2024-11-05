<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('childrens', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->string('city');
            $table->string('title');
            $table->text('description');
            $table->string('price');
            $table->string('type');
            $table->string('currency');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('special_offer')->default(0);
            $table->integer('top')->default(0);
            $table->integer('urgent')->default(0);
            $table->integer('buy_me')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('childrens');
    }
};
