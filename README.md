Abac
==========

Introduction
==========
Eye4web\Zf2Abac is an attribute-based access control for Zend Framework 2

Installation
------------
#### With composer

1. Add this project composer.json:

    ```json
    "require": {
        "eye4web/eye4web-zf2-abac": "dev-master"
    }
    ```

2. Now tell composer to download the module by running the command:

    ```bash
    $ php composer.phar update
    ```

3. Enable it in your `application.config.php` file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'Eye4web\Zf2Abac'
        ),
        // ...
    );
    ```