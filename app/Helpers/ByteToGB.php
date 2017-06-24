<?php

if (!function_exists('bytyToGB')) {

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
