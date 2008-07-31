<?php

include_once('extension/all2ejwplayer/classes/all2eJwPlayerClass.php');
class all2eJwPlayerOperators
{
    /*!
     Constructor
    */
    function all2eJwPlayerOperators()
    {
        $this->Operators = array('jwplayer', 'jwplayerinline');
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
        return array( 'jwplayer' => array('url' => array( 'type' => 'string',
                                                              'required' => true,
                                                              'default' => '' ),
                                          'playerclass' => array(
                                                              'type' => 'string',
                                                              'required' => false,
                                                              'default' => 'Standard' )
                                            ),
                      'jwplayerinline' => array('url' => array( 'type' => 'string',
                                                                'required' => true,
                                                                'default' => '' ),
                                          'playerclass' => array( 'type' => 'string',
                                                                  'required' => false,
                                                                  'default' => 'Inline' )
                                            )
                  );
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
                $operatorValue = $this->jwplayer( $namedParameters['url'], $namedParameters['playerclass'] );
            } break;
            case 'jwplayerinline':
            {
                $operatorValue = $this->jwplayerinline( $namedParameters['url'], $namedParameters['playerclass'] );
            } break;
        }
    }

    function jwplayer( $url, $class )
    { 
        $returnUrl = all2eJwPlayerClass::createLightboxUrl( $url, $class );
        return $returnUrl;
    }
    
    function jwplayerinline( $url, $class )
    {
        $returnUrl = all2eJwPlayerClass::createInlineUrl( $url, $class );
        return $returnUrl;
    }
    
    /// \privatesection
    var $Operators;
}

?>
