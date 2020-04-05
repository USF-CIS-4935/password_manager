<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PasswordNotesNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('passwords', function (Blueprint $table) {
        $table->string('notes')->nullable()->change();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('passwords', function (Blueprint $table) {
        $table->string('notes')->nullable(false)->change();
      });
    }
}
