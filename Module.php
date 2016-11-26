<?php
/**
 * Phanbook : Delightfully simple forum and Q&A software
 *
 * Licensed under The GNU License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link    http://phanbook.com Phanbook Project
 * @since   1.0.0
 * @author  Phanbook <hello@phanbook.com>
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt
 */
namespace Phanbook\Demo;

use Phalcon\Loader;
use Phalcon\DiInterface;
use Phanbook\Common\Module as BaseModule;
use Phanbook\Common\Library\Events\UserLogins;
use Phanbook\Common\Library\Events\ViewListener;

/**
 * \Phanbook\Demo\Module
 *
 * @package Phanbook\Demo
 */
class Module extends BaseModule
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getHandlersNamespace()
    {
        return 'Phanbook\Demo\Controllers';
    }

    /**
     * Registers an autoloader related to the module.
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $namespaces = [
            $this->getHandlersNamespace() => __DIR__ . '/controllers/',
            'Phanbook\Demo\Forms'        => __DIR__ . '/forms/',
        ];

        $loader->registerNamespaces($namespaces, true);

        $loader->register();
    }

    /**
     * Registers services related to the module.
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        // Read configuration
        $moduleConfig = require_once __DIR__ . '/config/config.php';

        $eventsManager = $di->getShared('eventsManager');
        $eventsManager->attach('user', new UserLogins($di));

        // Tune Up the URL Component
        $url = $di->getShared('url');
        $url->setBaseUri($moduleConfig->application->baseUri);

        $eventsManager = $di->getShared('eventsManager');
        $eventsManager->attach('view:notFoundView', new ViewListener($di));

        // Setting up the View Component
        $view = $di->getShared('view');
        $view->setViewsDir($moduleConfig->application->viewsDir);
    }
}
