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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            $table->integer('agent_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('property_status');
            $table->string('property_name');
            $table->string('property_slug');
            $table->string('max_price')->nullable();
            $table->string('min_price')->nullable();
            $table->text('short_descp')->nullable();
            $table->text('long_descp')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('room')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('property_size')->nullable();
            $table->string('garage')->nullable();
            $table->string('garage_size')->nullable();
            $table->integer('type_id')->nullable();
            $table->string('property_code')->nullable();
            $table->string('amenitie_id')->nullable();
            $table->string('address')->nullable();
            $table->string('state_id')->nullable();
            $table->string('country')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('property_video')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default(0);
            $table->string('featured')->nullable();
            $table->string('hot')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
