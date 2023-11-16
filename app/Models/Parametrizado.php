<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametrizado extends Model
{
    use HasFactory;

    protected $table = 'parametrizado';

    protected $fillable = [
        'canal',
        'desc_canal',
        'subcanal',
        'desc_subcanal',
        'modelo_negocio',
        'bodega',
        'tipo_distribucion',
        'lp_visual',
        'desc_lp_visual',
        'lp_neto',
        'desc_lp_neto',
        'empresa_id',
        'desc_empresa_id',
        'canal_id',
        'desc_canal_id',
        'subcanal_id',
        'desc_subcanal_id',
        'modelo_negocio_id',
        'bodega_id',
    ];

    public function empresa()
    {
        return $this->belongsTo(EmpresaCanal::class, 'empresa_id');
    }

    public function desc_empresa()
    {
        return $this->belongsTo(EmpresaCanal::class, 'desc_empresa_id');
    }

    public function canal()
    {
        return $this->belongsTo(CanalSubcanal::class, 'canal_id');
    }

    public function desc_canal()
    {
        return $this->belongsTo(CanalSubcanal::class, 'desc_canal_id');
    }

    public function subcanal()
    {
        return $this->belongsTo(CanalSubcanal::class, 'subcanal_id');
    }

    public function desc_subcanal()
    {
        return $this->belongsTo(CanalSubcanal::class, 'desc_subcanal_id');
    }

    public function modelo_negocio()
    {
        return $this->belongsTo(CanalSubcanal::class, 'modelo_negocio_id');
    }

    public function bodega()
    {
        return $this->belongsTo(CanalSubcanal::class, 'bodega_id');
    }
}
