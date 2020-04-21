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

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function trees()
    {
        return $this->belongsToMany('App\Tree');
    }
}
