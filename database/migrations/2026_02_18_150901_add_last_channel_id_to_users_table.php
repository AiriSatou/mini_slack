<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastChannelIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->foreignId('last_channel_id')
              ->nullable() 
              ->constrained('channels')
              ->nullOnDelete(); 
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {

        
        $table->dropForeign(['last_channel_id']); //外部キー制約を削除
        $table->dropColumn('last_channel_id');
    });
}
}
