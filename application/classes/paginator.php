<?php

class Paginator
{
    /**
     * Выводит пагинатор
     *
     * @param int       $total
     * @param int       $current
     * @param string    $url
     * @param int       $limit
     * @return string
     */
    public static function parsePaginator($total, $current, $url, $limit = 10)
    {
        $total      = (int)abs($total);
        $current    = (int)abs($current);
        $limit      = (int)abs($limit);

        $total = ceil($total / $limit);

        if ($total <= 1)
        {
            return '';
        }

        if ($current > $total)
        {
            $current = $total;
        }

        $start = 1;

        if ($current == 1)
        {
            $start  = 1;
        }
        elseif($current)
        {
            // 1 2 3 4 '5 6 7 8 9 10
            if ($current - ceil($limit / 2) <= 1)
            {
                $start = 1;
            }
            elseif ($current + ceil($limit / 2) > $total)
            {
                if ( ($total - $limit) > 1) {
                    $start = $total - $limit;
                } else {
                    $start = 1;
                }
            }
            else
            {
                $start = $current - ceil($limit / 2);
            }
        }

        $end    = (($start + $limit) < $total) ? ($start + $limit) : $total;

        $pages = array();
        for($i = $start; $i <= $end; $i++)
        {
            $pages[] = array(
                'url'       => str_replace(':id:', $i, $url),
                'active'    => (($i == $current) ? '+': NULL),
                'number'    => $i,
            );
        }

        $prevURL = $nextURL = '';

        if ($current > 1)
        {
            $prevURL = str_replace(':id:', ($current - 1), $url);
        }

        if($current < $total)
        {
            $nextURL = str_replace(':id:', ($current+1), $url);
        }

        $data = array(
            'pages'     => $pages,
            'total'     => $total,
            'totalURL'  => str_replace(':id:', $total, $url),
            'prevURL'   => $prevURL,
            'nextURL'   => $nextURL,
        );

        return View::factory('paginator', $data);
    }
}
