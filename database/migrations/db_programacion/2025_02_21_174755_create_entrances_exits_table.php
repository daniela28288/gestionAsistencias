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
        Schema::connection('db_programacion')->create('entrances_exits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_person')->constrained('people')->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('date_time');
            $table->enum('action',['entrada','salida'])->default('entrada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrances_exits');
    }
};
