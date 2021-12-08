<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable =[
        'brand_name',
        'brand_desc',
        'brand_stt'
];
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand_product';


}
