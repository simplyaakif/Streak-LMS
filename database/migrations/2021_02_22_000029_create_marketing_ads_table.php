<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketingAdsTable extends Migration
{
    public function up()
    {
        Schema::create('marketing_ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->longText('ad')->nullable();
            $table->date('publish_at')->nullable();
            $table->date('valid_till')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
