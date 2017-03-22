<?php

if (!function_exists('secToDate')) {

	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function secToDate($time)
	{
		return date('Y-m-d H:i:s', $time);
	}
}
