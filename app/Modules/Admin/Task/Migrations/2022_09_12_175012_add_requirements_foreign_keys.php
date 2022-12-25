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
        Schema::table('requirements', function (Blueprint $table) {
            $table->unsignedBigInteger('requirement_status_id')->nullable()->change();
            $table->foreign('requirement_status_id')->references('id')->on('requirement_statuses')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requirements', function (Blueprint $table) {
            $table->dropForeign(['requirement_status_id']);
            $table->unsignedBigInteger('requirement_status_id')->nullable(false)->change();
        });
    }
};
