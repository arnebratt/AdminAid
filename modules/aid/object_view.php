<?php

require_once( 'kernel/common/template.php' );
$tpl = templateInit();

$http = eZHTTPTool::instance();
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
