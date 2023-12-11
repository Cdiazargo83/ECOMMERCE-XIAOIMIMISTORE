<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaStockModel extends Model
{
    use HasFactory;

    protected $fillable = [

        'sku_saco',
        'sku_bitel',
        'name',
        'desc_product',
        'id_lp_b2b',
        'id_lp_b2c',
        'lp_b2b_price',
        'id_b2c_price',
        'quantity'
    ];
}
