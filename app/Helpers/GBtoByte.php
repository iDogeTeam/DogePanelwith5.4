<?php

if (!function_exists('GBtoByte')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function GBtoByte($GB)
    {
	    return $GB * pow(10,9) ;
    }
}
