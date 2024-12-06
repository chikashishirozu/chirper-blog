<?php   use Illuminate\Database\Migrations\Migration;
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
        if (!Schema::hasColumn('chirps', 'created_at')) {
            $table->timestamps(); // Add created_at and updated_at columns
        } else {
            if (!Schema::hasColumn('chirps', 'updated_at')) {
                $table->timestamp('updated_at')->nullable(); // Add only updated_at column
            }
        }
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chirps', function (Blueprint $table) {
            if (Schema::hasColumn('chirps', 'created_at') && Schema::hasColumn('chirps', 'updated_at')) {
                $table->dropTimestamps(); // Remove created_at and updated_at columns
            } else if (Schema::hasColumn('chirps', 'updated_at')) {
                $table->dropColumn('updated_at'); // Remove only updated_at column
            }
        });
    }
};




