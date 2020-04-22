<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarbonHistory extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['updated_at', 'deleted_at'];
    protected $fillable = ['carbon', 'area_tree_id'];

    public function areaTree()
    {
        return $this->belongsTo('App\AreaTree');
    }
}
