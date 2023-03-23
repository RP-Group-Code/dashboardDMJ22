<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardIKAJ extends Model
{
    use HasFactory;
    protected $connection = 'mysql5';
    protected $table = "fakturjualheader";
}

class ReturjualIKA extends Model
{
    use HasFactory;
    protected $connection = 'mysql5';
    protected $table = "returjualheader";
}
class PiutangIKA extends Model
{
    use HasFactory;
    protected $connection = 'mysql5';
    protected $table = "piutangumur";
}
class SOheaderIKA extends Model
{
    use HasFactory;
    protected $connection = 'mysql5';
    protected $table = "soheader";
}
class HutangIKA extends Model
{
    use HasFactory;
    protected $connection = 'mysql5';
    protected $table = "hutangumur";
}
class ReturbeliIKA extends Model
{
    use HasFactory;
    protected $connection = 'mysql5';
    protected $table = "returbeliheader";
}
class SalesmanIKA extends Model
{
    use HasFactory;
    protected $connection = 'mysql5';
    protected $table = "salesman";
}
class StokkartuIKA extends Model
{
    use HasFactory;
    protected $connection = 'mysql5';
    protected $table = "stokkartu";
}
class StokbulanIKA extends Model
{
    use HasFactory;
    protected $connection = 'mysql5';
    protected $table = "stokbulan";
}
