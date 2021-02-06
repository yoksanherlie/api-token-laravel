<?php

namespace Silverbullet\ApiTokenLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    protected $table = 'api_tokens';
    protected $fillable = ['name', 'code', 'token'];
}