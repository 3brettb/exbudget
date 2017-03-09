<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('hash', 128)->unique();
            $table->date('date');
            $table->float('amount', 10, 2);
            $table->string('description');
            $table->string('notes')->nullable();
            $table->uuid('category_id')->references('id')->on('categories')->nullable();
            $table->uuid('sub_category_id')->references('id')->on('sub_categories')->nullable();
            $table->uuid('account_id')->references('id')->on('accounts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
