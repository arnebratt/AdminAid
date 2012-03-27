<?php
/**
 * File containing the aid/user_switch module view.
 *
 * @copyright Copyright (C) 2010 - 2012 A.Bakkeboe. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 * @package adminaid
 */

/**
 * Default module parameters
 */
$Module = $Params['Module'];
$user_id = intval( $Params['user_id'] );

/**
 * Default user information
 */
$http = eZHTTPTool::instance();
$user = eZUser::currentUser();

/**
 * Default settings user switch limit
 */
$ini = eZINI::instance( 'aid.ini' );
$user_limit = $ini->variable( 'Aid', 'UserSwitchIDLimit' );

# IP filter check
$user_limit = $ini->variable( 'Aid', 'UserSwitchIDLimit' );
$limit_by_ip = $ini->variable( 'Aid', 'LimitByIP' ) == 'enabled';

/**
 * IP filter check
 */
if ( $limit_by_ip )
{
    $ip_list = $ini->variable( 'Aid', 'IPList' );
    $ip = $_SERVER['REMOTE_ADDR'];
    if ( !in_array( $ip, $ip_list ) )
    {
        return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );
    }
}

/**
 * Redirect
 */
if ( !empty( $user_id ) AND in_array( $user->attribute( 'contentobject_id' ), $user_limit ) )
{
    $new_user = eZUser::fetch( $user_id );
    if ( $new_user )
    {
        eZUser::setCurrentlyLoggedInUser( $new_user, $user_id );
        eZHTTPTool::redirect( $http->sessionVariable( 'LastAccessesURI' ) );
        eZExecution::cleanExit();
        exit();
    }
    else
    {
        return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );
    }
}
else
{
    return $Module->handleError( eZError::KERNEL_ACCESS_DENIED, 'kernel' );
}

?>