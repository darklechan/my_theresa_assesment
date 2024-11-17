<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $rows = [
            [
                'sku' => '000001',
                'name' => 'BV Lean leather ankle boots',
                'category_id' => 1,
            ],
            [
                'sku' => '000002',
                'name' => 'BV Lean leather ankle boots',
                'category_id' => 1,
            ],
            [
                'sku' => '000003',
                'name' => 'Ashlington leather ankle boots',
                'category_id' => 1,
            ],
            [
                'sku' => '000004',
                'name' => 'Naima embellished suede sandals',
                'category_id' => 2,
            ],
            [
                'sku' => '000005',
                'name' => 'Nathane leather sneakers',
                'category_id' => 2,
            ],
        ];

        DB::table('product')->insert($rows);
    }

    public function down(): void
    {
        //Not needed
    }
};
