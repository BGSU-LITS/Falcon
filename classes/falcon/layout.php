<?php defined('SYSPATH') or die('No direct script access.');
/**
 * A base Layout class.
 *
 * @package   Falcon
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
abstract class Falcon_Layout extends \Owl\Layout
{
	/**
	 * Loading of mustache templates.
	 *
	 * @param  string $file  The path of the template file (relative to the $templates_directory)
	 * @return string        The full template
	 */
	protected function load_template($file)
	{
		return Falcon_View::load($file);
	}
}
