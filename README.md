# Yii2-devlogin

This package provides a simple way to password-protect an entire site,
typically when in dev or test mode.

## Installation
The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Either run

```
php composer.phar require --prefer-dist mipotech/yii2-devlogin "*"
```

or add:

```
"mipotech/yii2-devlogin": "*",
```

to the `require` section of your `composer.json` file and perform a composer update.

## Configuration

Add `devlogin` as an application component in @app/config/web.php:

```
'components' => [
    ...
    'devlogin' => [
        /* Required settings */
        'class' => 'mipotech\devlogin\Bootstrap',
        'username' => 'XXXXX',
        'password' => 'YYYYY',
        
        /* Optional settings */
        'environments' => ['dev'],    // defaults to ['dev', 'test']
        'excludeIPs' => ['192.168.10.1'],    // IP addresses to exclude from this rule. defaults to []
        'excludePaths' => ['/dashboard','/gii'],    // defaults to []
        'logoPath' => '/images/logo.png',
    ],
    ...
]
```

and then add the `devlogin` component in the `bootstrap` section of the config file:
```
'bootstrap' => [
    'log',
    'devlogin',
    ...
]
```

That's it. The package is set up and ready to go.
