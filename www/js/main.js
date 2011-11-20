/**
 *
 */
var commands = [];

$(document).ready(function ()
{
    var History = window.History;

    $('#command').focus();
    $('.dropdown').dropdown();
    setIcon('empty');

    $('.popup').hover(
        function() {
            $(this).addClass('active').removeClass('noactive');
        },
        function() {
            $(this).removeClass('active').addClass('noactive');
        }
    );

    commands =
    [
        {
            value:  "INFO",
            desc:   "Get information and statistics about the server"
        },
        {
            value: "KEYS pattern*",
            desc:   "Find all keys matching the given pattern"
        },
        {
            value: "GET key",
            desc:   "Get the value of a key"
        },
        {
            value: "HGETALL key",
            desc:   "Get all the fields and values in a hash"
        },
        {
            value:  "SMEMBERS key",
            desc:   "Get all the members in a set"
        },
        {
            value:  "ZRANGE key start stop [WITHSCORES]",
            desc:   "Return a range of members in a sorted set, by index"
        },
        {
            value:  "LRANGE key start stop",
            desc:   "Get a range of elements from a list"
        },
        {
            value:  "DEL key [key ...]",
            desc:   "Delete a key"
        },
    ];

    $( "#command" ).autocomplete({
        minLength: 0,
        source: commands,
        focus: function( event, ui ) {
            $( "#command" ).val( ui.item.value );
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
        .append( "<a>" + item.value + "<br>" + item.desc + "</a>" )
        .appendTo( ul );
    };

    $('#command').keypress(function(e){
        if ( e.which == 13 )
        {
            $('#execute').button().click();
        }
    });

    History.Adapter.bind( window, 'statechange', function()
    {
        var State = History.getState();
        loadData(State.url);
    });

    $('#execute').button().click(function()
    {
        var href    = window.location.protocol + '//' + window.location.host + '/?db=' + $( '#database' ).attr('value') + '&cmd=' + $( '#command' ).val().replace(' ', '+');
        var title   = 'Re:admin "' + $('#command').val() + '"';
        var state   = { url: href, title: title, random: Math.random() };

        History.pushState( state, title, href);
        return false;
    });


    $('a.cmd').live('click', function()
    {
        var href    = $(this).attr('href');
        var title   = 'Re:admin "' + $('#command').val() + '"';

        if ( $(this).hasClass('delete') )
        {
            if ( ! confirm('"' + $(this).attr('title') + '", a you sure?') )
            {
                return false;
            }

        }

        History.pushState( {'url': href, 'title': title }, title, href);
        return false;
    });

    // ------ FUNCTION -------

    /**
     * Ajax load data
     *
     * @param href      String
     * @param params    Get params
     */
    function loadData( href, params )
    {
        setIcon('loader');

        $.get(
            href,
            params,
            function( data )
            {
                setIcon('auto');

                if (data.content && data.content.length > 0)
                {
                    $('div.result').html(data.content);
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
            },
            'json'
        );
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

