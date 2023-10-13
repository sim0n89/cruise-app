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
        Schema::create('cabin_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('ship_id')->nullable(false)->unsigned();
            $table->string('vendor_code')->nullable(false);
            $table->string('title')->nullable(false);
            $table->enum('type', ['Inside','Ocean view','Balcony','Suite'])->nullable();
            $table->text('description')->nullable(false);
            $table->json('photos')->nullable();
            $table->integer('ordering')->nullable(false)->default(9999);
            $table->boolean('state')->default(0);

            $table->foreign('ship_id')->references('id')->on('ships')->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['ship_id', 'vendor_code'], 'ship_id');
            $table->index(['ship_id'], 'ship_id_2');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabin_categories');
    }
};
