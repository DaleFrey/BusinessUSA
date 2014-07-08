function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

(function ($) {
	$(document).ready(function(){
    var zipcode = getUrlVars()["zip"];
    $('.auto-fill-zip-code').val(zipcode);

    var wizvar  = getUrlVars()["wiz"];

    $('.resourcecenters-filter-container').click();
    $('#edit-submit-closes-resource-center-retheme').click();

    /******************************
     ***   DESKTOP RESOLUTION   ****
     ******************************/
    if(windowWidth > 1024 || $('body').hasClass('ie8')){

    }
	});
})(jQuery);
