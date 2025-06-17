<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('medical_type')->after('id')->nullable();
            $table->string('location_type')->after('answer')->nullable();
            $table->boolean('is_active')->after('location_type')->default(true);
        });
    }

    public function down()
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['medical_type', 'location_type', 'is_active']);
        });
    }
}; 