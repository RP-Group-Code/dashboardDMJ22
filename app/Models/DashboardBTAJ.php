<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardBTAJ extends Model
{
    use HasFactory;
    protected $connection = 'mysql4';
    protected $table = "fakturjualheader";
}

class ReturjualDMJBTA extends Model
{
    use HasFactory;
    protected $connection = 'mysql4';
    protected $table = "returjualheader";
}
class PiutangDMJBTA extends Model
{
    use HasFactory;
    protected $connection = 'mysql4';
    protected $table = "piutangumur";
}
class SOheaderDMJBTA extends Model
{
    use HasFactory;
    protected $connection = 'mysql4';
    protected $table = "soheader";
}
class HutangDMJBTA extends Model
{
    use HasFactory;
    protected $connection = 'mysql4';
    protected $table = "hutangumur";
}
class ReturbeliDMJBTA extends Model
{
    use HasFactory;
    protected $connection = 'mysql4';
    protected $table = "returbeliheader";
}
class SalesmanDMJBTA extends Model
{
    use HasFactory;
    protected $connection = 'mysql4';
    protected $table = "salesman";
}
class StokkartuDMJBTA extends Model
{
    use HasFactory;
    protected $connection = 'mysql4';
    protected $table = "stokkartu";
}
class StokbulanDMJBTA extends Model
{
    use HasFactory;
    protected $connection = 'mysql4';
    protected $table = "stokbulan";
}
