<?php

    class History
{
    /**
     * Write command to
     *
     * @param string $user
     * @param string $command
     * @return void
     */
    public static function write( $user = '', $command = '' )
    {
        $key        = Config::get('re_prefix') . 'log:' . sha1( $user );
        $command    = trim( $command );
        return R::factory()->rPush( $key, $command );
    }
}
