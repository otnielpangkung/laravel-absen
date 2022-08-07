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
        // Type Absen
        Schema::table('type_absens', function(Blueprint $table) {
            $table->foreign('branch_id')
            ->referenecs('id')->on('branches');
        });

        // Absen
        Schema::table('absens', function(Blueprint $table) {
            $table->foreign('branch_id')
            ->referenecs('id')->on('branches');

            $table->foreign('employee_id')
            ->referenecs('id')->on('employees');

            $table->foreign('type_absen_id')
            ->referenecs('id')->on('type_absens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('type_absens' ,function(Blueprint $table) {
            $table->dropForeign(['branch_id']);
        });
        Schema::table('absens' ,function(Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['employee_id']);
            $table->dropForeign(['type_absen_id']);
        });
    }
};
