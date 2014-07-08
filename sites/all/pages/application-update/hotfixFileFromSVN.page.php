<?php 

    /**  bool hotfixFileFromSVN(string svnFileUR$L)
      *  
      *  Grabs the file from the target URL, and places it in the nessesary 
      *  location under sites/default/files/
      *
      *  Expects a URL like: 
      *  http://svn.code.sf.net/p/businessusa/code/trunk/webapp/sites/all/pages/tour.page.php
      */
    if ( !function_exists('hotfixFileFromSVN') ) {
        function hotfixFileFromSVN($svnFileURL) {
            
            $expectedBase = 'http://svn.code.sf.net/p/businessusa/code/trunk/webapp/';
            
            if ( substr($svnFileURL, 0, strlen($expectedBase)) !== $expectedBase ) {
                error_log(__FUNCTION__ . ' shall return false since the given target-URL does nto start with ' . $expectedBase);
                return false;
            }
            
            $infoURL = parse_url($svnFileURL);
            $infoPath = pathinfo($infoURL['path']);
            
            $data = file_get_contents($svnFileURL);
            if ( $data !== false ) {
                print 'Downloaded ' . strlen($data) . ' bytes of data from ' . $svnFileURL . '<br/>';
            } else {
                print 'Failed to download from ' . $svnFileURL . '<br/>';
                return false;
            }
            
            $createDirPath = 'sites/default/files/emover/' . str_replace('/p/businessusa/code/trunk/webapp/', '', $infoPath['dirname']);
            @mkdir($createDirPath, 0777, true);
            if ( is_dir($createDirPath) ) {
                print "Created directory {$createDirPath} successfully!<br/>";
            } else {
                print "<b>Failed creating directory {$createDirPath}</b><br/>";
                return false;
            }
            
            $filePath = $createDirPath . '/' . $infoPath['basename'];
            $bytesWritten = file_put_contents($filePath, $data);
            if ( is_file($filePath) ) {
                print "Wrote {$bytesWritten} bytes to {$filePath}<br/>";
            } else {
                print "<b>Failed writing to file {$filePath}</b><br/>";
                return false;
            }
            
            return true;
        }
    }
    
    
    if ( !empty($_GET['url']) ) {
        
        @ob_end_clean();
        @ob_end_clean();
        @ob_end_clean();
        @ob_end_clean();
        $url = $_GET['url'];
        $rslt = hotfixFileFromSVN($url);
        var_dump( $rslt );
        exit();
        
    } else {
        
        print 'MIssing <i>url</i> parameter.';
        
    }