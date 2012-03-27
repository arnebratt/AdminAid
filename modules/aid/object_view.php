<?php
/**
 * File containing the aid/object_view module view.
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
 * Define module view template
 */
$Module = $Params['Module'];
$object_id = intval( $Params['object_id'] );

if ( $object_id > 0 )
{
    $object = eZContentObject::fetch( $object_id );
    if ( $object )
    {
        $tpl->setVariable( 'object', $object );
        $tpl->setVariable( 'datamap', $object->datamap() );
    }
    else
        return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );
}
else
{
    return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );
}

$Result = array();
$Result['content'] = $tpl->fetch( 'design:aid/object_view.tpl' );
$Result['path'] = array( array( 'url' => false,
                                'text' => "Detailed object view") );

?>