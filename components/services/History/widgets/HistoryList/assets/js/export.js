jQuery(function ($) {

});

$(document).ready(function() {
    let checkFile = null;
    $('.export').on('click', function(e) {
        e.preventDefault();
        let t = $(this);
        t.attr('disabled', true);
        $('.loading').show();

        $.ajax({
            'method': 'POST',
            'url': t.attr('href'),
            'success': function(data) {
                if (data) {
                    let url = data.url;
                    let fileName = data.fileName;
                    $('.download-file a').attr('href', url);
                    checkFile = setInterval(function() {
                        $.ajax({
                            'method': 'GET',
                            'url': $('.download-file').data('link'),
                            'data': {'fileName': fileName},
                            'success': function(check) {
                                if (check) {
                                    t.attr('disabled', false);
                                    $('.loading').hide();
                                    $('.download-file').show();
                                    clearInterval(checkFile);
                                }
                            }
                        });
                    }, 1000);
                }
            }
        })
    });
});