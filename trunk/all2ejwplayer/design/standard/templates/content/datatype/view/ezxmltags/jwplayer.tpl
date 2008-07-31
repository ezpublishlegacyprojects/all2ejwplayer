{if and( is_set($type), eq(downcase($type), 'inline') )}
    {jwplayerinline( $content, cond(is_set($playerclass),$playerclass,true(),"Inline" ) )}
{else}
    <a href='javascript:{jwplayer( $content, cond(is_set($playerclass),$playerclass,true(),"Standard" ) )}'>{$content}</a>
{/if}
