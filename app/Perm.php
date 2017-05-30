<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perm extends Model
{
    protected $fillable = [
        'id_user', 'id_doc', 'write_perm', 'grant_perm',
    ];
}
