$(document).ready(function() {
    var WI = $('#instagram-grid');
    var inst = WI.attr('data-instagram');

    $.ajax({
        dataType: "json",
        url: App.config.url + '/instagramApi/'+inst,
        success: function (data) {
            for (i in data) {
                var post = data[i];

                $('a.item', WI).eq(i).attr('href', post.link).addClass('active');
                $('.item-img', WI).eq(i).attr('src', post.thumbnailSrc);
            }
        }
    });
});