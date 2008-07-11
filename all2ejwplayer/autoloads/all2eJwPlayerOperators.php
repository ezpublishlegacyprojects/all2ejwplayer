<?php

class all2eJwPlayerOperators
{
    /*!
     Constructor
    */
    function all2eJwPlayerOperators()
    {
        $this->Operators = array('jwplayer');
    }

    /*!
     Returns the operators in this class.
    */
    function &operatorList()
    {
        return $this->Operators;
    }

    /*!
     \return true to tell the template engine that the parameter list
    exists per operator type, this is needed for operator classes
    that have multiple operators.
    */
    function namedParameterPerOperator()
    {
        return true;
    }

    /*!
     The first operator has two parameters, the other has none.
     See eZTemplateOperator::namedParameterList()
    */
    function namedParameterList()
    {
        return array(                      
                      'jwplayer' => array('url' => array( 'type' => 'string',
                                                              'required' => true,
                                                              'default' => '' ),
                                           'playerclass' => array(
                                                              'type' => 'string',
                                                              'required' => false,
                                                              'default' => 'standard' )
                                            ) );
    }

    /*!
     Executes the needed operator(s).
     Checks operator names, and calls the appropriate functions.
    */
    function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace,
                     &$currentNamespace, &$operatorValue, &$namedParameters )
    {
        switch ( $operatorName )
        {
            case 'jwplayer':
            {
                $operatorValue = $this->jwplayer( $namedParameters['url']);
            } break;
        }
    }

    function jwplayer( $url )
    { 
        $ini                    = eZINI::instance( "all2ejwplayerclasses.ini" );                          
        $width                  = $ini->variable( "Standard", "Width" );
        $height                 = $ini->variable( "Standard", "Height" );
        $autostart              = $ini->variable( "Standard", "Autostart" );
        $source                 = $ini->variable( "Standard", "Source" );
        $fullscreen             = $ini->variable( "Standard", "Fullscreen" );
        $skin                   = $ini->variable( "Standard", "Skin" );
        $bgcolor                = $ini->variable( "Standard", "BgColor" );

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
        

        $returnUrl = 'JWPlayer.play("'.$url.'", "'.$source.'", {width: "'.$width.'",height:"'.$height.'",autostart:"'.$autostart.'",fullscreen:"'.$fullscreen.'",skin:"'.$skin.'",bgcolor:"'.$bgcolor.'"})';
        return $returnUrl;
    }

    /// \privatesection
    var $Operators;
}

?>
