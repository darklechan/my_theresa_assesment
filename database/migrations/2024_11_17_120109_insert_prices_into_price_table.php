<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $rows = [
            [
                'product_id' => 1,
                'original_price' => 89000,
                'final_price' => 26700,
                'currency' => 'EUR',
                'discount_percentage' => 30,
            ],
            [
                'product_id' => 2,
                'original_price' => 99000,
                'final_price' => 29700,
                'currency' => 'EUR',
                'discount_percentage' => 30,
            ],
            [
                'product_id' => 3,
                'original_price' => 7100,
                'final_price' => 1065,
                'currency' => 'EUR',
                'discount_percentage' => 15,
            ],
            [
                'product_id' => 4,
                'original_price' => 79500,
                'final_price' => 79500,
                'currency' => 'EUR',
                'discount_percentage' => null,
            ],
            [
                'product_id' => 5,
                'original_price' => 59000,
                'final_price' => 59000,
                'currency' => 'EUR',
                'discount_percentage' => null,
            ],
        ];

        DB::table('price')->insert($rows);
    }

    public function down(): void
    {
        //Not needed
    }
};
