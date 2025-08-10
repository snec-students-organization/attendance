<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusEnumInAttendancesTable extends Migration
{
    public function up()
    {
        // For MySQL you might need raw query to modify enum
        // or use doctrine/dbal package to support enum modifications via schema builder.
        Schema::table('attendances', function (Blueprint $table) {
            // You must first install doctrine/dbal:
            // composer require doctrine/dbal
            $table->enum('status', ['present', 'absent', 'free'])->default('present')->change();
        });
    }

    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->enum('status', ['present', 'absent'])->default('present')->change();
        });
    }
}

