<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App;

use Authentication\AuthenticationService;
use Authentication\Middleware\AuthenticationMiddleware;
use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication implements AuthenticationServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function bootstrap()
    {
        $this->addPlugin('CakePdf', ['bootstrap' => true]);

        $this->addPlugin('Datalist');

        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        /*
         * Only try to load DebugKit in development mode
         * Debug Kit should not be installed on a production system
         */
        if (Configure::read('debug')) {
            $this->addPlugin(\DebugKit\Plugin::class);
        }

        // Load more plugins here
        // Load a plugin with a vendor namespace by 'short name'

        $this->addPlugin(\CakeDC\Users\Plugin::class);
        Configure::write('Users.config', ['users']);

        $this->addPlugin('MenuLink');
        $this->addPlugin('Datalist');
        $this->addPlugin('Authentication');
    }

    public function pluginBootstrap()
    {
        parent::pluginBootstrap();
        Configure::write('Auth.authenticate', [
            'all' => [
                'finder' => 'auth',
                'userModel' => Configure::read('Users.table')
            ],
            'Form'  => [
                'fields' => ['username' => 'email']
            ],
            //'Digest' => [
            //        'fields' => ['username' => 'email', 'password' => 'secret'],        //api_token
                    /*
                    'realm' => The realm authentication is for. Defaults to the servername. env('SERVER_NAME')
                    'nonce' =>  A nonce used for authentication. Defaults to uniqid().
                    'qop' =>  Defaults to auth; no other values are supported at this time.
                    'opaque' =>  A string that must be returned unchanged by clients. Defaults to md5($config['realm']).
                    */
            //],
            'CakeDC/Auth.RememberMe' => [],
        ]);
        //Configure::write('Auth.storage', 'Memory');
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware($middlewareQueue)
    {
        // Add the authentication middleware
        $authentication = new AuthenticationMiddleware($this);

        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(new ErrorHandlerMiddleware(null, Configure::read('Error')))

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime')
            ]))

            // Add routing middleware.
            // If you have a large number of routes connected, turning on routes
            // caching in production could improve performance. For that when
            // creating the middleware instance specify the cache config name by
            // using it's second constructor argument:
            // `new RoutingMiddleware($this, '_cake_routes_')`
            ->add(new RoutingMiddleware($this))

            ->add($authentication);

        return $middlewareQueue;
    }

    /**
     * @return void
     */
    protected function bootstrapCli()
    {
        try {
            $this->addPlugin('Bake');
        } catch (MissingPluginException $e) {
            // Do not halt if the plugin is missing
        }

        $this->addPlugin('Migrations');

        // Load more plugins here
    }

    /**
     * Returns a service provider instance.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request Request
     * @param \Psr\Http\Message\ResponseInterface $response Response
     * @return \Authentication\AuthenticationServiceInterface
     */
    public function getAuthenticationService(ServerRequestInterface $request, ResponseInterface $response)
    {
        $service = new AuthenticationService();

        $fields = ['username' => 'email', 'password' => 'secret'];

        // Load identifiers
        $service->loadIdentifier('Authentication.Password', compact('fields'));

        // Load the authenticators, you want session first
        $service->loadAuthenticator('Authentication.Memory');
        $service->loadAuthenticator('Authentication.Digest', [
            'fields' => $fields,
        ]);

        return $service;
    }
}
