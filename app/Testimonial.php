<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['owner', 'owner_title', 'text', 'implementer_id'];

    public function implementer() {
        return $this->belongsTo(Implementer::class);
    }
}
