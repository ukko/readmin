/**
 *
 */
var commands = [];

$(document).ready(function ()
{
    var History = window.History;
    if ( ! History.enabled ) {
        return false;
    }

    History.Adapter.bind(window, 'statechange', function()
    {
        var State = History.getState();
        History.log(State.data, State.title, State.url);
        loadData( State.url, {} );
    });

    commands = [
    {
        value: "INFO",
        desc: "Get information and statistics about the server",
    },
    {
        value: "KEYS *",
        desc: "Find all keys matching the given pattern",
    },
    ];

    $( "input.command" ).autocomplete({
        minLength: 0,
        source: commands,
        focus: function( event, ui ) {
            $( "inut.command" ).val( ui.item.value );
            return false;
        },
        select: function( event, ui ) {
            $( "input.command" ).val( ui.item.value );
            return false;
        }
    })
    .data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a>" + item.value + "<br>" + item.desc + "</a>" )
        .appendTo( ul );
    };

    $('input.command').keypress(function(e){
        if ( e.which == 13 )
        {
            $('#command').button().click();
        }
    });

    $('#command').button().click(function()
    {
        var href = $(this).attr('href');
        var params = {
                        'cmd'   : $('input.command').val(),
                        'db'    : $('#database').val(),
                        'page'  : 1
                    };

        loadData( href, params );
        History.pushState({state: href }, 'Re:admin ' + $('input.command').val(), href);
        return false;
    });


    $('a.cmd').live('click', function()
    {
        var href = $(this).attr('href');
        loadData( href, {});
        History.pushState({state: href }, 'Re:admin ' + $('input.command').val(), href);
        return false;
    });

    $('#icon').click(function()
    {
        setIcon('bookmark_add');
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

        if ( params == 'undefined' )
        {
            params = {};
        }

        $.get(
            href,
            params,
            function( data )
            {
                setIcon('auto');

                if (data.table && data.table.length > 0)
                {
                    $('div.result').html(data.table);
                }
                if (data.notice && data.notice.length > 0)
                {
                    notice(data.error);
                }
                if (data.error && data.error.length > 0)
                {
                    notice(data.error);
                }

                $("input.command").flushCache();
            },
            'json'
        );
    }

    function notice (text)
    {
        html = '<p><span style="float: left; margin-right: .3em; vertical-align:'
             + 'middle;" class="ui-icon ui-icon-info"></span>' + text + '</p>';
        $('div.message').html(html);
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
        else if ( icon =='auto' )
        {
            $('#icon').attr('src', '/i/32x32/emblems/emblem-new.png');
        }
        else if ( icon == 'bookmark_add' )
        {
            $('#icon').attr('src', '/i/32x32/actions/bookmark_add.png');
        }
        else if ( icon == 'bookmark_add' )
        {

        }
    }
});


