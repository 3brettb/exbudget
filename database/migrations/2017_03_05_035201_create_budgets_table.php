<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->float('amount', 10, 2);
            $table->string('description', 100)->nullable();
            $table->uuid('category_id')->references('id')->on('categories');
            $table->uuid('sub_category_id')->references('id')->on('sub_categories');
            $table->integer('month_id')->references('id')->on('months');
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
        Schema::dropIfExists('budgets');
    }
}
