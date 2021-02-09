<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthHost extends Model
{
    use HasFactory;
    protected $connection = "mysql_auth";
    protected $table = "auth_host";
    protected $primaryKey = "ahost_id";

    protected $fillable = [
        "ahost_ip"
    ];
}
