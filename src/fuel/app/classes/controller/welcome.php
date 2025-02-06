<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.9-dev
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller
{
	/**
	 * Login page.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_login(): Response
	{
		return Response::forge(View::forge('welcome/login'));
	}

	/**
	 * A typical "Hello, Bob!" type example.  This uses a Presenter to
	 * show how to use them.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_hello(): Response
	{
        return Response::forge(Presenter::forge('welcome/hello'));
	}

    /**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404(): Response
	{
		return Response::forge(Presenter::forge('welcome/404'), 404);
	}

    /**
     * register page
     *
     * @access  public
     * @return Response
     */
    public function action_register(): Response
    {
        return Response::forge(View::forge('welcome/register'), 200);
    }

    /**
     * show page
     *
     * @access public
     * @return Response
     */
    public function action_show(): Response
    {
        return Response::forge(View::forge('welcome/show'), 200);
    }
}
