<?php

if(class_exists('Panel')) {
	$kirby->set('field', 'controlledselect', __DIR__ . DS . 'fields');
	$kirby->set('field', 'controlledcheckboxes', __DIR__ . DS . 'fields');
	$kirby->set('field', 'controlledradio', __DIR__ . DS . 'fields');
}
