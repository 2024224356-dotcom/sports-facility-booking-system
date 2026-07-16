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
       Schema::create('facilities', function (Blueprint $table) {

    $table->id();

    $table->foreignId('facility_type_id')
          ->constrained('facility_types')
          ->onDelete('cascade');

    $table->string('facility_name');

    $table->enum('availability_status', [
        'available',
        'maintenance'
    ])->default('available');

    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
