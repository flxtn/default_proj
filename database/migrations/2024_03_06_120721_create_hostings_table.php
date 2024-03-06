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
        Schema::create('hostings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullabe();
            $table->string('login')->nullabe();
            $table->string('password')->nullabe();
            $table->string('tariff')->nullabe();
            $table->integer('linked_sites')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hostings');
    }
};
