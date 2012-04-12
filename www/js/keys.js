/**
 * Copyright (c) 2012 Max Kamashev <max.kamashev@gmail.com>
 * Distributed under the GNU GPL v3. For full terms see the file COPYING.
 */
$(document).ready(function () {
    $('thead input:checkbox').live('click', function () {
        thch = this;
        $('tbody input:checkbox').each(function () {
            $(this).prop('checked', !$(this).prop('checked'));
        });
    });
    $('.checked-do .btn-group a').live('click', function () {
        if (confirm('Delete selected keys?')) {
            var href = window.location.protocol + '//' + window.location.host;
            var cmd = '';

            $('tbody input:checked').each(function () {
                cmd += ' ' + $(this).attr('id');
            });

            if (cmd != '') {
                params = {
                    db:$('#database').attr('value'),
                    cmd:'DEL' + cmd,
                    back:$('h5').attr('var-cmd')
                }

                loadData(href, params);
            }
        }
    });

    $(':checkbox').live('click', function () {
        $('.checked-do').show();
    });

    $('#limit').live('change', function () {
        var href = window.location.protocol + '//' + window.location.host;
        params = {
            db:$('#database').attr('value'),
            cmd:$('h5').attr('var-cmd'),
            limit:$(':selected', this).val()
        }

        loadData(href, params);
    });
});
