<?php
class AdminTransWordsController extends BaseController {
    function getIndex () {
        $ar = array();
        $ar['title'] = 'Words for translation';
		
		if (Input::has('wordname')) 
			$ar['items'] = TransWord::where('word', 'like', '%'.Input::get('wordname').'%')->orderBy('id', 'DESC')->with('relTransWords')->paginate(25);
		else 
			$ar['items'] = TransWord::orderBy('id', 'DESC')->with('relTransWords')->paginate(25);

		
		if (Input::has('sort_name') && Input::has('sort_val')){
			if (Input::get('sort_name') == 'id' && Input::get('sort_val') == 'down'){
				$ar['items'] = TransWord::orderBy('id', 'ASC')->with('relTransWords')->paginate(25);
			}
			else if(Input::get('sort_name') == 'id' && Input::get('sort_val') == 'up'){
				$ar['items'] = TransWord::orderBy('id', 'DESC')->with('relTransWords')->paginate(25);
			}
			else if(Input::get('sort_name') == 'name' && Input::get('sort_val') == 'down'){
				$ar['items'] = TransWord::orderBy('word', 'ASC')->with('relTransWords')->paginate(25);
			}
			else if(Input::get('sort_name') == 'name' && Input::get('sort_val') == 'up'){
				$ar['items'] = TransWord::orderBy('word', 'DESC')->with('relTransWords')->paginate(25);
			}
		}
		
        return View::make('admin.trans.word.index', $ar);
    }

    function getItem ($id = 0) {
        $item = TransWord::find($id);
		
        $ar = array();
        if (!$item) {
            $ar['title'] = 'Add new word';
            $ar['action'] = action('AdminTransWordsController@postItem');
        } else {
            $ar['title'] = 'Edit word';
            $ar['action'] = action('AdminTransWordsController@postItem', $item->id);
            $ar['item'] = $item;
        }

        return View::make('admin.trans.word.item', $ar);
    }

    function postItem ($id = 0) {
        $item = TransWord::find($id);
		 
        if (!$item) {
            $item = new TransWord();
        }

        $item->word = Input::get('word');

        if (!$item->save())
            return Redirect::back()->withErrors($item->getErrors());

        return Redirect::action('AdminTransWordsController@getIndex')->with('success', 'Data saved successfully');
    }

    function getDelete ($id) {
        $el = TransWord::findOrFail($id);
		TransLib::where('word_id', $el->id)->delete();
        $el->delete();

        return Redirect::action('AdminTransWordsController@getIndex')->with('success', 'Data saved deleted');
    }
	
	function getTranslation ($lang_id, $word_id) {
		$item = TransLib::where(array('lang_id'=>$lang_id, 'word_id'=>$word_id))->first();
		
		$ar = array();
        if (!$item) {
            $ar['title'] = 'Add translation';
            $ar['action'] = action('AdminTransWordsController@postTranslation', array($lang_id, $word_id));
        } else {
            $ar['title'] = 'Edit translation';
            $ar['action'] = action('AdminTransWordsController@postTranslation', array($lang_id, $word_id));
            $ar['item'] = $item;
        }

        return View::make('admin.trans.word.translation', $ar);
	}
	
	function postTranslation ($lang_id, $word_id) {
		$item = TransLib::where(array('lang_id'=>$lang_id, 'word_id'=>$word_id))->first();
		
		if (!$item) {
            $item = new TransLib();
			$item->lang_id = $lang_id;
			$item->word_id = $word_id;
        }

        $item->trans_word = Input::get('trans_word');

        if (!$item->save())
            return Redirect::back()->withErrors($item->getErrors());

        return Redirect::action('AdminTransWordsController@getIndex')->with('success', 'Data saved successfully');
		
	}
	
}
