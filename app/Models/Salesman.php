<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesman extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = "salesman";
    protected $fillable = ['id','KdSlm','NmSlm'];

    public function target()
    {
        return $this->hasMany(Target::class);
    }

}
