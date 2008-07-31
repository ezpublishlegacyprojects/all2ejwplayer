<?php

class all2eJwPlayerClass
{
    function all2eJwPlayerClass()
    {}

    function createLightboxUrl( $url, $class )
    {
        $settings = all2eJwPlayerClass::getSettingsFromClass($class);
        $returnUrl = 'JWPlayer.play("'.$url.'", "'.$settings['source'].'", {width: "'.$settings['width'].'",height:"'.$settings['height'].'",autostart:"'.$settings['autostart'].'",fullscreen:"'.$settings['fullscreen'].'",skin:"'.$settings['skin'].'",bgcolor:"'.$settings['bgcolor'].'"})';
        return $returnUrl;
    }
    
    function createInlineUrl( $url, $class )
    {
        $settings = all2eJwPlayerClass::getSettingsFromClass($class);
        $returnUrl = "<embed width='".$settings['width']."' height='".$settings['height']."' flashvars='&skin=".$settings['skin']."&file=".$url."&autostart=".$settings['autostart']."&fullscreen=".$settings['fullscreen']."' allowfullscreen='".$settings['fullscreen']."' allowscriptaccess='always' quality='high' bgcolor='".$settings['bgcolor']."' name='plb_mpl' style='' src='".$settings['source']."' type='application/x-shockwave-flash'/>";
        return $returnUrl;
    }
    
    function getSettingsFromClass( $class = "Standard" )
    {
        $settings               = array();
        $ini                    = eZINI::instance( "all2ejwplayerclasses.ini" );                          
        $settings['width']      = $ini->variable( $class, "Width" );
        $settings['height']     = $ini->variable( $class, "Height" );
        $settings['autostart']  = $ini->variable( $class, "Autostart" );
        $settings['source']     = $ini->variable( $class, "Source" );
        $settings['fullscreen'] = $ini->variable( $class, "Fullscreen" );
        $settings['skin']       = $ini->variable( $class, "Skin" );
        $settings['bgcolor']    = $ini->variable( $class, "BgColor" );

        /*
        $displayclick           = $ini->variable( "Standard", "Displayclick" );
        $mute                   = $ini->variable( "Standard", "Mute" );
        $repeat                 = $ini->variable( "Standard", "Repeat" );
        $shuffle                = $ini->variable( "Standard", "Shuffle" );
        */

        // var so = new SWFObject('http://www.jeroenwijering.com/embed/player.swf','mpl','200','200','9');
        // so.addParam('allowscriptaccess','always');
        // so.addParam('allowfullscreen','true');
        // so.addParam('flashvars','&file=/upload/flash.flv&autostart=true&displayclick=fullscreen&fullscreen=true&mute=true&repeat=true&shuffle=true');
        // so.write('player');
        

        //$returnUrl = 'JWPlayer.play("'.$url.'", "'.$source.'", {width: "'.$width.'",height:"'.$height.'",autostart:"'.$autostart.'",fullscreen:"'.$fullscreen.'",skin:"'.$skin.'",bgcolor:"'.$bgcolor.'"})';
        return $settings;
    }
}

?>
