<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('task_category_id')->nullable()->change();
            $table->foreign('task_category_id')->references('id')->on('task_categories')->nullOnDelete();
            $table->unsignedBigInteger('task_status_id')->nullable()->change();
            $table->foreign('task_status_id')->references('id')->on('task_statuses')->nullOnDelete();
            $table->foreign('requirement_id')->references('id')->on('requirements')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['task_category_id']);
            $table->unsignedBigInteger('task_category_id')->nullable(false)->change();
            $table->dropForeign(['task_status_id']);
            $table->unsignedBigInteger('task_status_id')->nullable(false)->change();
            $table->dropForeign(['requirement_id']);
        });
    }
};
