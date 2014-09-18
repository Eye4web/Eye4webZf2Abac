Zf2Abac
==========
[![Build Status](https://travis-ci.org/Eye4web/Eye4webZf2Abac.svg?branch=master)](https://travis-ci.org/Eye4web/Eye4webZf2Abac) [![Code Climate](https://codeclimate.com/github/Eye4web/Eye4webZf2Abac/badges/gpa.svg)](https://codeclimate.com/github/Eye4web/Eye4webZf2Abac) [![Test Coverage](https://codeclimate.com/github/Eye4web/Eye4webZf2Abac/badges/coverage.svg)](https://codeclimate.com/github/Eye4web/Eye4webZf2Abac) [![Latest Stable Version](https://poser.pugx.org/eye4web/eye4web-zf2-abac/v/stable.svg)](https://packagist.org/packages/eye4web/eye4web-zf2-abac) [![Total Downloads](https://poser.pugx.org/eye4web/eye4web-zf2-abac/downloads.svg)](https://packagist.org/packages/eye4web/eye4web-zf2-abac) [![Latest Unstable Version](https://poser.pugx.org/eye4web/eye4web-zf2-abac/v/unstable.svg)](https://packagist.org/packages/eye4web/eye4web-zf2-abac) [![License](https://poser.pugx.org/eye4web/eye4web-zf2-abac/license.svg)](https://packagist.org/packages/eye4web/eye4web-zf2-abac)

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

Inspiration
==========
[ZfcRbac](https://github.com/ZF-Commons/zfc-rbac) (Docs & AssertionPluginManager).

Author(s)
==========
**nikolajpetersen**
np@eye4web.dk