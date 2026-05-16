<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('age')->unsigned();
            $table->string('gender');
            $table->string('account_type');
            $table->date('account_opening_date');
            $table->string('account_status')->default('active');
            $table->bigInteger('account_number')->unsigned()->unique();
            $table->decimal('current_account_balance',10,2)->default(1000.00);
            $table->decimal('savings_account_balance',10,2)->default(500.00);
            $table->string('address');
            $table->string('phone')->unique();
            $table->string('email')->unique();
             $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
