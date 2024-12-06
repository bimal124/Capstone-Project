$(document).ready(function () {
    $.ajaxSetup({cache: true});

    //initializing facebook share
    $.getScript('//connect.facebook.net/en_US/sdk.js', function () {
        FB.init({
            appId: fbappid,
            version: 'v2.10' // or v2.1, v2.2, v2.3, ...
        });
    });
    $(document).on('click', '.fb-share-btn', function (e) {
        console.log('test');
        FB.ui({
            method: 'share',
            href: share_url,
            scope: 'publish_actions',
            return_scopes: true
        }, function (response) {

            console.log(response);

        });
        e.preventDefault();
    })
    $(document).on('click', '.gl-share-btn', function (e) {
        e.preventDefault();
        var text = $('meta[property="og:description"]').attr('content');
        if(text == 'undefined'){
            text = '';
        }
        var url = "https://plus.google.com/share?url=" + encodeURIComponent(share_url) + '&text=' + encodeURIComponent(text);
        console.log(url);
        window.open(url, "myWindow", "status = 1, height = 400, width = 300, resizable = 0");
    })
    $(document).on('click', '.tweet-share-btn', function (e) {
        e.preventDefault();
        
        var text = $('meta[property="og:description"]').attr('content');
        if(text == 'undefined'){
            text = '';
        }
        
        window.open('http://twitter.com/share?url=' + encodeURIComponent(share_url) + '&text=' + encodeURIComponent(text), '', 'left=0,top=0,width=550,height=450,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
    })

});