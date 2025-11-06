<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visitor_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reason_id')->constrained('visit_reasons')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('position_id')->constrained('positions')->onUpdate('cascade')->onDelete('cascade');
            $table->string('document_number')->unique();
            $table->dateTime('entry_time');
            $table->datetime('exit_time');
            $table->enum('status', ['abierta', 'completa', 'cerrada_automatica'])->default('abierta');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_entries');
    }
};
