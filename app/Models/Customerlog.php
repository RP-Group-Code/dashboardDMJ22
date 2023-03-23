<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customerlog extends Model
{
    use HasFactory;
    protected $connection = 'mysql3';
    protected $table = "customer_log";

    public function salesmans()
    {
        return $this->belongsTo(Salesman::class);
    }
}
