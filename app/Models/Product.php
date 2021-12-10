<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable =[
        'product_name',
        'product_desc',
        'product_content',
        'product_prime',
        'product_pic',
        'product_stt',
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function brand():BelongsTo
    {
        return$this->belongsTo(Brand::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
