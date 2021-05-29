<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Stmt\Enum_;

class TasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->enum('task_type', ['invoice_ops', 'custom_ops','common_ops'])->default('custom_ops');
            $table->string('prerequisites')->default('none');
            $table->string('amount')->nullable();
            $table->string('country')->nullable();
            $table->enum('task_status', ['Not Progress', 'Progress','Finished'])->nullable()->default('Not Progress');
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
        Schema::dropIfExists('tasks');
    }
}
