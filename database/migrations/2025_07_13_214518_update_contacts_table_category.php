<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateContactsTableCategory extends Migration
{
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            // 外部キー制約を削除
            if (Schema::hasColumn('contacts', 'category_id')) {
                $table->dropForeign(['category_id']); // 外部キー制約を外す
                $table->dropColumn('category_id');    // カラムを削除
            }

            if (!Schema::hasColumn('contacts', 'category')) {
                $table->string('category')->after('building');
            }
        });
    }

    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (Schema::hasColumn('contacts', 'category')) {
                $table->dropColumn('category');
            }
            if (!Schema::hasColumn('contacts', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable();
                $table->foreign('category_id')->references('id')->on('categories');
            }
        });
    }
}