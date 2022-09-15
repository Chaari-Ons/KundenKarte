<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToProfilesTable extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\User::class)->constrained();

        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(\App\Models\User::class);
        });
    }
}
