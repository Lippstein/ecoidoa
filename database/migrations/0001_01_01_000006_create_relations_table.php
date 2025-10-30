<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('id_term_bt');
            $table->unsignedBigInteger('id_term_nt');
            $table->unsignedBigInteger('id_niche');
            $table->unsignedBigInteger('id_user');

            // Constraints
            $table->foreign('id_term_bt')
                ->references('id')->on('terms')
                ->onDelete('restrict');

            $table->foreign('id_term_nt')
                ->references('id')->on('terms')
                ->onDelete('restrict');

            $table->foreign('id_niche')
                ->references('id')->on('niches')
                ->onDelete('restrict');

            $table->foreign('id_user')
                ->references('id')->on('users')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relations');
    }
}