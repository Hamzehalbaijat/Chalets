<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chalets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->decimal('price_per_day', 10, 2);
            $table->string('address');
            $table->text('description');
            $table->decimal('discount', 5, 2)->nullable();
            $table->enum('status', ['available', 'not available']);
            $table->integer('bedrooms')->default(1);
            $table->integer('bathrooms')->default(1);
            $table->boolean('wifi')->default(false);
            $table->boolean('pool')->default(false);
            $table->integer('air_conditioners')->default(0);
            $table->integer('parking_spaces')->default(0);
            $table->integer('area')->nullable();
            $table->boolean('barbecue')->default(false);
            $table->enum('view', ['sea', 'mountain', 'city', 'none'])->default('none');
            $table->boolean('kitchen')->default(false);
            $table->boolean('kids_play_area')->default(false);
            $table->boolean('pets_allowed')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chalets');
    }
};