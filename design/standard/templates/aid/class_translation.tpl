<h1>{'Editing class/attribute names for "%class_identifier" class'|i18n( 'design/adminaid/translations', '', hash( '%class_identifier', $class.identifier ) )}</h1>

<p>
    {'Note that this class is not in editing mode while translating it.'|i18n( 'design/adminaid/translations' )}
    {'This means it can potentially be edited by others at the same time, creating a conflict.'|i18n( 'design/adminaid/translations' )}
</p>

<form action={concat( 'aid/class_translation/', $class.id )|ezurl()} method="POST">
    <h2>{'Class name'|i18n( 'design/adminaid/translations' )}</h2>
    <table>
    {foreach $class_name_list as $class_name}
        <tr>
        <td><span>{$class_name.language_locale}:</span></td>
        <td><input type="text" name="ContentClassName-{$class_name.language_id}" value="{$class_name.name|wash()}" /></td>
        </tr>
    {/foreach}
    </table>

    <h2>{'List of attributes'|i18n( 'design/adminaid/translations' )}</h2>
    {foreach $class_attribute_list as $class_attribute}
        <p>
            <span>{$class_attribute.identifier|wash()}:</span>
            {if $to_attribute_id|eq( $class_attribute.id )}
                <span>{'(click "Apply" button to store these translations)'|i18n( 'design/adminaid/translations' )}</span>
            {/if}
        </p>
        <table>
        {foreach $class_name_list as $class_name}
            <tr>
            <td><span>{$class_name.language_locale}:</span></td>
            <td><input type="text" name="ContentClassAttribute-{$class_attribute.id}-{$class_name.language_id}" value="{if is_set( $class_attribute.nameList[$class_name.language_locale] )}{$class_attribute.nameList[$class_name.language_locale]|wash()}{/if}" /></td>
            </tr>
        {/foreach}
        </table>
        <input type="submit" name="CopyClassAttribute{$class_attribute.id}" value="{'Copy translations from other attribute'|i18n( 'design/adminaid/translations' )}" /><br />
    {/foreach}

    <br />
    <input type="submit" name="Store" value="{'Ok'|i18n( 'design/adminaid/translations' )}" />
    <input type="submit" name="Save" value="{'Apply'|i18n( 'design/adminaid/translations' )}" />
    <input type="submit" name="Cancel" value="{'Cancel'|i18n( 'design/adminaid/translations' )}" />

    {* Show languages in database that is not included in class (if there are any) *}
    {if $language_list|count()|gt( $class_name_list|count() )}
        {def $class_lang_array = array()}
        {foreach $class_name_list as $class_name}
            {set $class_lang_array = $class_lang_array|append( $class_name.language_locale )}
        {/foreach}
        <br /><br />
        <fieldset>
            <legend>{'Add languages to this class'|i18n( 'design/adminaid/translations' )}</legend>
            {foreach $language_list as $language}
                {if $class_lang_array|contains( $language.locale )|not()}
                    <input type="checkbox" name="LanguageList[]" value="{$language.id}:{$language.locale}" />{$language.name}<br />
                {/if}
            {/foreach}
            <input type="submit" name="AddLanguage" value="{'Add selected languages'|i18n( 'design/adminaid/translations' )}" />
        </fieldset>
    {/if}
</form>
