<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToQueriesTable extends Migration
{
    public function up()
    {
        Schema::table('queries', function (Blueprint $table) {
            $table->unsignedBigInteger('dealt_by_id');
            $table->foreign('dealt_by_id', 'dealt_by_fk_3194724')->references('id')->on('employees');
            $table->unsignedBigInteger('interaction_type_id')->nullable();
            $table->foreign('interaction_type_id', 'interaction_type_fk_3194969')->references('id')->on('query_interaction_types');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_3274053')->references('id')->on('query_statuses');
        });
    }
}
