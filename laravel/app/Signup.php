<?php

namespace feeduciary;

use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{
    protected $fillable = ['name', 'email', 'token'];
}