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
        Schema::table('pages', function (Blueprint $table) {
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->json('action_cards')->nullable();
            $table->boolean('show_hero_cards')->default(true);
            $table->boolean('show_contact_sidebar')->default(true);
            $table->string('content_layout')->default('two_column');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'hero_title',
                'hero_subtitle',
                'action_cards',
                'show_hero_cards',
                'show_contact_sidebar',
                'content_layout',
            ]);
        });
    }
};
