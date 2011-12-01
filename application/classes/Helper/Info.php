<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Helper_Info
{
    /**
     * Returns the number of keys in the database
     *
     * @return array
     */
    public static function getCountKeysInDb()
    {
        $dbkeys = array();
        foreach (R::factory()->info() as $key => $value )
        {
            if (substr($key, 0, 2) == 'db' && ctype_digit( substr($key, 2) ) )
            {
                $str                            = explode(',', $value );
                $str                            = explode('=', $str[0]);
                $dbkeys[ (int)substr($key, 2) ] = $str[1];
            }

        }
        return $dbkeys;
    }
}
