<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable=[
        'title',
        'price',
        'des',
        'onShelf'
    ];

    public function medias()
    {
        return $this->hasMany('App\Media');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function productpics()
    {
        return $this->hasMany('App\Productpic');
    }

    public function productconts()
    {
        return $this->hasMany('App\Productcont','product_id');
    }

    public static function boot()
    {
        parent::boot();

        // Attach event handler, on deleting of the user
        Product::deleting(function($product)
        {
            // Delete all tricks that belong to this user
            foreach ($product->medias as $media) {
                $media->delete();
            }

            foreach ($product->reviews as $review) {
                $review->delete();
            }

            foreach ($product->productpics as $productpic) {
                $productpic->delete();
            }

            foreach ($product->productconts as $productcont) {
                $productcont->delete();
            }
        });
    }
}
