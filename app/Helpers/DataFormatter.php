<?php

if (!function_exists('dataFormatter')) {

	/**
	 * description
	 *
	 * @param
	 * @return
	 */
	function dataFormatter($data, $code = 200, $message = NULL)
	{
		if (empty($message)) $message = __('general.success');

		return response()
			->json([
				'code'    => $code,
				'message' => $message,
				'data'    => $data,
			]);
	}
}
