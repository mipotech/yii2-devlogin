# Yii2-devlogin

This package provides a simple way to password-protect an entire site,
typically when in dev or test mode.

## Installation
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

First add this entry to the `repositories` section of your composer.json:

```
"repositories": [{
    ...
},{
    "type": "git",
    "url": "https://github.com/mipotech/yii2-devlogin.git"
},{
    ...
}],
```

then add this line:

```
"mipotech/yii2-devlogin": "dev-master",
```

to the `require` section of your `composer.json` file and perform a composer update.

## Configuration

Add `devlogin` as an application component in @app/config/web.php:

```
'components' => [
    ...
    'devlogin' => [
        'class' => 'mipotech\devlogin\Bootstrap',
        //'environments' => ['dev'],    defaults to ['dev', 'test']
        'logoPath' => '/images/logo.png',
        'username' => 'XXXXX',
        'password' => 'YYYYY',
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
