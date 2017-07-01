<?php

if (!function_exists('byteToGB')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function byteToGB($byte)
    {
		return $byte / pow(10,9) ;
    }
}
