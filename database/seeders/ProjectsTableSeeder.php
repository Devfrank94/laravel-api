<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// importiamo il faker
use Faker\Generator as Faker;
// importo il model
use App\Models\Project;
use App\Models\Type;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 20; $i++){

          $new_project = new Project();
          $new_project->type_id = Type::inRandomOrder()->first()->id;
          $new_project->title = $faker->sentence();
          $new_project->slug = Project::generateSlug($new_project->title);
          $new_project->image = $faker->imageUrl(360, 360, 'Vue', false, 'Laravel', true, 'jpg');
          $new_project->description = $faker->text(500);
          $new_project->date = date('Y-m-d');
          // dump($new_project);
          $new_project->save();
        }
    }
}
