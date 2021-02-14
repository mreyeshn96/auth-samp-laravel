<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedAccount extends Model
{
    use HasFactory;
    
    protected $connection = "mysql_pcu";
    protected $primaryKey = "BANID";
    protected $table = "sv_ban_cuentas";

    protected $fillable=["admin", "jugador", "razon", "IP", "baneado"];
}
