<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouses = [
            array(1,100000,0,0,100000,0,0,100000),
            array(2,150000,0,0,150000,0,0,150000),
            array(3,180000,0,0,180000,0,0,180000),
            array(4,200000,0,0,200000,0,0,200000),
            array(5,230000,0,0,230000,0,0,230000),
            array(6,250000,0,0,250000,0,0,250000),
            array(7,280000,0,0,280000,0,0,280000),
            array(8,300000,0,0,300000,0,0,300000),
            array(9,330000,0,0,330000,0,0,330000),
            array(10,350000,0,0,350000,0,0,350000),
            array(11,380000,0,0,380000,0,0,380000),
            array(12,400000,0,0,400000,0,0,400000),
            array(13,430000,0,0,430000,0,0,430000),
            array(14,450000,0,0,450000,0,0,450000),
            array(15,210000,0,0,210000,0,0,210000),
            array(16,310000,0,0,310000,0,0,310000),
            array(17,390000,0,0,390000,0,0,390000),
            array(18,440000,0,0,440000,0,0,440000),
            array(19,520000,0,0,520000,0,0,520000),
            array(20,550000,0,0,550000,0,0,550000)
        ];
        foreach($warehouses as $warehouse){
            DB::table('warehouses')->insert([
                'product_id'=> $warehouse[0],
                'opening_balance'=>$warehouse[1],
                'sales_issue'=>$warehouse[2],
                'received'=>$warehouse[3],
                'availability'=>$warehouse[4],
                'sales_return'=>$warehouse[5],
                'damage'=>$warehouse[6],
                'closing_balance'=>$warehouse[7]
            ]);
        }
    }
}
