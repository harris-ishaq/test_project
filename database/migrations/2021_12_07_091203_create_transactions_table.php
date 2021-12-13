<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('transaction_id')->unique();
            $table->unsignedBigInteger('students_id')->nullable();
            $table->foreign('students_id')->references('id')->on('students')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->unsignedBigInteger('books_id')->nullable();
            $table->foreign('books_id')->references('id')->on('books')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->date('date_start');
            $table->date('date_return');
            $table->datetime('date_returned')->nullable();
            $table->enum('status', ['selesai', 'aktif', 'denda'])->default("aktif");
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
