<?php
/**
 * File containing the aid/object_list module view.
 *
 * @copyright Copyright (C) 2010 - 2012 A.Bakkeboe. All rights reserved.
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
$offset = intval( $Params['offset'] );

if ( $offset < 0 )
    $offset = 0;

$limit = intval( $Params['limit'] );

if ( $limit <= 0 OR $limit > 1000 )
    $limit = 25;

if ( $class_id > 0 )
{
    $class = eZContentClass::fetch( $class_id );
    if ( !$class )
    {
        return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );
    }
    $tpl->setVariable( 'class', $class );
    $object_list = eZPersistentObject::fetchObjectList( eZContentObject::definition(),
                            null, // fields
                            array( 'contentclass_id' => $class_id ), // conditions
                            null, // sort
                            array( 'offset'=>$offset, 'limit'=>$limit ), // limit
                            true, // as object
                            false, // group
                            null, // custom fields
                            null, // custom tables
                            null // custom conditions
                            );
    $object_count = eZPersistentObject::fetchObjectList( eZContentObject::definition(),
                                array(), // fields
                                array( 'contentclass_id' => $class_id ), // conditions
                                null, // sort
                                null, // limit
                                false, // as object
                                false, // group
                                array( array( 'operation' => 'count( id )', 'name' => 'count' ) ), //custom fields
                                null, // custom tables
                                null // custom conditions
                                );
    $tpl->setVariable( 'object_list', $object_list );
    $tpl->setVariable( 'object_count', $object_count[0]['count'] );
    $tpl->setVariable( 'count', count( $object_list ) );
}
else
{
    return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );
}

$tpl->setVariable( 'class_id', $class_id );
$tpl->setVariable( 'offset', $offset );
$tpl->setVariable( 'limit', $limit );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:aid/object_list.tpl' );
$Result['path'] = array( array( 'url' => false,
                                'text' => "Class object list") );

?>