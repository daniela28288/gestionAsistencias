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
        Schema::connection('db_programacion')->create('people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_position')->constrained('positions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_town')->nullable()->constrained('towns')->onUpdate('cascade')->onDelete('cascade');
            $table->string('document_number')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('phone_number');
            //CAMPOS DE FECHA DE INICIO Y FIN
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
