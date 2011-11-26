{def $class = null
     $selected = false()}
<h1>{'Select attribute'|i18n( 'design/adminaid/translations' )}</h1>

<form action={concat( 'aid/class_attribute_select/', $class_id, '/', $to_attribute_id )|ezurl()} method="GET">
    <select name="ClassAttributeID">
    {foreach $attribute_list as $attribute}
        {set $class = fetch( 'class', 'list', hash( 'class_filter', array( $attribute.contentclass_id ) ) )}
        <option value="{$attribute.id}" {if and( $attribute.id|ne( $to_attribute_id ), $attribute.identifier|eq( $to_attribute_identifier ) )} selected="selected"{set $to_attribute_identifier=''}{/if}>{$class.0.identifier} - {$attribute.identifier} ({$attribute.data_type_string})</option>
    {/foreach}
    </select>

    <br />
    <input type="submit" name="Select" value="Select" />
    <input type="submit" name="Cancel" value="Cancel" />
</form>