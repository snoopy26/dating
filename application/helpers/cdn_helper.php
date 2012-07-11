<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * cdn URL
 *
 * Returns the "cdn_url" dari file config, kalau tidak di set return base_url aja
 *
 * @access	public
 * @return	string
 */
if (!function_exists('cdn_url')) {
    function cdn_url($loadbalance = false)
    {
        /*
        * $static = FALSE, jika cdn_url ada lebih dari 1 url (array) maka khusus static ini tidak di random
        */
        $CI = &get_instance();
        //var_dump($CI);
        $cdn_url = $CI->config->item('cdn_url');
        //  print_r($cdn_url);
        if ($cdn_url) {
            if (is_array($cdn_url) && $loadbalance) {
                $cdnrand = rand(0, count($cdn_url) - 1);
                $url = $cdn_url[$cdnrand];
            } else {
                $url = $cdn_url[0]; // ambil key pertama, isinya url ke server GEDE
            }

            return $url;
        } else {
            return $CI->config->slash_item('base_url');
        }
    }
}

if (!function_exists('base_urls')) {
	function base_urls($uri = '')
	{
		$CI =& get_instance();
		//return $CI->config->base_url($uri);
        $trans = array(
/*
            'http://www.tiket.' => 'https://secure.tiket.',
            'https://www.tiket.' => 'https://secure.tiket.',
            'http://ww.tiket.' => 'https://ww.secure.tiket.',
            'http://id.tiket.' => 'https://secure.tiket.',
            'http://devel.tiket.' => 'https://devel.secure.tiket.',
            'http://staging.tiket.' => 'https://staging.secure.tiket.',
*/
            'http://' => 'https://'
        );
        if( strpos($_SERVER['HTTP_HOST'], 'tiket.com') === false) $_SERVER['HTTP_HOST'] = 'www.tiket.com';
        return strtr('http://' . $_SERVER['HTTP_HOST'] . "/", $trans);
	}
}


if (!function_exists('cs_url')) {
	function cs_url($uri = '')
	{
		$CI =& get_instance();
		//return $CI->config->base_url($uri);
        $trans = array(
            'admin/cs' => 'reseller'
        );
        if(stripos($uri, 'http://') === false) {
            $uri = base_url() . $uri;
        }
        if($CI->uri->segment(1) == 'reseller') {
            return strtr($uri, $trans);            
        } else {
            return $uri;            
        }

	}
}

if (!function_exists('getDomain')) {

    function getDomain($hostname = '')
    {
        $domain = empty($hostname) ? $_SERVER['HTTP_HOST'] : $hostname;
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain,
            $regs)) {
            return $regs['domain'];
        }
        return false;
    }
}

if (!function_exists('strstrb')) {
    function strstrb($h, $n)
    {
        return array_shift(explode($n, $h, 2));
    }

}

if (!function_exists('null')) {
    function null($i = null)
    {
        if (empty($i)) {
            return null;
        } else {
            return $i;
        }
    }

}
function mb_rawurlencode($url)
{
    $encoded = '';
    $length = mb_strlen($url);
    for ($i = 0; $i < $length; $i++) {
        $encoded .= '%' . wordwrap(bin2hex(mb_substr($url, $i, 1)), 2, '%', true);
    }
    return $encoded;
}


// ------------------------------------------------------------------------
