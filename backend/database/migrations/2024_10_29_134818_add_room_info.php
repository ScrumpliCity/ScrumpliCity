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
        Schema::table('rooms', function (Blueprint $table) {
            $table->integer('current_sprint')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->boolean('is_playing')->default(false);
            $table->timestamp('last_play_start')->nullable();
            $table->timestamp('last_play_end')->nullable();
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->timestamps();
            $table->foreignUlid('room_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('current_sprint');
            $table->dropColumn('completed_at');
            $table->dropColumn('is_playing');
            $table->dropColumn('last_play_start');
            $table->dropColumn('last_play_end');
        });

        Schema::dropIfExists('teams');
    }
};
