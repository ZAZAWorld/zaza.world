<?php
class CompanyFile extends Eloquent {
    protected $table = 'company_files';
    protected $fillable = array( 'company_id', 'file_type_id', 'title', 'note', 'path', 'file_format');
    public $timestamps = false;
	
	
	function setPathAttribute ($value){
		if ($this->file_type_id == 3){
			if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $value, $match)) {
				//$video_id = $match[1];
				$this->attributes['path'] = $match[1];
			}
			else {
				if (!$value){
					$this->attributes['path'] = $value;
					return false;
				}
				
				if (strpos($value, 'youtu') == false){
					$this->attributes['path'] = $value;
					return false;
				}
					
				
				$value = explode("/", $value);
				$value = end($value);
				
				if (strpos($value, 'watch') == true){
					echo $value; exit();
					$value = substr($value, 7, strlen($value));
				}
					
				
				$this->attributes['path'] = $value;
			}
			
			return true;
		}
		
		$this->attributes['path'] = $value;
	}
}
