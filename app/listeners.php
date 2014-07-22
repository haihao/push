<?php
Event::listen('illuminate.query',function($sql,$param)
{
	log::info($sql);
});

?>
