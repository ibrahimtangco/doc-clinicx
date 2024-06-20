<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function storeProduct($product)
    {

        return Product::create($product);
    }

    public function updateProduct($validated, $product)
    {
        return $product->update($validated);
    }

    public function searchProduct($search)
    {

        return
            Product::where('products.name', 'LIKE', '%' . $search . '%')
            ->orWhereHas('category', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->get();
    }
}
