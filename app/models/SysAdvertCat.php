<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class SysAdvertCat extends Eloquent {
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
	protected $table = 'sys_advert_cats';
    protected $fillable = array('name', 'level', 'parent_id', 'icon');

    function getCreatedAtAttribute($value){
	   return ModelSnipet::formatDate($value, 'd.m.Y H:i:s');
	}

	function getUpdatedAtAttribute($value){
	   return ModelSnipet::formatDate($value, 'd.m.Y H:i:s');
	}

    function relParent () {
        return $this->belongsTo('SysAdvertCat', 'parent_id');
    }


    function relsChilds () {
        return $this->hasMany('SysAdvertCat', 'parent_id');
    }

    static function getFullArrNames ($level = 1) {
        if ($level == 1)
            return  static::where('level', 1)->lists('name', 'id');

        if (!in_array($level, array(2,3,4)))
            return array();

        $parent_level = $level - 1;
        $ar_parent = static::getFullArrNames($parent_level);

        $ar = array();
        $els = static::where('level', $level)->get();
        foreach ($els as $e) {
            $ar[$e->id] = $ar_parent[$e->parent_id].' -> '.$e->name;
        }

        return $ar;
    }

    function allDelete () {
        foreach ($this->relsChilds as $ch) {
            $ch->allDelete();
        }
        
        $this->delete();
    }


}
