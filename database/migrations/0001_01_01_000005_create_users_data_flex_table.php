<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users_data_flex', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('no action')->onDelete('no action');
            $table->foreignId('habitat_id')->constrained('habitats')->onUpdate('no action')->onDelete('no action');
            $table->foreignId('niche_id')->constrained('niches')->onUpdate('no action')->onDelete('no action');
            $table->integer('niche_level')->default(0);
            $table->json('user_profile')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_data_flex');
    }
};
