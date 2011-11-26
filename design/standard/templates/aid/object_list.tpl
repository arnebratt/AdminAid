<h1>{'Object list for class "%classname"'|i18n( 'adminaid', '', hash( '%classname', concat( '<a href=', concat( '/class/view/', $class_id )|ezurl(), '>', $class.name|wash(), '</a>' ) ) )}</h1>

<p>{'Showing %count of %total objects:'|i18n( 'adminaid', '', 
        hash( '%count', $count, 
            '%total', $object_count ) )}</p>

{include name=navigator
	uri='design:navigator/google.tpl'
	page_uri=concat( '/aid/object_list/', $class_id, '/', $limit )
	item_count=$object_count
	view_parameters=$view_parameters
	item_limit=$limit}

<ul>
{foreach $object_list as $object}
    <li>
        <a href={is_object( $object.main_node )|choose( concat( '/content/history/', $object.id ), $object.main_node.url_alias )|ezurl()}>{$object.name}</a>
        {if is_object( $object.main_node )}<span style="font-size: 0.7em">({$object.main_node.url_alias})</span>{/if}
    </li>
{/foreach}
</ul>

{include name=navigator
	uri='design:navigator/google.tpl'
	page_uri=concat( '/aid/object_list/', $class_id, '/', $limit )
	item_count=$object_count
	view_parameters=$view_parameters
	item_limit=$limit}
