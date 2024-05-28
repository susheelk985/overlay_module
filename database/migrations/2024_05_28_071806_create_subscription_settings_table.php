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
        Schema::create('subscription_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('targeting_rule')->default('homepage');
            $table->string('overlay_type')->default('modal'); // 'footer' or 'modal'
            $table->string('display_rule')->default('once_per_session'); // 'once_per_day' or 'once_per_session'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_settings');
    }
};
