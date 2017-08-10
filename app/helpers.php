<?php

/**
 * @method handleWiths
 * @param {QueryBuilder} $query
 * @param {String} $withs
 * @return {QueryBuilder}
 */
function handleWiths($query, $withs) {
	if(!$withs) return $query;
	
	$withs = explode('|', $withs);

	foreach($withs as $with) {
		$query = $query->with($with);
	}

	return $query;
}