<?php

class Controller_Admin_Main extends Controller
{

	public function action_index()
	{
        return Response::forge(View::forge('admin/main/index'));
	}

}
