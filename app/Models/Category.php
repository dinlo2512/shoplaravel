<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable =[
        'category_name',
        'category_desc',
        'category_stt'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
