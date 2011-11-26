<?php

require_once( 'kernel/common/template.php' );
$tpl = templateInit();

$http = eZHTTPTool::instance();
$Module = $Params['Module'];
$class_id = intval( $Params['class_id'] );
$from_attribute_id = intval( $Params['from_attribute_id'] );
$to_attribute_id = intval( $Params['to_attribute_id'] );

// Fetch selected class and database language list
if ( is_numeric( $class_id ) )
{
    $class = eZContentClass::fetch( $class_id );
    if ( !$class )
    {
        return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );
    }
    $class_name_list = eZContentClassName::fetchList( $class_id, eZContentClass::VERSION_STATUS_DEFINED, null );
    if ( empty( $class_name_list ) )
    {
        return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
    }
    $class_attribute_list = eZContentClassAttribute::fetchListByClassID( $class_id, eZContentClass::VERSION_STATUS_DEFINED );
    foreach ( $class_attribute_list as $class_attribute )
    {
        // Forward to select attribute to copy translation from
        if ( $http->hasVariable( 'CopyClassAttribute'.$class_attribute->attribute( 'id' ) ) )
        {
            $Module->redirectTo( "aid/class_attribute_select/$class_id/".$class_attribute->attribute( 'id' ) );
            return;
        }
    }

    $language_list = eZContentLanguage::fetchList();
}
else
{
    return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );
}

// Add new language for this class to database
if ( $http->hasVariable( 'AddLanguage' ) )
{
    $language_list = $http->variable( 'LanguageList' );
    $def = eZContentClassName::definition();
    foreach( $language_list as $language )
    {
        $lang = explode( ':', $language );
        $row = array();
        foreach ( $def['fields'] as $name => $field )
        {
            $row[$name] = $class_name_list[0]->attribute( $name );
        }
        $row['name'] = '';
        $row['language_id'] = $lang[0];
        $row['language_locale'] = $lang[1];
        // Add class name record
        $class_name = new eZContentClassName( $row );
        $class_name->store();

        // Adjust class record
        $class->setAttribute( 'language_mask', $class->attribute( 'language_mask' )|$lang[0] );
        $class->setName( '', $lang[1] );
        $class->store();
    }

    $Module->redirectTo( "aid/class_translation/$class_id" );
    return;
}

// Store specified class names in database
if ( $http->hasVariable( 'Store' ) OR $http->hasVariable( 'Save' ) )
{
    foreach ( $class_name_list as $class_name )
    {
        $http_string = 'ContentClassName-'.$class_name->attribute( 'language_id' );
        if ( $http->hasVariable( $http_string ) )
        {
            $class_name->setAttribute( 'name', $http->variable( $http_string ) );
            $class_name->store();
            $class->setName( $http->variable( $http_string ), $class_name->attribute( 'language_locale' ) );
            $class->store();
        }
    }
    foreach ( $class_attribute_list as $class_attribute )
    {
        foreach ( $language_list as $language )
        {
            $http_string = 'ContentClassAttribute-'.$class_attribute->attribute( 'id' ).'-'.$language->attribute( 'id' );
            if ( $http->hasVariable( $http_string ) )
            {
                $name = $http->variable( $http_string );
                $class_attribute->setName( $name, $language->attribute( 'locale' ) );
                $class_attribute->store();
            }
        }
    }
}
// Forward to class view page if Store or Cancel
if ( $http->hasVariable( 'Store' ) OR $http->hasVariable( 'Cancel' ) )
{
    $Module->redirectTo( "class/view/$class_id" );
    return;
}

// Fill our attribute with text from a selected attribute
if ( $from_attribute_id > 0 )
{
    $from_attribute = eZContentClassAttribute::fetch( $from_attribute_id );
    if ( is_object( $from_attribute ) )
    {
        foreach ( $class_attribute_list as $class_attribute )
        {
            if ( $class_attribute->attribute( 'id' ) == $to_attribute_id )
            {
                $class_attribute->NameList->initFromSerializedList( $from_attribute->attribute( 'serialized_name_list' ) );
                break;
            }
        }
    }
}

$tpl->setVariable( 'class', $class );
$tpl->setVariable( 'class_name_list', $class_name_list );
$tpl->setVariable( 'class_attribute_list', $class_attribute_list );
$tpl->setVariable( 'language_list', $language_list );
$tpl->setVariable( 'from_attribute_id', $from_attribute_id );
$tpl->setVariable( 'to_attribute_id', $to_attribute_id );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:aid/class_translation.tpl' );
$Result['path'] = array( array( 'url' => false,
                                'text' => "Class translation") );

?>
