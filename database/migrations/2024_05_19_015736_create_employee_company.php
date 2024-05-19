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
        Schema::create('employee_company', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBiginteger('employee_id');
            $table->unsignedBiginteger('company_id');
            
            $table->foreign('employee_id')->references('id')
                 ->on('employees')->onDelete('cascade');
            $table->foreign('company_id')->references('id')
                ->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_company');
    }
};
