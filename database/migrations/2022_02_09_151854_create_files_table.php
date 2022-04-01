<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->enum('status',['private','public','accessible']);
            $table->string('file_name', 70);
            $table->text('description')->nullable();

            $table->foreignId('user_id')
                    ->constrained('users')
                    ->cascadeOnDelete();
            
                    
            $table->unsignedInteger('number_of_downloads')->default(0);
            $table->unsignedInteger('number_of_people')->default(0);

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
        Schema::dropIfExists('files');
    }
}
