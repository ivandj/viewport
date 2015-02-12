<?php


// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    if (!isset($_SESSION['vp']) || $_REQUEST['refresh'] == 'yes')
    {
            $ua = $_SERVER['HTTP_USER_AGENT'];
            $ual = strtolower($ua);

            $uaX = array();

        //  browser ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

            if (stristr($ual, 'chrome'))    $uaX['browser'] = 'chrome';
            if (stristr($ual, 'firefox'))   $uaX['browser'] = 'firefox';
            if (stristr($ual, 'ie') || stristr($ual, 'trident')) {
                $uaX['browser'] = 'ie';
            }

        //  os ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

            if (stristr($ual, 'windows'))   $uaX['os'] = 'win';
            if (stristr($ual, 'macintosh') || stristr($ual, 'os x'))
            {
                $uaX['os'] = 'os';
            }
            if (stristr($ual, 'linux') || stristr($ual, 'openbsd'))
            {
                $uaX['os'] = 'nix';
            }
            if (stristr($ual, 'android'))   $uaX['os'] = 'droid';

        //  device/os ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

            if (stristr($ual, 'iphone') || stristr($ual, 'ipad'))
            {
                $uaX['os'] = 'ios';
            }

            if (stristr($ual, 'iphone'))    $uaX['device'] = 'iphone';
            if (stristr($ual, 'ipad'))      $uaX['device'] = 'ipad';

        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

            $_SESSION['vp'] = $uaX;

            ?>

            <script>

            // width and height ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                var w = window.innerWidth;
                var h = window.innerHeight;


            // orientation ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                var o = 'l';

                if(h > w){
                    o = 'p';
                }

            // pixel ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                var p = window.devicePixelRatio;

            // retina ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                app = function(){
                    var mediaQuery = "(-webkit-min-device-pixel-ratio: 1.5),\
                            (min--moz-device-pixel-ratio: 1.5),\
                            (-o-min-device-pixel-ratio: 3/2),\
                            (min-resolution: 1.5dppx)";
                    if (window.devicePixelRatio > 1)
                        return 'yes';
                    if (window.matchMedia && window.matchMedia(mediaQuery).matches)
                        return 'yes';
                    return 'no';
                }();

                var r = app;

            // redirect ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

                var newURL = '?w='+w+'&h='+h+'&o='+o+'&r='+r+'&p='+p;
                location.replace(newURL);

            </script>


            <?php

            unset($_SESSION['run1']);

    } elseif (!isset($_SESSION['run1'])) {
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $_SESSION['run1'] = 'yes';
        $_SESSION['vp']['width'] = $_REQUEST['w'];
        $_SESSION['vp']['height'] = $_REQUEST['h'];
        $_SESSION['vp']['orientation'] = $_REQUEST['o'];
        $_SESSION['vp']['retina'] = $_REQUEST['r'];
        $_SESSION['vp']['pixelRatio'] = $_REQUEST['p'];

        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $nURL = 'Location: '.substr($url, 0, strpos($url, '?'));

        header($nURL);

    } else {

    }


?>