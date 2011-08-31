/**
 *
 */
var commands = [];

$(document).ready(function ()
{
    var History = window.History;

    setIcon('start');
    $('#command').focus();

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

    History.Adapter.bind( window, 'statechange', function(){
        var State = History.getState();
        loadData(State.url);
    });

    $('#execute').button().click(function()
    {
        var href    = window.location.protocol + '//' + window.location.host + '/?db=' + $( '#database' ).val() + '&cmd=' + $( '#command' ).val().replace(' ', '+');
        var title   = 'Re:admin "' + $('#command').val() + '"';
        var state   = { url: href, title: title };

        History.pushState( state, title, href);
        return false;
    });


    $('a.cmd').live('click', function()
    {
        var href    = $(this).attr('href');
        var title   = 'Re:admin "' + $('#command').val() + '"';

        History.pushState( {'url': href, 'title': title }, title, href);
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

