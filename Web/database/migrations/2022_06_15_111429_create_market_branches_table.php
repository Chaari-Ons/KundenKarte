<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketBranchesTable extends Migration
{
    public function up()
    {
        Schema::create('market_branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('longitude');
            $table->string('latitude');
            $table->foreignId('address_id')->constrained();
            $table->foreignId('market_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('market_branches');
    }
}
