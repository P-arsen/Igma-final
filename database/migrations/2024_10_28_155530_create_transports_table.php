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
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->integer('region_id');
            $table->integer('city_id');
            $table->integer('brand_id')->nullable();
            $table->integer('model_id')->nullable();
            $table->integer('body_type_id')->nullable();
            $table->integer('year')->nullable();
            $table->integer('engine_type_id')->nullable();
            $table->string('engine_size')->nullable();
            $table->string('transmission')->nullable();
            $table->string('drive_type')->nullable();
            $table->integer('destination')->nullable();
            $table->string('mils')->default('km');
            $table->string('damaged')->nullable();
            $table->integer('gas')->default(0);
            $table->string('steering')->nullable();
            $table->integer('cleared')->nullable();
            $table->integer('color_id')->nullable();
            $table->string('wheel')->nullable();
            $table->string('headlights');
            $table->string('interior_color')->nullable();
            $table->integer('interior_material_id')->nullable();
            $table->string('sunroof')->nullable();
            $table->integer('air_conditioner')->nullable();
            $table->integer('heated_seats')->nullable();
            $table->integer('heated_steering_wheel')->nullable();
            $table->integer('ventilated_seats')->nullable();
            $table->integer('cruise_control')->nullable();
            $table->integer('tinted_windows')->nullable();
            $table->string('price')->nullable();
            $table->string('currency')->default('amd');
            $table->text('description');
            $table->string('name')->nullable();
            $table->integer('active')->default(1);
            $table->integer('block')->default(0);
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transports');
    }
};
