<?php namespace App\Http\Controllers;

class IndexController extends Controller {

	public function Index() {
		return view("/Dashboard/index");
	}
}

?>