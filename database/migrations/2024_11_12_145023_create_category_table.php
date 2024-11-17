<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category', function (Blueprint $table) {
            $table->smallIncrements('category_id');
            $table->string('category_name');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        DB::table('category')->insert([
            [
                'category_name' => 'boots',
            ],
            [
                'category_name' => 'sandals',
            ],
            [
                'category_name' => 'sneakers',
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
