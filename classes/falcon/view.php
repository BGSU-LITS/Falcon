<?php defined('SYSPATH') or die('No direct script access.');
/**
 * A base View class.
 *
 * This class uses Owl/Mustache as the view render instead of the Kohana default.
 * If you would rather use Kohana's built in views, then extend Kohana_View instead.
 *
 * @package   Falcon
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
abstract class Falcon_View extends \Owl\View
{
	/**
	 * Loads a view (mustache) with Kohana's cascading file system.
	 *
	 * @param  string $file  The file to load
	 * @return string        The template (mustache)
	 */
	public static function load($file)
	{
		$info = pathinfo($file);
		$filename = $info['dirname'].DIRECTORY_SEPARATOR.$info['filename'];

		$path = Kohana::find_file("views", $filename, $info['extension']);

		if ( ! is_file($path))
		{
			throw new Exception("{$file} could not be found");
		}

		return file_get_contents($path);
	}

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
