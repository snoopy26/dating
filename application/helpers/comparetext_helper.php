<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
if (!function_exists('compare_text')) {
	function compare_text($str1, $str2)
    {
        $d = Array();
     
        $lenStr1 = strlen($str1);
        $lenStr2 = strlen($str2);
     
        if ($lenStr1 == 0) 
            return $lenStr2;
            
        if ($lenStr2 == 0) 
            return $lenStr1;
     
        for ($i=0; $i <= $lenStr1; $i++)
        {
            $d[$i] = Array();
            $d[$i][0] = $i;     
        }
 
        for ($j=0; $j <= $lenStr2; $j++)
            $d[0][$j] = $j; 
        
        for ($i=1; $i <= $lenStr1; $i++)
        {
            for ($j=1; $j <= $lenStr2; $j++)
            {
                $cost = substr($str1, $i - 1, 1) == substr($str2, $j - 1, 1) ? 0 : 1;
                
                $d[$i][$j] = min(
                                    $d[$i - 1][$j] + 1,                 // deletion
                                    $d[$i][$j - 1] + 1,                 // insertion
                                    $d[$i - 1][$j - 1] + $cost          // substitution
                                );
                                
                if (    
                    $i > 1 && 
                    $j > 1 && 
                    substr($str1, $i - 1, 1) == substr($str2, $j - 2, 1) && 
                    substr($str1, $i - 2, 1) == substr($str2, $j - 1, 1) 
                )
                   $d[$i][$j] = min(
                                    $d[$i][$j],
                                    $d[$i - 2][$j - 2] + $cost          // transposition
                                 );
            }
 
        }
        //return $d[$lenStr1][$lenStr2];
     
        if ($lenStr1 == 0 && $lenStr2 == 0)
            return 100;
 
        $distance = $d[$lenStr1][$lenStr2];
        $similarity = 100 - (int)round(200 * $distance / ($lenStr1 + $lenStr2));
        return $similarity >= 100 ? 100 : $similarity;
    }
}

?>