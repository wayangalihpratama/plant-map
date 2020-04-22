<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Area extends Model
{
    use SoftDeletes;
    use SpatialTrait;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['name', 'location_id'];
    protected $spatialFields = ['geometry'];
    protected $appends = ['tree_count'];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function trees()
    {
        return $this->belongsToMany('App\Tree', 'area_trees')->withPivot('id', 'age');
    }

    public function areaTrees()
    {
        return $this->hasMany('App\AreaTree');
    }

    public function getTreeCountAttribute()
    {
        return $this->trees()->count();
    }
}
