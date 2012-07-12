/**
 * Copyright (c) 2012 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
$(document).ready(function () {
    var divTextarea = null;

    // On click - edit icon on button
    $('a.textarea').on('click', function () {
        tr = $(this).parents('tr');
        $('div.textarea', tr).dblclick();
        return false;
    });

    // On click div - edit data
    $('div.textarea').live('dblclick', function () {
        if (divTextarea) {
            return false;
        }

        divTextarea = this;
        if ( $(divTextarea).data('load') )
        {
            $.get(
                $(divTextarea).data('load'),
                {
                    rand:Math.random()
                },
                function( e ){
                    loadRawData( e );
                },
                'html'
            );
        }
        else
        {
            loadRawData( $(divTextarea).html() );
        }
    });

    // Cancel edition
    $('div.textarea .cancel').live('click', function () {
        var textarea = $('textarea', $(this).parents('div.textarea'));
        $(textarea).parents('div.textarea').remove();
        $(divTextarea).show('fast');
        divTextarea = null;
    });

    // Save changes
    $('div.textarea .save').live('click', function () {
        var textarea = $('textarea', $(this).parents('div.textarea'));

        $.post(
                $(divTextarea).data('save'),
                {
                    cmd:    $(divTextarea).data('cmd') + $(textarea).val(),
                    back:   $(divTextarea).data('back')
                },
                function (e) {
                    $(divTextarea).text(e);
                    divTextarea = null;
                },
                'html'
        );

        $(textarea).parents('div.textarea').remove();
        $(divTextarea).show('fast');

    });

    // Cancel hotkey (Escape)
    $(document).live('keyup', function (e) {
        if (e.which == 27 && divTextarea != null) {
            $('div.textarea .cancel').click();
        }
    });

    // Load data from serever
    function loadRawData(data)
    {
        console.log(data);
        $(divTextarea).hide().after(
            '<div class="textarea">' +
            '<textarea class="span8 edit"></textarea>' +
            '<div class="pull-right"><input class="btn cancel" type="button" value="Cancel">' +
            '&nbsp;<input class="btn btn-primary save" type="button" value="Save" />' +
            '</div></div>'
        );

        $('textarea.edit').text(data).autogrow().focus();
    }
});
