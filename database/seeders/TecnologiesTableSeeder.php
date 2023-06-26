<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tecnology;

class TecnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = ['HTML', 'CSS', 'Javascript', 'PHP', 'C++', 'SASS', 'Laravel', 'Vue', 'Bootstrap' ];

      foreach($data as $tecnology){
        $new_tecnology = new Tecnology();
        $new_tecnology->name = $tecnology;
        $new_tecnology->slug = Tecnology::generateSlug($tecnology);
        // dump($new_tecnology);
        $new_tecnology->save();
      }
    }
}
