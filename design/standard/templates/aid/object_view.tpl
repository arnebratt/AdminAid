<h1>{$object.name|wash()} (<a href={concat( '/class/view/', $object.contentclass_id )|ezurl()}>{$object.class_name}</a>)</h1>

<p>{'Object Remote ID'|i18n( 'adminaid' )}: {$object.remote_id}</p>
<p>{'Published'|i18n( 'adminaid' )}: {$object.published|l10n( 'shortdatetime' )}</p>
<p>{'Modified'|i18n( 'adminaid' )}: {$object.modified|l10n( 'shortdatetime' )}</p>

<h2>{'Node alias list'|i18n( 'adminaid' )}</h2>

<ul>
{foreach $object.assigned_nodes as $node}
    <li><a href={$node.url_alias|ezurl()} {if $node.is_main}style="font-weight: bold"{/if}>'{$node.name}'</a> ({'Node ID'|i18n( 'adminaid' )}: {$node.node_id}, {'Node Remote ID'|i18n( 'adminaid' )}: {$node.remote_id})</li>
{/foreach}
</ul>

<h2>{'Version list'|i18n( 'adminaid' )}</h2>

<ul>
{foreach $object.versions as $version}
    <li>
        <span style="float: left;">{$version.version} ({foreach $version.translation_list as $trans}{$trans.language_code}{delimiter}, {/delimiter}{/foreach})</span>
        <span style="float: left; font-size: 0.7em; padding: 0 1em;">({$version.created|l10n( 'shortdatetime' )} / {$version.modified|l10n( 'shortdatetime' )})</span>
        {if $version.version|ne( $object.current_version )}
        <form action={concat( '/content/history/', $object.id )|ezurl()} method="post">
            <input type="hidden" name="Language" value="{$object.current_language}">
            <input type="hidden" name="FromVersion" value="{$version.version}">
            <input type="hidden" name="ToVersion" value="{$object.current_version}">
            <input type="hidden" name="ObjectID" value="69" />
            <input class="button" type="submit" name="DiffButton" value="Show differences" />
        </form>
        {else}
        <p>[{'published version'|i18n( 'adminaid' )}]</p>
        {/if}
        <div style="clear: both;"></div>
    </li>
{/foreach}
</ul>

<h2>{'Attribute list'|i18n( 'adminaid' )}</h2>

<table class="list">
<thead>
<tr>
    <th>{'Name'|i18n( 'adminaid' )}</th>
    <th>{'Datatype'|i18n( 'adminaid' )}</th>
    <th>{'Text'|i18n( 'adminaid' )}</th>
    <th>{'Int'|i18n( 'adminaid' )}</th>
    <th>{'Float'|i18n( 'adminaid' )}</th>
    <th>{'Content'|i18n( 'adminaid' )}</th>
</tr>
</thead>
<tbody>
{foreach $datamap as $attribute}
    <tr>
    <td title="{'Identifier'|i18n( 'adminaid' )}: {$attribute.contentclass_attribute_identifier} {'Class ID'|i18n( 'adminaid' )}: {$attribute.contentclassattribute_id} {'Attribute ID'|i18n( 'adminaid' )}: {$attribute.id}">{$attribute.contentclass_attribute_name}</td>
    <td>{$attribute.data_type_string}</td>
    <td>'{$attribute.data_text|wash()}'</td>
    <td>{$attribute.data_int}</td>
    <td>{$attribute.data_float}</td>
    <td style="font-size: 0.6em">
    {if or( is_object( $attribute.content ), is_array( $attribute.content ) )}
        {$attribute.content|attribute(show, 1)}
    {else}
        {$attribute.content|wash()}
    {/if}
    </td>
    </tr>
{/foreach}
</tbody>
</table>
