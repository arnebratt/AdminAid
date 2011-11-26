<?php

require_once( 'kernel/common/template.php' );
$tpl = templateInit();

$http = eZHTTPTool::instance();

$result = array();
$searchword = '';
$limit = 5;
if ( $http->hasVariable( 'searchword' ) )
{
	$ini = eZINI::instance( 'aid.ini' );
	$search_tables = $ini->variable( 'SearchDatabase', 'ClassList' );
	$table_ids = $ini->variable( 'SearchDatabase', 'TableID' );
	$table_texts = $ini->variable( 'SearchDatabase', 'TableText' );

	$searchword = $http->variable( 'searchword' );
	if ( $http->hasVariable( 'limit' ) )
		$limit = intval( $http->variable( 'limit' ) );
	foreach ( $search_tables as $class )
	{
		$cond = null;
		if ( intval( $searchword ) > 0 )
		{
			if ( isset( $table_ids[$class] ) )
				$cond = array( $table_ids[$class] => intval( $searchword ) );
		}
		else if ( isset( $table_texts[$class] ) )
		{
			$cond = array( $table_texts[$class] => array( 'like', '%'.trim( $searchword ).'%' ) );
		}

		// Do the actual search on specified table
		$search = array();
		if ( $cond )
			$search = eZPersistentObject::fetchObjectList( call_user_func( array( $class, 'definition' ) ),
										null, // fields
										$cond, // conditions
										null, // sort
										array( 'limit' => $limit, 'offset' => 0 ), // limit
										true, // as object
										false, // group
										null, //custom fields
										null, // custom tables
										null // custom conditions
										);
        if ( count( $search ) )
			$result = array_merge( $result, $search );
	}
}

$tpl->setVariable( 'result', $result );
$tpl->setVariable( 'searchword', $searchword );
$tpl->setVariable( 'limit', $limit );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:aid/search.tpl' );
$Result['path'] = array( array( 'url' => false,
                                'text' => "Database search") );

?>
