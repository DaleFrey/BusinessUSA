<?php /*
    The purpose of this script is to force redirect the user off from http:// to https:// when accessing any 
    URL-path of /admin~   /user  or  /node/~/edit
    This is done for security purposes, and will enforce with CGI's IP block (that only seems to effect https://).
*/

if ( version_awareness_environment_isproduction() ) { // If the user is the Origin/Production server
    
    if ( empty($_SERVER['HTTPS']) ) { // If the use is accessing this server over insecure http:// (not secure https://)
        
        if (
            substr($_SERVER['REQUEST_URI'], 0, 6) === '/admin'
            || substr($_SERVER['REQUEST_URI'], 0, 5) === '/user'
            || ( substr($_SERVER['REQUEST_URI'], 0, 5) === '/node' && strpos($_SERVER['REQUEST_URI'], '/edit') !== false )
        ) { // If the user is accessing the URL-path of:  /admin~   /user  or  /node/~/edit
            
            // Clear the output buffer
            @ob_end_clean();
            while (@ob_end_clean());
            
            // Redirect
            $redirectToURL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header('Location: ' . $redirectToURL);
            error_log("Security-ForceSSL.php - Force redirecting the user to secure HTTPS ({$redirectToURL}). Coder Bookmark: CB-IXE0TO1-BC");
            header('Content-type: text/html; charset=utf-8');
            print "
                <script>
                    /* Security-ForceSSL.php - Force redirecting the user to secure HTTPS  */
                    /* Coder Bookmark: CB-4E0PU3G-BC */
                    document.location = '{$redirectToURL}';
                </script>
            ";
            exit();
            
        }
        
    }
    
}
