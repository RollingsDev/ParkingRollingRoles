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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->char('code');
            $table->foreignId('vacancy_id')->nullable()->constrained('vacancies', 'id');
            $table->foreignId('payment_id')->nullable()->constrained('payments', 'id');
            $table->char('price')->nullable();
            $table->char('time')->nullable();
            $table->timestamp('arrival_date')->nullable(); // Coluna arrival_date
            $table->char('departure_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
