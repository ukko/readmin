/**
 *
 */
var commands = [];

$(document).ready(function ()
{
    var History = window.History;


//    $(document).keypress(function(e){
//
//        console.log(e);
//        // Ctrl + / - command
//        if ( e.ctrlKey )
//        {
//
//            alert('asd');
////            $('#command').focus();
//        }
//    });


    $('#command').focus();
    $('.dropdown').dropdown();
    $("a[rel=twipsy]").twipsy({ live: true });

    $('.dropdown-menu a').click(function(){
        $('#database').attr('value', $(this).attr('var-id')).text('Database: ' + $(this).attr('var-id'));
    });

    $.ajaxSetup({ cache: false });

    setIcon('empty');

    $('.popup').live('mouseenter',
        function() {
            $(this).addClass('active').removeClass('noactive');
        });
    $('.popup').live('mouseleave',
        function() {
            $(this).removeClass('active').addClass('noactive');
        }
    );

    $('thead input:checkbox').live('click', function(){
        thch = this;
        $('tbody input:checkbox').each(function(){
            $(this).prop('checked', ! $(this).prop('checked'));
        });
    });

    $('#do_with_checked').live('change', function(){
        if ( $('option:selected', this).val() == 'delete' )
        {
            if ( confirm('Delete selected keys?') )
            {
                var href    = window.location.protocol + '//' + window.location.host;
                var cmd     = '';

                $('tbody input:checked').each(function(){
                    cmd += ' ' + $(this).attr('id');
                });

                if ( cmd != '')
                {
                    params = {
                        db:     $( '#database' ).attr('value'),
                        cmd:    'DEL' + cmd,
                        back:   $('h5').attr('var-cmd')
                    }

                    loadData(href, params);
                }
            }
        }
    });

    commands =
    [
        {
            value:  "INFO",
            desc:   "INFO"
        },
        {
            value:  "KEYS",
            desc:   "KEYS pattern:*"
        },
        {
            value:  "GET",
            desc:   "GET string.key"
        },
        {
            value:  "HGETALL",
            desc:   "HGETALL hash.key"
        },
        {
            value:  "SMEMBERS",
            desc:   "SMEMBERS set.key"
        },
        {
            value:  "ZRANGE",
            desc:   "ZRANGE key start stop [WITHSCORES]"
        },
        {
            value:  "LRANGE",
            desc:   "LRANGE key start stop"
        },
        {
            value:  "DEL",
            desc:   "DEL key [key ...]"
        },
    ];

    $( "#command" ).autocomplete({
        minLength: 0,
        source: commands,
        focus: function( event, ui ) {
            $( "#command" ).val( ui.item.value );
            $( '#desc' ).text(ui.item.desc);
            return false;
        },
        select: function( event, ui ) {
            $( "#command" ).val( ui.item.value );
            return false;
        }
    })
    .data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a var-desc='" + item.desc + "'>" + item.value
//                + "</small><span class='ui-icon ui-icon-clock pull-right'></a>"
                + "<span class='ui-icon ui-icon-star pull-right'></a>"
        )
        .appendTo( ul );
    };

    History.Adapter.bind( window, 'statechange', function()
    {
        var State = History.getState();
        loadData(State.data.url);
    });

    $('#command').keypress(function(e){
        if ( e.which == 13 )
        {
            $('#execute').button().click();
        }
    });

    $('#execute').button().click(function()
    {
        var href    = window.location.protocol + '//' + window.location.host;

        params = {
            db: $( '#database' ).attr('value'),
            cmd: $( '#command' ).val()
        }

        href    = href + '/?' + $.param(params);
        title   = 'Re:admin "' + $('#command').val() + '"';

        History.pushState( {'url': href, 'title': title, random: Math.random() }, title, href);
//        loadData( href + '/?' + $.param(params) );
//        loadData( href, params );
        return false;
    });

    $('a.cmd').live('click', function()
    {
        if ( $(this).hasClass('exec') )
        {
            $('#command').val( $(this).attr('href') ).focus();
            return false;
        }

        var href    = $(this).attr('href');
        var title   = 'Re:admin "' + $('#command').val() + '"';

        if ( $(this).hasClass('delete') )
        {
            if ( ! confirm('"' + $(this).attr('title') + '", a you sure?') )
            {
                return false;
            }
        }

        History.pushState( {'url': href, 'title': title, random: Math.random() }, title, href);
        return false;
    });

    // ------ FUNCTION -------

    /**
     * Ajax load data
     *
     * @param href      String
     * @param params    Get params
     */
    function loadData( href, params, type )
    {
        setIcon('loader');

        if (type==undefined)
        {
            type = "post";
        }


        $.ajax({
            type:       type,
            url:        href,
            data:       params,
            dataType:   "json",
            success: function(data){
                setIcon('auto');

                if (data.content && data.content.length > 0)
                {
                    $('#content').html(data.content);
                }
                if (data.notice && data.notice.length > 0)
                {
                    notice(data.error);
                }
                if (data.error && data.error.length > 0)
                {
                    notice(data.error);
                }

                if ( data.cmd.length > 0) {
                    $('#command').val( data.cmd );
                    $('title').text( 'Re:admin ' + data.cmd );
                }
            }
        });
    }

    /**
     * @param string icon
     */
    function setIcon( icon )
    {
        if (icon == 'loader')
        {
            $('#icon').attr('src', '/i/ajax-loader.gif');
        }
        else
        {
            $('#icon').attr('src', '/i/empty.png');
        }
    }
});

