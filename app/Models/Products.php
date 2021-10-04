<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;


    protected $fillable = ["product_name", "product_quantity", "product_description", "product_price", "category_id", "subcategory_id", "product_photo"];

    public function category()
    {

        return $this->belongsTo(Categories::class);
    }

    public function subcategory()
    {

        return $this->belongsTo(SubCategory::class, "sub_category_id", "id");
    }
}
