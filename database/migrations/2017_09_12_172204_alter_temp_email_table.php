<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTempEmailTable extends Migration
{
    public function up()
    {
        Schema::table('temp_emails', function (Blueprint $table) {
            $table->integer('member_id');
            $table->string('code',60);
            $table->timestamp('deadline')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_emails');
    }
}
