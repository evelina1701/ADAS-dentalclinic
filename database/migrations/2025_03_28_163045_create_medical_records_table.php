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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id(); // record id
            // Foreign key for patient
            $table->unsignedBigInteger('patient_id');
            // Specialist (dentist) who created the record (from users table)
            $table->unsignedBigInteger('specialist_id');
            // Record date (when the record is made)
            $table->date('record_date');
            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();


            $table->foreign('patient_id')
                  ->references('patient_id')->on('patients')
                  ->onDelete('restrict'); // Prevent deletion of patient if records exist
                  
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
        Schema::dropIfExists('medical_records');
    }
};
