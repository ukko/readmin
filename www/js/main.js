/**
 * Copyright (c) 2012 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
$(document).ready(function ()
{
    var History = window.History;

    $(document).keypress(function(e)
    {
        if ( $(':input').is(':focus'))
        {
            // do nothing
        }
        // Bind on keypress A-Za-z
        else if( ( e.which >= 64 && e.which <= 90 ) || ( e.which >= 97 && e.which <= 122 ) )
        {
            $(window).scrollTop();
            $('#command').val('').focus();
        }
    });

    $('#command').focus();

    $('.dropdown-toggle').dropdown();

    $("a[rel=twipsy]").tooltip({ live: true });

    $('.dropdown-menu.database a').click(function(){
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
                + "<span class='ui-icon ui-icon-empty pull-right'><i class='icon-repeat'></i></span></a>"
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
            db:     $( '#database' ).attr('value'),
            cmd:    $( '#command' ).val(),
            back:   $('h5').attr('var-cmd')
        }

        href    = href + '/?' + $.param(params);
        title   = $('#command').val() + ' — Re:admin';

        History.pushState( {'url': href, 'title': title, random: Math.random() }, title, href);
        return false;
    });

    $('a.cmd').live('click', function()
    {
        if ( $(this).attr('href') == '' )
        {
            return false;
        }

        if ( $(this).hasClass('exec') )
        {
            $('#command').val( $(this).attr('href') ).focus();
            return false;
        }

        var href    = $(this).attr('href');
        var title   = $('#command').val() + ' — Re:admin';

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
                $('#command').val( data.cmd )
                             .autocomplete('option', 'source', data.history);
                $('title').text( data.cmd + ' — Re:admin' );
            }
        },
        statusCode: {
            401: function() {
                window.location = '/';
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
