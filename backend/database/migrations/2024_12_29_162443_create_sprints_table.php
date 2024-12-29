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
        Schema::create('sprints', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->timestamps();
            $table->string('name')->default('');
            $table->string('goal')->default('');
            $table->unsignedSmallInteger('sprint_number');
            $table->float('velocity')->comment('Velocity of the sprints before this one, null if this is the first sprint.')->nullable();
            $table->foreignUlid('team_id')->constrained()->onDelete('cascade');

            $table->unique(['team_id', 'sprint_number']);
        });

        Schema::create('user_stories', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->timestamps();
            $table->string('title')->default('');
            $table->string('description')->default('');
            $table->foreignUlid('member_id')->nullable()->constrained()->onDelete('set null');
            $table->unsignedSmallInteger('story_points')->nullable();
            $table->boolean('completed')->default(false);
            $table->foreignUlid('sprint_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_stories');
        Schema::dropIfExists('sprints');
    }
};
