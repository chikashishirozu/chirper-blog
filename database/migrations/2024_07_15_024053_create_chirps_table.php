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
        Schema::table('chirps', function (Blueprint $table) {
            $table->string('title')->after('id'); // Adds a title column
            $table->text('message')->change(); // Changes message column type to text for unlimited length
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chirps', function (Blueprint $table) {
            $table->dropColumn('title'); // Removes the title column
            $table->string('message', 255)->change(); // Reverts message column back to string with a limit
        });
    }
};

