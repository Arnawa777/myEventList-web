<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->nullable()->constrained('locations')->onDelete('restrict')->onUpdate('cascade');
            // Jika category yang dipilih ingin dihapus tidak diperbolehkan
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict')->onUpdate('cascade');
            $table->string('name', 100);
            $table->string('slug', 125)->unique();
            $table->text('synopsis')->nullable();
            $table->string('phone', 20)->nullable();
            $table->dateTime('date')->nullable();
            $table->string('picture')->nullable()->default('default.jpg');
            $table->string('video')->nullable();
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
        Schema::dropIfExists('events');
    }
};
