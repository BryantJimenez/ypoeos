<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Implementer extends Model
{
	use SoftDeletes;

    protected $fillable = ['title', 'ypo_chapter', 'service_area', 'address', 'lat', 'lng', 'experience', 'ypo_link', 'eos_link', 'facebook', 'twitter', 'linkedin', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function testimonials() {
        return $this->hasMany(Testimonial::class);
    }
}
