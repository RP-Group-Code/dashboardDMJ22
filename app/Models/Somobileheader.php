<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Somobileheader extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    protected $table = "somobileheader";

    public function salesmans()
    {
        return $this->belongsTo(Salesman::class);
    }
}
