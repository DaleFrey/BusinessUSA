<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sanjay.gupta
 * Date: 3/6/14
 * Time: 11:01 AM
 * To change this template use File | Settings | File Templates.
 */

?>
<a target="_blank" id="fbo-open-link">
    <div class="fboopen-content-container">

        <div class="fboopen-content">
            <div id="fbo-open-results">
                Business and Contract Opportunities in #location related to #industry.

            </div>
        </div>
        <div class="fbo-goImg"><img src="/sites/all/themes/bizusa/images/fbo-go.png" </div>
    </div>
</a>
<!-- <a target="_blank" href="http://business.usa.gov" id="fbo-open-link">
     <img width="171" height="29" src="http://business.usa.gov/sites/all/themes/bususa/external_site_button3.png" alt="Business USA">
 </a>-->


<script>
    $(document).ready(function()
    {


        if ($('#bottom-bizusa-footer').length > 0)
        {

            $('#bottom-bizusa-footer').hide();
        }

        var vars = [], hash;
        var queryParam = [];

        var searchParam = '';
        searchParam = document.URL.split('?')[1];

        if(searchParam != undefined){
            searchParam = searchParam.split('&');
            for(var i = 0; i < searchParam.length; i++){
                hash = searchParam[i].split('=');
                vars.push(hash[1]);
                vars[hash[0]] = hash[1];

                queryParam[i] = hash[1];
            }
        }

        queryParam[0] = getUrlVars()['industry'];
        queryParam[1] = getUrlVars()['location'];
        queryParam[2] = getUrlVars()['op'];

        if (queryParam[2].length > 0)
        {

            if (queryParam[2] == 'and')
            {

                searchParam = queryParam[0] + '+and+' + queryParam[1];
            }
            else
            {


                searchParam = queryParam[0] + '+' + queryParam[1];
            }



        }
        else
        {
          searchParam = '';
        }

        var resulttext = $('#fbo-open-results').text();

        //var src = location.protocol + '//' + document.location.host + '/fboopen-widget/fboopen-search?input=' + searchParam + '&data_source=&naics=&parent_only=&p=';

        //$('#fbo-open-link').attr('href', src);

        //var resulttext = $('#fbo-open-results').text();




        if (queryParam[0].length > 1 && queryParam[1].length == 0)
        {
            resulttext = resulttext.replace(' in #location','');
            resulttext = resulttext.replace('#industry',queryParam[0]);
            searchParam = queryParam[0];

        }
        else if(queryParam[1].length > 1 && queryParam[0].length == 0)
        {

            resulttext = resulttext.replace(' related to #industry','');
            resulttext = resulttext.replace('#location',queryParam[1]);
            searchParam = queryParam[1];

        }
        else
        {

            resulttext = resulttext.replace('#industry',queryParam[0]);
            resulttext = resulttext.replace('#location',queryParam[1]);

            var checkandor = getUrlVars()['op'];
            if (checkandor == 'and')
            {
                searchParam = queryParam[0] + '+and+' + queryParam[1];
            }
            else
            {
                searchParam = queryParam[0] + '+' + queryParam[1];

            }

        }



       /* if (queryParam[0].length > 1 && queryParam[1].length == 0)
        {

            resulttext = resulttext.replace(' in #location','');
            resulttext = resulttext.replace('#industry',queryParam[1]);
            searchParam = queryParam[0];


        }
        else if(queryParam[1].length > 1 && queryParam[0].length == 0)
        {

            resulttext = resulttext.replace(' related to #industry','');
            resulttext = resulttext.replace('#location',queryParam[1]);
            searchParam = queryParam[1];

        }*/



        var src = location.protocol + '//' + document.location.host + '/fboopen-widget/fboopen-search?input=' + searchParam + '&data_source=&naics=&parent_only=&p=';

$('.fboopen-content-container').click(function(){
        window.open(src, '_blank');
     //   location.href = src;
    }

);

        //    $('#fbo-open-link').attr('href', src);


        $('#fbo-open-results').text(resulttext);


    });

    function splitkeyword(fieldtext)
    {
        var finaltext = '';

        if(fieldtext != undefined){
            fieldtext = fieldtext.split('+');
            for(var i = 0; i < fieldtext.length; i++){

                finaltext =  finaltext + ' ' + fieldtext[i];

            }

        }
        return finaltext;
    }


</script>