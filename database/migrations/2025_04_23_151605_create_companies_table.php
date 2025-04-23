<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
        // Check if the 'companies' table exists first
        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id'); // foreign key to users
                $table->string('company_name');
                $table->text('description');
                $table->string('website')->nullable();
                $table->string('contact_number')->nullable();
                $table->timestamps();

                // Foreign key constraint
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        } else {
            // If the table already exists, add missing columns
            Schema::table('companies', function (Blueprint $table) {
                if (!Schema::hasColumn('companies', 'company_name')) {
                    $table->string('company_name');
                }
                if (!Schema::hasColumn('companies', 'description')) {
                    $table->text('description');
                }
                if (!Schema::hasColumn('companies', 'website')) {
                    $table->string('website')->nullable();
                }
                if (!Schema::hasColumn('companies', 'contact_number')) {
                    $table->string('contact_number')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
