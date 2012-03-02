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
		// Check for a regular browser request
		if ($this->request->is_ajax() OR Arr::get($this->request->query(), "callback", false) !== false)
		{
			$this->request->action($this->request->action()."_ajax");
		}
		else
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
		$type = "text/html";
		$content = null;

		if ($this->request->is_ajax())
		{
			$type = "application/json";
			$content = json_encode($this->content);
		}
		elseif (Arr::get($this->request->query(), "callback", false) !== false)
		{
			$type = "text/javascript; charset=".Kohana::$charset;
			$content = $this->request->query('callback')."(".json_encode($this->content).")";
		}
		else
		{
			$type = "text/html";
			$this->layout->content($this->content);
			$content = $this->layout->render();
		}

		// Send the proper response
		$this->response->headers("Content-Type", $type)->body($content);
	}

}
