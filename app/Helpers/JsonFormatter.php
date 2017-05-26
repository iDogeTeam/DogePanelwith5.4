<?php

if (!function_exists('formatter')) {

	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function formatter($code, $data = NULL)
	{
		return response()
			->json([
				'code' => $code,
				'data' => $data,
			]);
	}
}
