<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['slug', 'name', 'title', 'testimonial', 'state', 'implementer_id'];

    public function implementer() {
        return $this->belongsTo(Implementer::class);
    }
}
