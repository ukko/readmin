/**
 *
 */
var commands = [];

$(document).ready(function ()
{
    setIcon('start');

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

    $('#execute').button().click(function()
    {
        var href = $(this).attr('href');
        var params = {
                        'cmd'   : $('#command').val(),
                        'db'    : $('#database').val(),
                        'page'  : 1
                    };
        loadData( href, params );
        History.pushState({state: href }, 'Re:admin ' + $('#command').val(), href);
        return false;
    });


    $('a.cmd').live('click', function()
    {
        var href = $(this).attr('href');
        loadData( href, {});
        History.pushState({state: href }, 'Re:admin ' + $('#command').val(), href);
        return false;
    });

    $('#icon').click(function()
    {
        setIcon('loader');
        $.post(
                '/bookmark/',
                {
                    'command': $('#command').val()
                },
                function(data)
                {
                    if (data.success = 'del') {
                        setIcon('bookmark_del');
                    }
                    else
                    {
                        setIcon('bookmark_add');
                    }
                },
                'json'
        );
    });

    // ------ FUNCTION -------

    function addHistory(type, command, hint)
    {

    }

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

//                $("#command").flushCache();

                if ( data.command.length > 0) {
                    $('#command').val( data.command );
                    $('title').text( 'Re:admin ' + data.command );
                }
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
        $('#icon').attr('src', '/i/32x32/actions/document-new.png');

        if (icon == 'loader')
        {
            $('#icon').attr('src', '/i/ajax-loader.gif');
        }
        else if ( icon == 'bookmark_add' )
        {
            $('#icon').attr('src', '/i/32x32/actions/bookmark_add.png');
        }
        else if ( icon == 'bookmark_del' )
        {
            $('#icon').attr('src', '/i/32x32/actions/document-new.png');
        }
    }
});


