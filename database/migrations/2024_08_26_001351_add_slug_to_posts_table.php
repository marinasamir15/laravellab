<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToPostsTable extends Migration
{
    public function up()
{
    Schema::table('posts', function (Blueprint $table) {
        if (!Schema::hasColumn('posts', 'slug')) {
            $table->string('slug')->after('title')->unique();
        }
    });
}


    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}