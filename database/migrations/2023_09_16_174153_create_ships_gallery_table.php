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
        Schema::create('ships_gallery', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('ship_id')->nullable(false)->unsigned();
            $table->string('title')->nullable(false);
            $table->string('url',1000)->nullable(false);
            $table->integer('ordering')->nullable(false)->default(9999);

            $table->foreign('ship_id')->references('id')->on('ships')->onUpdate('cascade')->onDelete('cascade');

            $table->index(['ship_id'], 'ship_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ships_gallery');
    }
};
