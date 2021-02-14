<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthClient extends Model
{
    use HasFactory;
    protected $connection = "mysql_auth";
    protected $primaryKey = "aclient_id";
    protected $table = "auth_client";

    protected $fillable = [
        'acc_id',
        'user_ip',
        'ahost_id'
    ];

    public function ClientHost()
    {
        return $this->hasMany(AuthHost::class, "ahost_id", "ahost_id");
    }
}
