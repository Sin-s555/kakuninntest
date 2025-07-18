<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactTypeToContactsTable extends Migration
{
    public function up()
{
    Schema::table('contacts', function (Blueprint $table) {
        $table->string('contact_type')->nullable()->after('detail'); // nullable推奨
    });
}

public function down()
{
    Schema::table('contacts', function (Blueprint $table) {
        $table->dropColumn('contact_type');
    });
}
}
