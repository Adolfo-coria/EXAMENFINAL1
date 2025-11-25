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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'ci')) {
                $table->string('ci')->nullable()->unique()->after('name');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->unique()->after('ci');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('patient')->after('phone');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
            if (Schema::hasColumn('users', 'phone')) {
                $table->dropUnique(['phone']);
                $table->dropColumn('phone');
            }
            if (Schema::hasColumn('users', 'ci')) {
                $table->dropUnique(['ci']);
                $table->dropColumn('ci');
            }
        });
    }
};
