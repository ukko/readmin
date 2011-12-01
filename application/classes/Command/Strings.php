<?php
/**
 * Copyright (c) 2011 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
class Command_Strings
{
	public function get( $key )
	{
        $data = array(
                        'key'   => $key,
                        'value' => R::factory()->get( $key ),
                        'cmd'   => 'GET ' . $key,
                    );
        return View::factory('tables/get', $data);


	}
}
