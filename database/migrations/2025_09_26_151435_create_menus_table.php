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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->string('type')->default('internal'); // internal, external, route
            $table->string('target')->nullable(); // _blank, _self
            $table->string('icon')->nullable(); // FontAwesome icon class
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_published')->default(true);
            $table->string('css_classes')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('level')->default(0); // 0 for top level, 1 for submenu, etc.
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
            $table->index(['is_active', 'is_published', 'level', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
