<?php /*

    @TODO: Write coments and dev-notes
    
    [--] FILES [--]
    my-usa-callback/.page.inc   - Executed first, contain function declarations, and variable setup
    my-usa-callback/.page.php  - Executed/Rendered after .page.inc
    
*/ ?>

<?php if ( $token === false ): ?>

    <h1>
        Oops, something went wrong.
    </h1>
    <div>
        An error occurred while authenticating your MyUSA account. Please 
        <a href="/user-dashboard/my-usa-login">
            try again
        </a>.
        If this issue persists, please 
        <a href="http://help.businessusa.gov/ics/support/ticketnewwizard.asp?style=classic&feedback=true">
            let us know
        </a>.
    </div>
    
<?php else: ?>
    
    <!-- Access Token is: <?php print $token; ?> -->
    <script>
        createCookie('myusa_drupal_userid', <?php print $drupalUserId; ?>, 30);
        document.location = '<?php print $redirectTo; ?>';
    </script>
    
<?php endif; ?>