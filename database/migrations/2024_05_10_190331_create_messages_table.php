<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. (if hasTable new line)
     */
    public function up(): void
    {
       // if(!Schema::hasTable('messages')){

            Schema::create('messages', function (Blueprint $table) {
                $table->id();
                $table->longText('message')->nullable();
                $table->foreignId('sender_id')->constrained('users');
                $table->foreignId('receiver_id')->nullable()->constrained('users');
                $table->foreignId('group_id')->nullable()->constrained('groups');
                $table->foreignId('conversation_id')->nullable()->constrained('conversations');
                $table->timestamps();
            });
        //}

     //  if(!Schema::hasTable('groups')){

            Schema::table('groups', function (Blueprint $table) {
                $table->foreignId('last_message_id')->nullable()->constrained('messages');
            });
       // }

      //  if(!Schema::hasTable('conversations')){

            Schema::table('conversations', function (Blueprint $table) {
                $table->foreignId('last_message_id')->nullable()->constrained('messages');
            });
      //  }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
