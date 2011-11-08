<?php
/**
 * Helper keys
 */
class Helper_Keys
{
    public static function getType( $key )
    {
        $types = array(
            0 => 'not_found',
            1 => 'string',
            2 => 'set',
            3 => 'list',
            4 => 'zset',
            5 => 'hash',
        );

        $type = (int) R::factory()->type( $key );

        if ( $type >= 0 && $type <= 5 )
        {
            return $types[ $type ];
        }
        else
        {
            return $types[0];
        }
    }

    public static function getValue( $key, $type )
    {
        $size   = 0;
        $value  = ' ';
        $max    = 120;

        if ( $type == 'string' )
        {
            $size   = R::factory()->strlen( $key );
            $value  = R::factory()->getRange( $key, 0, $max );

            if (strlen($value) > $size)
            {
                $value .= '..';
            }
        }
        elseif ( $type == 'set' )
        {
            $size = R::factory()->sCard( $key );
            $value = '';
            foreach ( R::factory()->sMembers( $key ) as $member )
            {
                if ( strlen( $value ) < ($max - 5) )
                {
                    if ( ! empty($value) )
                    {
                        $value .= ', ';
                    }
                    $value .= $member;
                } else {
                    $value .= ', ..';
                    break;
                }
            }
            $value = '[ ' . $value . ' ]';
        }
        elseif ( $type == 'zset' )
        {
            $size = R::factory()->zCard( $key );
            $value = '';
            foreach ( R::factory()->zRange( $key, 0, 100, true ) as $score => $item )
            {
                if ( strlen( $value ) < ($max - 5) )
                {
                    if ( ! empty($value) )
                    {
                        $value .= ', ';
                    }

                    $value .= $score . ':' .  $item;

                } else {
                    $value .= ', ..';
                    break;
                }
            }
            $value = '[ ' . $value . ' ]';
        }
        elseif ( $type == 'list' )
        {
            $size = R::factory()->lSize( $key );
            $value = '';
            foreach ( R::factory()->lRange( $key, 0, 100 ) as $item )
            {
                if ( strlen( $value ) < ($max - 5) )
                {
                    if ( ! empty($value) )
                    {
                        $value .= ', ';
                    }
                    $value .= $item;
                } else {
                    $value .= ', ..';
                    break;
                }
            }
            $value = '[ ' . $value . ' ]';
        }
        elseif ( $type == 'hash' )
        {
            $size = R::factory()->hLen( $key );
            $value = '';
            foreach ( R::factory()->hKeys( $key ) as $item )
            {
                if ( strlen( $value ) < ($max - 5) )
                {
                    if ( ! empty($value) )
                    {
                        $value .= ', ';
                    }
                    $value .= $item;
                } else {
                    $value .= ', ..';
                    break;
                }
            }
            $value = '[ ' . $value . ' ]';
        }

        return array($size, $value);
    }


    /**
     * Create anchor for key
     *
     * @param   string  $key
     * @param   string  $type
     * @param   string  $db
     * @return  string
     */
    public static function anchorKey( $key, $type, $db )
    {
        $data = array(
            'db' => $db,
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
        if ( $action == 'delete' )
        {
            $params = array(
                'db'    => Request::factory()->getDb(),
                'cmd'   => 'DEL ' . urlencode( $key ),
                'back'  => Request::factory()->getBack(),
            );

            $url = 'http://' . Request::factory()->getServerName() . '/?' . http_build_query( $params );

            return '<a class="cmd delete" href="' . $url . '" title="DEL ' . $key . '">Delete</a>';
        }
    }

    public static function value( $params )
    {

        list( $size, $value ) = $params;
        return '<span class="preview"> ( ' . (int)$size . ' ) '  . $value . '</span>';
    }
}
