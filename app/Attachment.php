<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attachment extends Model
{
    /**
     * Guard properties
     *
     * @var array
     **/
    protected $guarded = ['id'];

    protected $appends = [
    	'time'
    ];


    /**
     * Format updated_at 
     *
     * @return string
     */
    public function getTimeAttribute()
    {
        return (Carbon::parse($this->updated_at))->diffForHumans();
    }
}
