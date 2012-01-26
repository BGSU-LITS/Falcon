<?php defined('SYSPATH') or die('No direct script access.');
/**
 * A base Controller class.
 *
 * @package   Falcon
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class Falcon_Controller extends Kohana_Controller
{
	/**
	 * @var \Owl\Layout  The layout class
	 */
	protected $layout;

	/**
	 * @var \Owl\View OR array  The \Owl\View or array to be json encoded for ajax requests.
	 */
	protected $content;

	/**
	 * Initial setup
	 */
	public function before()
	{
		if ( ! $this->request->is_ajax())
		{
			$mobile = new Mobile_Detect;
			$class = $mobile->isMobile() ? "View_Layout_Mobile" : "View_Layout_Browser";
			$this->layout = new $class;
		}
	}

	/**
	 * Sends the request to the browser/device.
	 */
	public function after()
	{
		if ($this->request->is_ajax())
		{
			$this->response->headers("Content-Type", "application/json")
				->body(json_encode($this->content));
		}
		else
		{
			$this->layout->content($this->content);
			$this->response->body($this->layout->render());
		}
	}

}
