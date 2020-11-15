<?php

namespace mipotech\devlogin;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Component;

/**
 * Bootstrap interface to restrict access to the dev environment
 *
 * @link http://www.yiiframework.com/wiki/652/how-to-use-bootstrapinterface/
 * @author Chaim Leichman, MIPO Technologies Ltd
 */
class Bootstrap extends Component implements BootstrapInterface
{
    /**
     *
     * @var array $environments The environments for which to enable this component
     * By default, we apply this component to the dev and staging (test) environments,
     * and only production is excluded.
     * @link http://www.yiiframework.com/doc-2.0/guide-concept-configurations.html#environment-constants
     */
    public $environments = ['dev', 'test'];

    /**
     *
     * @var array The IPs to exclude from requiring login.
     */
    public $excludeIPs = [];

    /**
     *
     * @var array $excludePaths Paths to exclude from this bootstrap rule.
     * The paths will be checked against the current URL using the following logic:
     *
     * ```
     * preg_match("/^\/{$path}/", $currentUrl)
     * ```
     */
    public $excludePaths = [];

    /**
     * @var string $logoPath The relative or absolute path (URL) of the logo to display on the login page
     */
    public $logoPath = null;

    /**
     * @var string $password The password to enforce for the login form.
     * Leaving the username or password value blank will effectively disabled this component.
     */
    public $password;

    /**
     *
     * @var string $redirectUrl The URL to which to redirect after successful login
     */
    public $redirectUrl;

    /**
     * @var string $sessionKey The name of the sessio key in which to mark that the user has logged in
     */
    public $sessionKey = 'devlogin';

    /**
     * @var string $username The username to enforce for the login form.
     * Leaving the username or password value blank will effectively disabled this component.
     */
    public $username;

    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        // Exclude localhost
        if ($app->request->hostName == 'localhost') {
            Yii::trace('Skipped. Running from localhost', 'devlogin');
            return;
        }

        // Retrieve the currently requested URL
        $url = $this->redirectUrl = $app->request->url;

        // Assert that the user's IP isn't excluded
        $ip = Yii::$app->getRequest()->getUserIP();
        foreach ($this->excludeIPs as $filter) {
            if ($filter === '*' || $filter === $ip || (($pos = strpos($filter, '*')) !== false && !strncmp($ip, $filter, $pos))) {
                Yii::trace("Skipped. Not relevant to to this IP: {$ip}", 'devlogin');
                return;
            }
        }

        // Assert that the current environment is relevant
        if (!in_array(YII_ENV, $this->environments)) {
            Yii::trace('Skipped. Not relevant to environment ' . YII_ENV, 'devlogin');
            return;
        } elseif (empty($this->username) || empty($this->password)) {
            Yii::trace('Skipped. No credentials set in application component configuration', 'devlogin');
            return;
        } elseif (count($this->excludePaths)) {
            Yii::trace("Checking excluded paths...", 'devlogin');
            foreach ($this->excludePaths as $path) {
                if (preg_match('/' . str_replace('/', '\/', $path) . '/', $url)) {
                    Yii::trace("Skipped because of path {$path}", 'devlogin');
                    return;
                }
            }
        }

        if (!$app->session->has($this->sessionKey)) {
            // Run the login page as a controller
            $app->controllerMap['devlogin'] = controllers\LoginController::className();
            $ret = $app->runAction('devlogin/index');

            // $ret may be scalar (an HTML page) or an instance of yii\web\Response
            if (is_scalar($ret)) {
                echo $ret;
            } elseif ($ret instanceof \yii\web\Response) {
                $ret->send();
            }

            $app->end();
        }
    }
}
