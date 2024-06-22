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
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique('name');
            $table->timestamps();
            $table->softDeletes();
        });
       
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique('code');
            $table->string('name')->unique('name');
            $table->string('status',1);
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('country_states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country')->constrained();
            $table->string('code_international')->unique('code_international');
            $table->string('code_national')->unique('code_national');
            $table->string('name')->unique('name');
            $table->string('status',1);
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('country_cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_state')->constrained();
            $table->string('code_international')->unique('code_international');
            $table->string('code_national')->unique('code_national');
            $table->string('name')->unique('name');
            $table->string('cep')->unique('cep');
            $table->string('ibge')->nullable()->unique('ibge');
            $table->string('status',1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('country_states');
        Schema::dropIfExists('country_cities');
    }
};
