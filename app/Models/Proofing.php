<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proofing extends Model
{
    use HasFactory;
    protected $fillable = [
        'proofing_at','purchasing_order_id','path_image','description','data_status','supplier_id'
    ];
    public function supplier()
    {
        return $this->hasMany('App\Models\Supplier', 'id', 'supplier_id');
    }
}
