<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class details extends Model
{
    protected  $table      = 'details';
    protected  $primaryKey = 'id';
    public  $incrementing  = true;
    protected  $keyType    = 'int';
    public  $timestamps    =  true;

    // protected $fillable    = ['username', 'phone', 'email', 'password'];
}
