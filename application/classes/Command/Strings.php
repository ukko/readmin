<?php
class Command_Strings 
{
	public function get( $key )
	{
		return R::factory()->get( $key );
	}
}
