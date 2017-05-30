<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'type', 'tags', 'addit_info', 'main_doc','filename',
    ];
}
