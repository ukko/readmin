<?php
/**
 * Helper keys
 */
class Helper_Keys
{

    /**
     * Create anchor for key
     *
     * @param   string  $key
     * @param   string  $type
     * @return  string
     */
    public static function anchorKey( $key, $type )
    {
        $data = array(
            'db' => 0,
        );

        if ($type == 'string')
        {
            $data['cmd'] = 'GET ' . $key;
        }
        elseif ( $type == 'hash' )
        {
            $data['cmd'] = 'HGETALL ' . $key;
        }
        elseif( $type == 'list' )
        {
            $data['cmd'] = 'LRANGE ' . $key . ' 0 -1';
        }
        elseif ( $type == 'set' )
        {
            $data['cmd'] = 'SMEMBERS ' . $key;
        }
        elseif( $type == 'zset' )
        {
            $data['cmd'] = 'ZRANGE ' . $key . ' 0 -1';
        }

        $url = http_build_query($data);
        return '<a href="/?' . $url  . '" class="cmd">' . $key . '</a>';
    }

    public static function anchorAction( $key, $type, $action )
    {
        $db = 0;
        if ( $action == 'delete' )
        {
            return '<a href="/?db='.$db.'&DEL+'.$key.'">Delete</a>';
        }
        return '<a>Edit</a>';
    }

    public static function value( $params )
    {

        list( $size, $value ) = $params;
        return '<span class="preview"> ( ' . (int)$size . ' ) '  . $value . '</span>';
    }
}
