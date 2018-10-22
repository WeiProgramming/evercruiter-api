<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $fillable = ['candidate_id','company_name', 'company_position','current_status', "current_round","total_rounds"];
    protected $hidden = ['company_name'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
