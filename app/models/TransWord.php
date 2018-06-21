<?php
class TransWord extends Eloquent {
	protected $table = 'trans_words';
    protected $fillable = array('word');
	public $timestamps = false;
	
	function relTransWords () {
		return $this->hasMany('TransLib', 'word_id');
	}
	
	
	function relArabic () {
		$arabic = $this->relTransWords()->where('lang_id', 2)->first();
		if (!$arabic)
			return false;
		
		return $arabic->trans_word;
	}
	
	static function getArabic ($text, $span=true) {
		if (!Session::has('LANG') || Session::get('LANG') == 'en')
			return $text;
			
		$text = trim($text);
		if (!$text)
			return $text;
		
		$word = TransWord::where('word', $text)->first();
		if (!$word) {
			$word = new TransWord();
			$word->word = $text;
			$word->save();
			
			return $text;
		}
			
			
		$arabic = TransLib::where(array('lang_id'=>2, 'word_id'=>$word->id))->first();
		if (!$arabic)
			return $text;
		if ($span)		
			return '<span class="arabic_text">'.$arabic->trans_word.'</span>';
		else 
			return $arabic->trans_word;
	}
}
