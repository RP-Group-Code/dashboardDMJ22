<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardIKABDGJ extends Model
{
    use HasFactory;
    protected $connection = 'mysql6';
    protected $table = "fakturjualheader";
}

class ReturjualIKABDG extends Model
{
    use HasFactory;
    protected $connection = 'mysql6';
    protected $table = "returjualheader";
}
class PiutangIKABDG extends Model
{
    use HasFactory;
    protected $connection = 'mysql6';
    protected $table = "piutangumur";
}
class SOheaderIKABDG extends Model
{
    use HasFactory;
    protected $connection = 'mysql6';
    protected $table = "soheader";
}
class HutangIKABDG extends Model
{
    use HasFactory;
    protected $connection = 'mysql6';
    protected $table = "hutangumur";
}
class ReturbeliIKABDG extends Model
{
    use HasFactory;
    protected $connection = 'mysql6';
    protected $table = "returbeliheader";
}
class SalesmanIKABDG extends Model
{
    use HasFactory;
    protected $connection = 'mysql6';
    protected $table = "salesman";
}
class StokkartuIKABDG extends Model
{
    use HasFactory;
    protected $connection = 'mysql6';
    protected $table = "stokkartu";
}
class StokbulanIKABDG extends Model
{
    use HasFactory;
    protected $connection = 'mysql6';
    protected $table = "stokbulan";
}
