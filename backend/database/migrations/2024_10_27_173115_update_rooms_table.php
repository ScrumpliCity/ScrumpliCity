<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->integer('build_phase_duration')->nullable();
            $table->integer('planning_duration')->nullable();
            $table->integer('review_duration')->nullable();
        });

        // Optional: Set default values for existing rows
        DB::table('rooms')->update([
            'build_phase_duration' => 1,
            'planning_duration' => 1,
            'review_duration' => 1,
        ]);

        // Make the columns NOT NULL after setting default values
        Schema::table('rooms', function (Blueprint $table) {
            $table->integer('build_phase_duration')->nullable(false)->change();
            $table->integer('planning_duration')->nullable(false)->change();
            $table->integer('review_duration')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('build_phase_duration');
            $table->dropColumn('planning_duration');
            $table->dropColumn('review_duration');
        });
    }
};
