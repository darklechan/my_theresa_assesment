<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price', function (Blueprint $table) {
            $table->increments('price_id');
            $table->unsignedInteger('product_id');
            $table->integer('original_price');
            $table->integer('final_price');
            $table->string('currency');
            $table->string('discount_percentage')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table
                ->foreign('product_id', 'fk_pr_prid_pr_prid')
                ->references('product_id')
                ->on('product')
                ->onUpdate('NO ACTION')
                ->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price');
    }
};
