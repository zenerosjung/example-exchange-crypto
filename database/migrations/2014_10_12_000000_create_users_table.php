<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

        });

        Schema::create('cryptocurrency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('currency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('fiat_wallet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->float('estimated_balance', 8, 8)->default(0);
            $table->float('fait_balance', 8, 8)->default(0);
            $table->float('spot_balance', 8, 8)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('fiat_wallet_cryptocurrency', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fiat_wallet_id')->unsigned();
            $table->integer('cryptocurrency_id')->unsigned();
            $table->foreign('fiat_wallet_id')->references('id')->on('fiat_wallet')->onDelete('cascade');
            $table->foreign('cryptocurrency_id')->references('id')->on('cryptocurrency')->onDelete('cascade');
            $table->float('total', 8, 8)->default(0);
            $table->float('available', 8, 8)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('funding_wallet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->float('estimated_balance', 8, 8)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('funding_wallet_cryptocurrency', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('funding_wallet_id')->unsigned();
            $table->integer('cryptocurrency_id')->unsigned();
            $table->foreign('funding_wallet_id')->references('id')->on('funding_wallet')->onDelete('cascade');
            $table->foreign('cryptocurrency_id')->references('id')->on('cryptocurrency')->onDelete('cascade');
            $table->float('total', 8, 8)->default(0);
            $table->float('available', 8, 8)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('cryptocurrency');
        Schema::dropIfExists('currency');
        Schema::dropIfExists('fiat_wallet');
        Schema::dropIfExists('fiat_wallet_cryptocurrency');
        Schema::dropIfExists('funding_wallet');
        Schema::dropIfExists('funding_wallet_cryptocurrency');
    }
}
