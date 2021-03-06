<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaHhTt extends Model
{
    protected $table = 'giahhtt';
    protected $fillable = [
        'id',
        'mahh',
        'tenhh',
        'masopnhom',
        'maloaihh',
        'maloaigia',
        'thitruong',
        'thoigian',
        'mathoidiem',
        'giatulk',
        'giadenlk',
        'giatu',
        'giaden',
        'dvt',
        'nguontin',
        'mahs',
        'gc'
    ];
}
