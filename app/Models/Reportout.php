<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reportout extends Model
{
    protected $table = 'reportouts';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'char';
}
