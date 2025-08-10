<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('attendances', function ($table) {
        $table->string('reason')->nullable()->after('status');
    });
}

public function down()
{
    Schema::table('attendances', function ($table) {
        $table->dropColumn('reason');
    });
}

};
