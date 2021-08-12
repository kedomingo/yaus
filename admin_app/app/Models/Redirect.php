<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $table = 'redirects';

    protected $guarded = false;

    public const CREATED_AT = 'created';
    public const UPDATED_AT = 'updated';
}
