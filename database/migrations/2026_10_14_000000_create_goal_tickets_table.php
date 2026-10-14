<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goal_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('league', 100);
            $table->string('short', 10);
            $table->string('home', 100);
            $table->string('away', 100);
            $table->string('home_short', 10);
            $table->string('away_short', 10);
            $table->char('home_color', 7);
            $table->char('away_color', 7);
            $table->dateTime('match_at');
            $table->string('stadium', 150);
            $table->decimal('price', 10, 2);
            $table->string('status', 20)->default('AVAILABLE');
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goal_tickets');
    }
};
