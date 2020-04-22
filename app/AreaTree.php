<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaTree extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['age', 'tree_id', 'area_id'];
    protected $appends = ['total_carbon'];

    public function carbonHistories()
    {
        return $this->hasMany('App\CarbonHistory');
    }

    public function tree()
    {
        return $this->belongsTo('App\Tree');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function getTotalCarbonAttribute()
    {
        return $this->carbonHistories()->sum('carbon');
    }
}
