<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['parent_id', 'name', 'level'];

    public function parent()
    {
        return $this->belongsTo('App\Location', 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany('App\Location', 'parent_id', 'id');
    }

    public function areas()
    {
        return $this->hasMany('App\Area');
    }

    public function trees()
    {
        return $this->hasManyThrough('App\Tree', 'App\Area');
    }
}
