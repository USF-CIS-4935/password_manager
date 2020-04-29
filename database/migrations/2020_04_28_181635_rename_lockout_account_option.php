<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameLockoutAccountOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('account_options', function (Blueprint $table) {
          $table->renameColumn('failure_lockout_timer', 'track_login_history');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('account_options', function (Blueprint $table) {
          $table->renameColumn('track_login_history', 'failure_lockout_timer');
      });
    }
}
