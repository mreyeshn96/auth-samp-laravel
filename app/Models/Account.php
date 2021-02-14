<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Account extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $connection = "mysql_auth";
    protected $primaryKey = "acc_id";
    protected $table = "account";

    protected $fillable = [
        'acc_nickname',
        'acc_name',
        'game_acc_id'
    ];

    public function GameAccount()
    {
        return $this->hasOne(GameAccount::class, 'ID', 'game_acc_id');
    }

    // public function BannedInfo()
    // {
    //     return $this->hasOne(BannedAccount::class, 'jugador', 'game_acc_id');
    // }
}
