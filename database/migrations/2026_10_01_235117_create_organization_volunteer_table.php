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
        Schema::create('organization_volunteer', function (Blueprint $table) {
            $table->id();
            // cascadeOnDelete: al borrar una organización o un voluntario se borran sus vínculos
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('volunteer_id')->constrained()->cascadeOnDelete();
            $table->date('join_date');
            $table->string('role');
            $table->foreignId('registered_by')->constrained('users');
            $table->timestamps();

            // un voluntario solo puede estar una vez en cada organización
            $table->unique(['organization_id', 'volunteer_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_volunteer');
    }
};
