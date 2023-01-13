<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class registration extends Model
{
    protected  $table      = 'registration';
    protected  $primaryKey = 'id';
    public  $incrementing  = true;
    protected  $keyType    = 'int';
    public  $timestamps    =  true;

    protected $fillable    = ['username', 'phone', 'email', 'password'];


}
