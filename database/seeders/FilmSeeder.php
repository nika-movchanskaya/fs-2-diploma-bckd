<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Film;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Film::insert([
            [
                'name' => ' Forrest Gump',
                'description' => 'The history of the United States from the 1950s to the \'70s unfolds from the perspective of an Alabama man with an IQ of 75, who yearns to be reunited with his childhood sweetheart.',
                'origin' => 'USA',
                'duration' => 142,
                'image' => 'https://m.media-amazon.com/images/I/91++WV6FP4L._AC_SY879_.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Interstellar',
                'description' => 'Humanity\'s existence on Earth is coming to an end as a result of climate change. A group of scientists discover a wormhole that allows them to search for a new home.',
                'origin' => 'USA',
                'duration' => 169,
                'image' => 'https://m.media-amazon.com/images/I/91vIHsL-zjL._AC_SY879_.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'The Dark Knight',
                'description' => 'Batman, with the help of Lieutenant Gordon and U.S. attorney Harvey Dent, takes on the terrifying and erratic Joker who wants to plunge Gotham City into chaos.',
                'origin' => 'USA',
                'duration' => 152,
                'image' => 'https://image.tmdb.org/t/p/w1280/4lj1ikfsSmMZNyfdi8R8Tv5tsgb.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pulp Fiction',
                'description' => 'Violence and redemption in a story about two hitmen working for the Mafia, a gangster\'s wife, a boxer and a couple robbing people in a restaurant.',
                'origin' => 'USA',
                'duration' => 162,
                'image' => 'https://fwcdn.pl/fpo/10/39/1039/8064160_1.10.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fight Club',
                'description' => 'An insomniac office worker and a devil-may-care soap maker form an underground fight club that evolves into much more.',
                'origin' => 'USA',
                'duration' => 139,
                'image' => 'https://m.media-amazon.com/images/I/51tRn1L9FfL._AC_UF894,1000_QL80_.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
