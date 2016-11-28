<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Backpack\CRUD\CrudTrait;
class Section extends Model
{
    use CrudTrait;
    use SoftDeletes;

    protected $table='sections';
    protected $fillable = ['name', 'description', 'link', 'part','time','course_id','image'];

    public static function boot()
    {
        parent::boot();
        Course::observe(new \App\Observers\UserActionsObserver);
    }

    public function courses()
    {
        return $this->belongsTo('App\Course','course_id');
    }

    public function reviews()
    {
        return $this->belongsToMany('App\Review', 'section_reviews')
            ->withTimestamps();
    }
    public function rates()
    {
        return $this->belongsToMany('App\User', 'section_rates')
            ->withTimestamps();
    }

    public function favorite_sections()
    {
        return $this->belongsToMany('App\User', 'favorite_sections')
            ->withTimestamps();
    }
}
