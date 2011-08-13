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
            command($('input.command').val());
        }
    });

    $('#command').button().click(function(){
        command($('input.command').val());
    });

    $('a.cmd').live('click', function()
    {
        var href = $(this).attr('href');
        loadData( href, {} );
        return false;
    });

    History.Adapter.bind(window, 'statechange', function()
    {
        var State = History.getState();
//        History.log(State.data, State.title, State.url);
        loadData( State.url, {} );
    });

    /**
     * Ajax load data
     *
     * @param href      String
     * @param params    Get params
     */
    function loadData( href, params )
    {
        $('#loader').show();

        if ( params == 'undefined' )
        {
            params = {};
        }

        $.get(
            href,
            params,
            function( data )
            {
                $('#loader').hide();

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

                History.pushState({state: href }, 'Re:admin ' + $('input.command').val(), href);
                $("input.command").flushCache();
                //                commands.push({value: cmd, desc: ""});

            },
            'json'
        );
    }

    function command( cmd )
    {
        $('#loader').show();

        $.get(
            '/command/',
            {
                'cmd' : cmd,
                'db':   $('#database').val(),
                'page': 1,
            },
            function( data )
            {
                $('#loader').hide();
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
                commands.push({value: cmd, desc: ""});
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
});


