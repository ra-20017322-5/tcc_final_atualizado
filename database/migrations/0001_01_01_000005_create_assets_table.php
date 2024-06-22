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
        Schema::create('asset_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->comment('Usuario que cadastrou');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name')->unique('name');
            $table->string('status',1);
        });
        
        Schema::create('asset_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->comment('Usuario que cadastrou');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name')->unique('name');
            $table->string('status',1);
        });
        
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->comment('Usuario que cadastrou');
            $table->timestamps();
            $table->integer('deleted_id')->comment('Usuario que excluiu');
            $table->softDeletes();
            $table->date('available_at')->nullable()->comment('Data de disponibilidade do item');
            $table->foreignId('asset_categorie')->constrained();
            $table->foreignId('asset_type')->constrained();
            $table->foreignId('reference_id')->index();
            $table->string('uuid')->unique();
            $table->string('name');
            $table->string('serial_number')->nullable();
            $table->string('tag')->nullable();
            $table->string('patrimonial_id')->nullable();
            $table->text('observation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_types');
        Schema::dropIfExists('asset_categories');
        Schema::dropIfExists('assets');
    }
};
