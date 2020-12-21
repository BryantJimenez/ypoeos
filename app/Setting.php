<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['video', 'feature_one', 'feature_two', 'feature_three', 'feature_four', 'why_works', 'phone'];
}
