<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $posts = Post::factory(100)->create();
        foreach ($posts as $post) {
            # Le paso el modelo Image y le pido que me descargue 1 sola imagen y guarde la referencia de la URL en la DB
            Image::factory(1)->create(
                [
                    'imageable_id' => $post->id,
                    'imageable_type' => Post::class
                ]
            );
            $post->tags()->attach([
                rand(1, 4),
                rand(5, 8)
            ]);
        }
    }
}
