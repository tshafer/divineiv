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
        Schema::table('reviews', function (Blueprint $table) {
            $table->string('external_id')->nullable()->after('id');
            $table->string('author_avatar_url')->nullable()->after('author_name');
            $table->timestamp('review_date')->nullable()->after('rating');
            $table->string('external_review_url')->nullable()->after('source_url');
            $table->json('additional_data')->nullable()->after('active');
            $table->timestamp('external_sync_at')->nullable();

            // Add indexes for better performance
            $table->index(['source', 'external_id']);
            $table->index('review_date');
            $table->index('external_sync_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex(['source', 'external_id']);
            $table->dropIndex(['review_date']);
            $table->dropIndex(['external_sync_at']);

            $table->dropColumn([
                'external_id',
                'author_avatar_url',
                'review_date',
                'external_review_url',
                'additional_data',
                'external_sync_at',
            ]);
        });
    }
};
