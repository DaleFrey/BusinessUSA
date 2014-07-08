<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>" xmlns="http://www.w3.org/1999/html">

    <?php
    dsm( $node );

    ?>

<div>
    <?php
        print $node->field_program_detail_desc['und'][0]['value'];
    ?>
</div>

<?php if ( !empty($node->field_program_eligibility['und'][0]['value']) ): ?>
    <div class="field_program_eligibility">
        <label class="lblclass">Eligibility</label>
        <?php print $node->field_program_eligibility['und'][0]['value']; ?>
    </div>
<?php endif; ?>

    <div class="learnmore_column">
        <label class="lblclass">Learn More</label>
        <a href="<?php print $node->field_program_ext_url['und'][0]['url']; ?>"
           class="<?php $node->field_program_ext_url['und'][0]['attributes']['class'] ?>"
                target="_blank"><?php print $node->field_program_ext_url['und'][0]['display_url']; ?></a>
    </div>

    <div class="tags_column">
        <label class="lblclass">Tags</label>
        <?php
            $tagsToShow = array();
            foreach ( $node->field_tagged_terms['und'] as $termInfo ) {
                $tid = $termInfo['tid'];
                $term = taxonomy_term_load( $tid );
                $tagsToShow[] =
                    '<a class="tag-search-link" href="/search/site/%2A?f[0]=bundle:program&f[1]=im_field_tagged_terms:' . $tid . '">'
                    . $term->name
                    . '</a>';
            }
            print implode(', ', $tagsToShow);
        ?>
    </div>


    <!-- The following markup is generated from within the User Tag Submission box /* Coder Bookmark: CB-QH09PNX-BC */ -->


    <?php
    $thisNode = menu_get_object(); // This function loads the node that this landing page is showing\
    $landingPageNodeId = $thisNode->nid;
    ?>

        <div style="clear: both; padding-top: 10px;">
            Do you want to provide suggestions on other tags ? -

            <span id="lblAppropriateyestags" value="Yes" style="cursor: pointer;">
                <a href="javascript: jQuery('#addtags').show(); void(0);">Yes</a>
            </span>

        </div>

<div id="addtags">
    <form action="/sys/suggest-tag-receiver" method="POST" id='tagsform'>

        <input type="hidden" name="nid" value="<?php print $landingPageNodeId; ?>" />
        <input placeholder="Technology, Transfer, Federal" name="tags" type="text" />

        <?php
        require_once('recaptchalib.php');?>

        <script type="text/javascript" src="http://api.recaptcha.net/challenge?k=6LeYk_ASAAAAABG1F5Zo3TWq277NYXpjpvm2ai4q"></script>

        <noscript>
            <iframe src="http://api.recaptcha.net/noscript?k=6LeYk_ASAAAAABG1F5Zo3TWq277NYXpjpvm2ai4q" height="300" width="500" frameborder="0"></iframe><br/>
            <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
            <input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
        </noscript>

        <input type="submit" value="Submit" />
        <input type="button" value="Cancel" onclick="showhidetags(this)"/>

    </form>
</div>

</div>
    <script>
        $('#addtags').hide();

        function showhidetags(param)
        {

            var yesno = "cancel";
            yesno = $(param).text();
            if (yesno.toLowerCase() == 'yes')
            {
                $('#addtags').show();
            }
            else
            {
                $('#addtags').hide();
            }

        }

        $(function() {
            $("#tagsform").submit(function() {
                $.post($(this).attr("action"), $(this).serialize(), function(data) {
                            $.colorbox({html:data});
                        },
                        'html');
                return false;
            });
        });


    </script>







