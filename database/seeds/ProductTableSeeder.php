<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product=new Product([
            'imagePath'=>'img/movie1.jpg',
            'title'=>'Action  movie',
            'description'=>'this is description of this  movie',
            'price'=>13
        ]);
        $product->save();
        $product=new Product([
            'imagePath'=>'img/movie3.jpg',
            'title'=>' Movie core i3',
            'description'=>'this is description of this  movie',
            'price'=>13
        ]);
        $product->save();
        $product=new Product([
            'imagePath'=>'img/movie2.jpg',
            'title'=>'The it movie',
            'description'=>'this is description of this  movie',
            'price'=>13
        ]);
        $product->save();
    }
}
