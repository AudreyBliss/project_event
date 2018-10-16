<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('event_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Project:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('event_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Project:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('event_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Project:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('event_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Project:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('event_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Project:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

$collection->add('event_json', new Route(
    '/json',
    array('_controller' => 'AppBundle:Project:json'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));
return $collection;
