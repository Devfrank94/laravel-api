<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Full-Stack', 'Front-End', 'Back-End'];

        foreach($data as $type){
          $new_type = new Type();
          $new_type->name = $type;
          $new_type->slug = Type::generateSlug($type);
          // dump($new_type);
          $new_type->save();
        }
    }
}
