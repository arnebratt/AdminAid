<h1>{'Search database'|i18n( 'adminaid' )}</h1>

<form action={'aid/search'|ezurl()} method="get">
	<label for="searchword">{'Search for ID or text:'|i18n( 'adminaid' )}</label>
	<input id="searchword" type="text" name="searchword" value="{$searchword}" />
	<label for="limit">{'Max number of hits pr.table:'|i18n( 'adminaid' )}</label>
	<input id="limit" type="text" name="limit" value="{$limit}" size="3" />
	<br />
	<input type="submit" value="Search" />
</form>

{def $classname = ''}
{foreach $result as $object}
	{set $classname = get_class( $object )}
	<p>{'Found in "%classname":'|i18n( 'adminaid', '', hash( '%classname', $classname ) )}
	{switch match=$classname}
		{case match='ezcontentobject'}
			<a href={concat( '/aid/object_view/', $object.id )|ezurl()}>"{$object.name}"</a>
		{/case}
		{case match='ezcontentobjecttreenode'}
			<a href={concat( '/aid/object_view/', $object.contentobject_id )|ezurl()}>"{$object.name}"</a>
		{/case}
		{case match='ezcontentobjectattribute'}
			<a href={concat( '/aid/object_view/', $object.contentobject_id )|ezurl()}>"{$object.contentclassattribute_name}"</a>
		{/case}
		{case match='ezcontentobjectversion'}
			<a href={concat( '/content/history/', $object.contentobject_id )|ezurl()}>"{$object.name}"</a>
		{/case}
		{case match='ezcontentclass'}
			<a href={concat( '/class/view/', $object.id )|ezurl()}>"{$object.name}"</a>
		{/case}
		{case match='ezcontentclassattribute'}
			<a href={concat( '/class/view/', $object.contentclass_id )|ezurl()}>"{$object.name}"</a>
		{/case}
		{case match='ezuser'}
			<a href={concat( '/aid/object_view/', $object.contentobject_id )|ezurl()}>"{$object.contentobject.name}"</a>
		{/case}
		{case match='ezurl'}
			<a href={concat( '/url/view/', $object.id )|ezurl()}>"{$object.url}"</a>
		{/case}
		{case match='ezurlaliasml'}
			{if $object.action_type|eq( 'eznode' )}
				{def $node = fetch( 'content', 'node', hash( 'node_id', $object.action|explode( ':' )[1] ) )}
				{if $node}
					<a href={concat( '/aid/object_view/', $node.contentobject_id )|ezurl()}>"{$node.name}"</a>
				{/if}
			{/if}
		{/case}
		{case}
		
		{/case}
	{/switch}
	</p>
{/foreach}

<br />
<p style="font-size: 9px;">{'Search functionality inspired by Brookins Consulting extension %project.'|i18n( 'adminaid', '', hash( '%project', '<a href="http://projects.ez.no/bcfindcontentobject" target="_blank">BC Find Content Object</a>' ) )}</p>
