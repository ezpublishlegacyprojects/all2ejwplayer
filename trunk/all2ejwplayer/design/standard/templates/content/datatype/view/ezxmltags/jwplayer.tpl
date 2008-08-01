{if and( is_set($type), eq($type, "inline") )}
    {jwplayerinline( $content, cond(is_set($playerclass),$playerclass,true(),"Inline" ) )}
{else}
    <a href='javascript:{jwplayer( $content, cond(is_set($playerclass),$playerclass,true(),"Standard" ) )}'>{$content}</a>
{/if}
