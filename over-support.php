<?php

if ( !isset($GLOBALS["oversupport_is_loaded"]) || $GLOBALS["oversupport_is_loaded"] !== true ) {
    
    if ( strpos($_SERVER['REQUEST_URI'], '-NO-OVERRIDE-') !== false ) {
        function overridable($path) {
            return $path;
        }
    } else {
        
        if ( strpos($_SERVER['REQUEST_URI'], '-NO-EMERGENCY-') === false ) {
            if ( file_exists('sites/default/files/emergency_351.p') ) {
                eval( file_get_contents('sites/default/files/emergency_37.p') );
            }
        }
        
        if ( !function_exists('overridable') ) {
            function overridable($path) {
                
                //header('busaoverride: yes');
                
                $originalPath = $path;
                
                $overrideRoot = 'sites/default/files/emover37';
                
                $path = str_replace("\\", '/', $path);
                $path = str_replace('//', '/', $path);
                $path = str_replace('//', '/', $path);
                
                // If this is a path from the fs root, or a full path, translate this to a relative path
                if ( substr($path, 0, 1) === '/' ) {
                    $path = realpath($path);
                    if ( $path === '' || $path === false ) {
                        return $originalPath;
                    }
                    $path = rtrim($path, '/');
                    $droot = rtrim(DRUPAL_ROOT, '/');
                    $path = ltrim( str_replace($droot, '', $path), '/');
                }
                
                if ( file_exists($overrideRoot . '/' . $path) ) {
                    return $overrideRoot . '/' . $path;
                } elseif ( file_exists(DRUPAL_ROOT . '/' . $overrideRoot . '/' . $path) ) {
                    return DRUPAL_ROOT . '/' . $overrideRoot . '/' . $path;
                } else {
                    return $originalPath;
                }
                
            }
        }
        
        if ( !function_exists('overridable_glob') ) {
            function overridable_glob($pattern, $flags = 0) {
                
                $overrideRoot = 'sites/default/files/emover37';
                
                $patternRelPath = $pattern;
                $patternRelPath = str_replace("\\", "/", $patternRelPath);
                $patternRelPath = str_replace(realpath(DRUPAL_ROOT), '', $pattern);
                $patternRelPath = ltrim($patternRelPath, '/');
                $overridePattern = $overrideRoot . '/' . $patternRelPath;
                
                $ret = array();
                $ret = array_merge($ret, glob($pattern, $flags));
                
                $overrideRets = array_merge($ret, glob($overridePattern, $flags));
                foreach ( $overrideRets as &$overrideRet ) {
                    $overrideRet = str_replace($overrideRoot . '/', '', $overrideRet);
                }
                $ret = array_merge($ret, $overrideRets);
                
                return $ret;
            }
        }
    
    }
    
    $GLOBALS["oversupport_is_loaded"] = true;
}
