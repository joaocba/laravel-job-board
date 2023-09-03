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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();

            $table->string('company_name');
            $table->foreignIdFor(\App\Models\User::class)
                ->nullable()->constrained(); // This will create a user_id column in the employers table and it can be nullable

            $table->timestamps();
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Employer::class)->constrained(); // This will create a employer_id column in the jobs table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This will drop the foreign key constraint on the jobs table
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Employer::class);
        });

        // This will drop the employers table
        Schema::dropIfExists('employers');
    }
};
