<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Message is a class that lets you easily send messages between reqeusts.
 * (aka Flash Messages)
 *
 * @package   Falcon
 * @author    Dave Widmer <dwidmer@bgsu.edu>
 */
class Falcon_Message
{
	/**
	 * Constants to use for the types of messages that can be set.
	 */
	const ERROR = 'error';
	const NOTICE = 'notice';
	const SUCCESS = 'success';
	const WARN = 'warn';

	/**
	 * @var	array	The message to display.
	 */
	public $message;

	/**
	 * @var	string	The type of message.
	 */
	public $type;

	/**
	 * Creates a new Falcon_Message instance.
	 *
	 * @param	string	Type of message
	 * @param	mixed	Message to display, either string or array
	 */
	public function __construct($type, $message)
	{
		$this->type = $type;

		if ( ! is_array($message))
		{
			$message = array($message);
		}

		$this->message = array_values($message);
	}

	/**
	 * Gets the current message.
	 *
	 * @return	mixed	The message or FALSE
	 */
	public static function get()
	{
		return Session::instance()->get_once('falcon_message', false);
	}

	/**
	 * Sets a message.
	 *
	 * @param	string	Type of message
	 * @param	mixed	Array/String for the message
	 * @return	void
	 */
	public static function set($type, $message)
	{
		Session::instance()->set('falcon_message', new Message($type, $message));
	}

	/**
	 * Sets an error message.
	 *
	 * @param	mixed	String/Array for the message(s)
	 * @return	void
	 */
	public static function error($message)
	{
		self::set(Message::ERROR, $message);
	}

	/**
	 * Sets a notice.
	 *
	 * @param	mixed	String/Array for the message(s)
	 * @return	void
	 */
	public static function notice($message)
	{
		self::set(Message::NOTICE, $message);
	}

	/**
	 * Sets a success message.
	 *
	 * @param	mixed	String/Array for the message(s)
	 * @return	void
	 */
	public static function success($message)
	{
		self::set(Message::SUCCESS, $message);
	}

	/**
	 * Sets a warning message.
	 *
	 * @param	mixed	String/Array for the message(s)
	 * @return	void
	 */
	public static function warn($message)
	{
		self::set(Message::WARN, $message);
	}
}
