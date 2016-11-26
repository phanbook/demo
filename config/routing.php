<?php
/**
 * Phanbook : Delightfully simple forum software
 *
 * Licensed under The GNU License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link    http://phanbook.com Phanbook Project
 * @since   1.0.0
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 */

use Phalcon\Mvc\Router\Group as RouterGroup;

$demo = new RouterGroup([
    'module'    => 'demo',
    'namespace' => 'Phanbook\Demo\Controllers',
]);

$demo->add('/demo/:controller', [
    'controller' => 1,
]);

$demo->add('/demo/:controller/:int', [
    'controller' => 1,
    'id'         => 2,
]);

$demo->add('/demo/:controller/:action/:params', [
    'controller' => 1,
    'action'     => 2,
    'params'     => 3,
]);

// $demo->add('/', [
//     'controller' => 'index',
//     'action'     => 'index',
//     'params'     => 3,
// ]);



return $demo;
