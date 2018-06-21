<?php
class AdvertProp extends Eloquent {
	protected $table = 'advert_props';
	protected $fillable = array( 'advert_id', 'prop_id', 'option_val', 'is_character');
	public $timestamps = false;
	public $prop = null;
	public $option_value = null;

	function getProp () {
		if (!$this->prop)
			$this->prop = SysAdvertProp::findOrFail($this->prop_id);

		return $this->prop;
	}

	function getOptionVal (){
		if (!$this->option_value)
			$this->option_value = SysAdvertPropOption::find($this->option_val);

		return $this->option_value;
	}

	function getPropAttribute (){
		$prop = $this->getProp();

		return $prop;
	}

	function getPropValAttribute (){
		$prop = $this->getProp();
		if ($prop->type_id == 2 || $prop->type_id == 4){ // select prop
			$option_value = $this->getOptionVal();
			if ($option_value)
				return $option_value->name;
			else 
				return null;
		}
		else if ($prop->type_id == 3) { // checbox prop
			if (!$this->option_val)
				return 'no';
				
			return 'yes';
		}

		return $this->option_val;
	}
	
	function setPropIdAttribute ($prop_id){
		$this->attributes['prop_id'] = $prop_id;
		
		if ($prop_id != 46)
			return true;
		
		$advert = Advert::find($this->advert_id);
		if ($advert) {
			$advert->price = $this->option_val;
			$advert->save();
		}
		
	}
}
