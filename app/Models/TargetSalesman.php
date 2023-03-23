<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetSalesman extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = "target";
    public $timestamps = false;

    public function salesmans()
    {
        return $this->belongsTo(Salesman::class);
    }
}
