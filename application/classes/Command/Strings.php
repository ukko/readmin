<?php
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
