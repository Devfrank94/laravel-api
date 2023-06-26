<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tecnology;
use App\Models\Project;

class ProjectsTecnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 30; $i++){

          //estraggo project random
          $project = Project::inRandomOrder()->first();

          // estraggo id tecnology random
          $tecnology_id = Tecnology::inRandomOrder()->first()->id;
          // dump($tecnology_id);

          $project->tecnologies()->attach($tecnology_id);
        }
    }
}
