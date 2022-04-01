<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->cascadeOnDelete();
                
            $table->foreignId('file_id')
                    ->constrained('files')
                    ->cascadeOnDelete();

            $table->boolean('is_valid');
            $table->string('url')->primary();
            $table->boolean('is_reusable');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urls');
    }
}
