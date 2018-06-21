<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function generateBreadcrumbs ($ar = array()) {
		$res = array();
		$res[] = array('url'=>action('AdminController@getIndex'), 'name'=>'Main');
		if (!isset($ar['url']))
			$res = array_merge($res, $ar);
		else
			$res[] = $ar;

		return $res;
	}

	protected function trimData ($data) {
		foreach ($data as $k=>$v) {
			if (is_array($v))
				$data[$k] = $this->trimData($v);
			else
				$data[$k] = trim($v);
		}

		return $data;
	}

}
