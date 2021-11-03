<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        $cat_name = 'Без названия';
        $categories[] = [
            'title'     => $cat_name,
            'slug'      => Str::slug($cat_name),
//            'slug'      => str_slug($cat_name),
            'parent_id' => 0,
        ];

        for( $i = 2; $i <= 11; $i++ ) {

            $cat_name = 'Категория #' . $i;
            $parent_id = ( $i > 4 ) ? rand( 1, 4 ) : 1;

            $categories[] = [
                'title'     => $cat_name,
                'slug'      => Str::slug($cat_name),
//                'slug'      => str_slug($cat_name),
                'parent_id' => $parent_id,
            ];
        }

        \DB::table('blog_categories')->insert($categories);
    }
}
