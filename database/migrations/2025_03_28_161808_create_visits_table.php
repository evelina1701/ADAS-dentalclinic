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
        Schema::create('visits', function (Blueprint $table) {
            $table->id(); // visits id
            // Foreign key for patient
            $table->unsignedBigInteger('patient_id');
            // Foreign key for specialist (from users table)
            $table->unsignedBigInteger('specialist_id');
            // Date and time of the visit
            $table->dateTime('visit_date_time');
            // Optional notes field
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('patient_id')
                  ->references('patient_id')->on('patients')
                  ->onDelete('cascade'); 
            
            $table->foreign('specialist_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
