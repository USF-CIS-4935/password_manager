<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsernameColumnPasswordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('passwords', function (Blueprint $table) {
          $table->string('username_email')->after('password_name');
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
        $table->dropColumn('username_email');
      });
    }
}
