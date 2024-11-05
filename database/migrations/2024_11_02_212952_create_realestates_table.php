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
        Schema::create('realestates', function (Blueprint $table) {
            $table->id();
            $table->string('building_type');
            $table->integer('bathrooms');
            $table->integer('furniture');
            $table->string('renovation');
            $table->string('garazh');
            $table->string('loghavazan');
            $table->string('sauna');
            $table->string('bughari');
            $table->string('ghorovati_vararan');
            $table->string('taghavar');
            $table->string('security');
            $table->string('odorakich');
            $table->string('sarnaran');
            $table->string('salojagh');
            $table->string('spasq_lvanalu_meqena');
            $table->string('washing_machine');
            $table->string('choracnogh_meqena');
            $table->string('electrakanutyun');
            $table->string('gaz');
            $table->string('water');
            $table->string('koyughi');
            $table->string('done');
            $table->integer('active')->default(1);
            $table->integer('block')->default(0);
            $table->integer('rooms');
            $table->integer('floor')->default(1);
            $table->integer('area');
            $table->string('price');
            $table->string('title');
            $table->string('currency');
            $table->string('region');
            $table->string('city');
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
        Schema::dropIfExists('realestates');
    }
};
