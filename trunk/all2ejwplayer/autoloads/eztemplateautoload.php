<?php

// Operator autoloading

$eZTemplateOperatorArray = array();

$eZTemplateOperatorArray[] =
  array( 'script' => 'extension/all2ejwplayer/autoloads/all2eJwPlayerOperators.php',
         'class' => 'all2eJwPlayerOperators',
         'operator_names' => array( 'jwplayer', 'jwplayerinline' ) );

?>
