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
        Schema::create('upload_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique('name');
            $table->string('status',1);
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->comment('Usuario que cadastrou');
            $table->timestamps();
            $table->foreignId('upload_type')->constrained();
            $table->foreignId('reference_id')->index();
            $table->string('uuid')->unique();
            $table->string('file_size',10);
            $table->string('file_name');
            $table->string('file_name_uploaded');
            $table->text('observation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_types');
        Schema::dropIfExists('uploads');
    }
};
