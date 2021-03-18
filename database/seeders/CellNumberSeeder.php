<?php

namespace Database\Seeders;

use App\Models\CellNumber;
use Illuminate\Database\Seeder;

class CellNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cellNumbers = [
            ['cell_number'=>'27839188712','original_network'=>'MTN','current_network'=>'Vodacom'],
            ['cell_number'=>'27825642654','original_network'=>'Vodacom','current_network'=>'MTN'],
            ['cell_number'=>'27732555125','original_network'=>'MTN','current_network'=>'Telkom'],
            ['cell_number'=>'27843666564','original_network'=>'CellC','current_network'=>'MTN'],
            ['cell_number'=>'27715600012','original_network'=>'Telkom','current_network'=>'Vodacom'],
        ];

        foreach($cellNumbers as $cellNumber){
            CellNumber::create([
                'cell_number' => $cellNumber['cell_number'],
                'original_network' => $cellNumber['original_network'],
                'current_network' => $cellNumber['current_network'],
            ]);
        }
    }
}
