<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HsThamDinhGia extends Model
{
    protected $table = 'hsthamdinhgia';
    protected $fillable = [
        'id',
        'diadiem',
        'thoidiem',
        'ppthamdinh',
        'mucdich',
        'dvyeucau',
        'thoihan',
        'sotbkl',
        'hosotdgia',
        'nguonvon',
        'trangthai',
        'thang',
        'nam',
        'mahuyen',
        'mahs',
        'thuevat',
        'songaykq',
        'phanloai',
        'thuevat',
        'songaykq',
        'filedk',
        'filedk1',
        'filedk2',
        'filedk3',
        'filedk4'
    ];
}
