<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tree extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['name', 'age', 'carbon', 'type_id', 'area_id'];

    public function type()
    {
        return $this->belongsTo('App\Area');
    }

    public function areas()
    {
        return $this->belongsToMany('App\Area', 'area_trees')->withPivot('id', 'age');
    }

    public function areaTrees()
    {
        return $this->hasMany('App\AreaTree');
    }
}
