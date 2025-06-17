<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('medicals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // hospital, clinic, pharmacy, dll
            $table->text('address');
            $table->string('phone')->nullable();
            $table->string('location'); // kecamatan/kelurahan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicals');
    }
}; 