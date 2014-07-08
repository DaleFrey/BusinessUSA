


<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">



  <?php
    // We hide the comments and links now so that we can render them later.
dsm($node);
  ?>
<?php print $node->field_services_detail_desc['und'][0]['value']; ?>
 <div class="learnmore_column">
    <div class="lblclass">
        Learn More :
    </div>
	<div>
		 <a href="<?php print $node->field_services_ext_url['und'][0]['url']; ?>" ><?php print $node->field_services_ext_url['und'][0]['url']; ?> </a>
    </div>
 </div>
 <div class="contact info">
	<div>
			 <?php

				 $aliasPath = substr($_SERVER['REQUEST_URI'], 1);
				 $sysPath = drupal_lookup_path('source', $aliasPath);
				 $nodeId = explode('/', $sysPath);
				 $nodeId = $nodeId[1];
				 $n = node_load($nodeId);

						   $field_services_org_tht_owns_prog = $n->field_services_org_tht_owns_prog['und'][0]['value'];
						   $logoURL = $field_service_org_tht_owns_prog;
						   $logoURL = str_replace(' ', '_', $logoURL);
						   $logoURL = str_replace('.', '', $logoURL);
						   $field_services_public_poc_name = $n->field_services_public_poc_name['und'][0]['value'];
						   $field_services_public_poc_org = $n->field_services_public_poc_org['und'][0]['value'];
						   $field_services_public_poc_email = $n->field_services_public_poc_email['und'][0]['value'];
						   $field_services_public_poc_phone = $n->field_services_public_poc_phone['und'][0]['value'];
						   $ctype = $n->type;
						   $imgAttrib = "";
							if ( empty($logoURL) || $logoURL == '' || $logoURL == false ) {
						   $imgAttrib = 'style="display: none;" ';
							}
						   $html = "
										  <div class=\"contact-information-prefix\">
														<h2>Contact Information</h2>
														<span>For more information on this program, contact</span>
														<span class=\"field-field_services_org_tht_owns_prog\">$field_services_org_tht_owns_prog</span>
										  </div>
										  <div class=\"contact-information-container nodetype-$ctype\">
														<div class=\"logo\"><img $imgAttrib src=\"/sites/all/themes/bususa/images/agencylogos/$logoURL.jpg\" /></div>
														 <div class=\"field-field_services_org_tht_owns_prog\">$field_services_org_tht_owns_prog</div>
														 <div class=\"field-field_services_public_poc_name\">$field_services_public_poc_name</div>
														 <div class=\"field-field_services_public_poc_org\">$field_services_public_poc_org</div>
							";

							if ( !empty($field_services_public_poc_email) ) {
								$html .= "
									<div class=\"field-field_services_public_poc_email\">
										<a href=\"mailto:$field_services_public_poc_email\" target=\"_blank\">$field_services_public_poc_email</a>
									</div>
								";
							}

							$html .= "<div class=\"field-field_services_public_poc_phone\">$field_services_public_poc_phone</div>
							  </div>
						   ";

						   print $html;

			?>
</div>
 </div>

    <div class="tags_column">
        <label class="lblclass">Tags</label>
        <?php
        $tagsToShow = array();
        foreach ( $node->field_tagged_terms['und'] as $termInfo ) {
            $tid = $termInfo['tid'];
            $term = taxonomy_term_load( $tid );
            $tagsToShow[] = '<a class="tag-search-link" href="/search/site/%2A?f[0]=bundle:services&f[1]=im_field_tagged_terms:' . $tid . '">'
                . $term->name
                . '</a>';
        }
        print implode(', ', $tagsToShow);
        ?>
    </div>
</div> <!-- /node

<?php print render($content['comments']); ?> -->



<?php
$thisNode = menu_get_object(); // This function loads the node that this landing page is showing\
$landingPageNodeId = $thisNode->nid;
?>
<div>
    Do you want to provide suggestions on other tags ? - <span id="lblAppropriateyestags" value="Yes" onclick="showhidetags(this)"><a>Yes</a></span>
</div>
<div id="addtags">
    <form action="/sys/suggest-tag-receiver" method="POST" id='tagsform'>

        <input type="hidden" name="nid" value="<?php print $landingPageNodeId; ?>" />
        <input placeholder="Technology, Transfer, Federal" name="tags" type="text" />

        <?php
          include_once(overridable('sites/all/themes/bizusa/templates/recaptchalib.php'));
        ?>

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
