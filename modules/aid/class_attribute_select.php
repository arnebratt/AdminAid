<?php
/**
 * File containing the aid/class_attribute_select module view.
 *
 * @copyright Copyright (C) 2010-2012 A.Bakkeboe. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 * @package adminaid
 */

/**
 * Default http parameters
 */
$http = eZHTTPTool::instance();
 
/**
 * Define module view template
 */
$tpl = eZTemplate::factory();
 
/**
 * Default module view parameters
 */
$Module = $Params['Module'];
$class_id = intval( $Params['class_id'] );
$to_attribute_id = intval( $Params['to_attribute_id'] );

if ( !is_numeric( $to_attribute_id ) )
{
    return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );
}

/**
 * Forward to class view page if Select or Cancel
 */
if ( $http->hasVariable( 'Select' ) OR $http->hasVariable( 'Cancel' ) )
{
    $selected = '';
    if ( $http->hasVariable( 'Select' ) AND $http->hasVariable( 'ClassAttributeID' ) )
    {
        $selected = '/from/'.$http->variable( 'ClassAttributeID' ).'/to/'.$to_attribute_id;
    }

    $Module->redirectTo( "aid/class_translation/$class_id$selected" );
    return;
}

$tpl->setVariable( 'class_id', $class_id );
$tpl->setVariable( 'to_attribute_id', $to_attribute_id );
$to_attribute = eZContentClassAttribute::fetch( $to_attribute_id );
$tpl->setVariable( 'to_attribute_identifier', $to_attribute->attribute( 'identifier' ) );
$tpl->setVariable( 'attribute_list', eZContentClassAttribute::fetchList() );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:aid/class_attribute_select.tpl' );
$Result['path'] = array( array( 'url' => false,
                                'text' => "Class attribute select") );

?>