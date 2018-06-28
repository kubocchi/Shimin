<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessReport extends Model
{
    public function year(){
        return $this->belongsTo(Year::class);
    }

    public function business(){
        return $this->belongsTo(Business::class);
    }

    public function attachment(){
        return $this->belongsTo(Attachment::class);
    }
}
