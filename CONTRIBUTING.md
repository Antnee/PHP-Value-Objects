# Contributing to PHP Value Objects #

Please, if you want to contribute to this library and add more types, fork the repo, add your own types and submit a pull request. I would love to see what you can add and to increase the usefullness of what is currently only a proof-of-concept.

Code should be [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md), [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) and [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) compliant where possible. I may not have run [PHP CS Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) on the code right now, but I will be doing.

Also, please add tests (PHPUnit only) for any new objects or validators that you write. I tend to run `vendor/bin/phpunit tests --coverage-html build` to run all tests and update the code coverage graphs in the `/build` directory. This requires that you have XDebug installed, I believe. If you don't have XDebug, don't worry about updating the code coverage information; I'll run that and commit afterwards.

Thanks for taking an interest!
