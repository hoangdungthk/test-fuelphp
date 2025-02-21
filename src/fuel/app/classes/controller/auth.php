<?php

class Controller_Auth extends Controller
{

    /**
     * Login page.
     *
     * @access  public
     * @return  Response
     */
    public function action_login(): Response
    {
        return Response::forge(View::forge('auth/login'));
    }

    /**
     * register page
     *
     * @access  public
     * @return Response
     */
    public function action_register()
    {
        return Response::forge(View::forge('auth/register'), 200);
    }

}
