::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::
:: Bake is a shell script for running CakePHP bake script
<<<<<<< HEAD
:: PHP 5
=======
>>>>>>> 514c7aff6f8d3335089b89706e5a9e4fdf2f54c6
::
:: CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
:: Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
::
:: Licensed under The MIT License
:: Redistributions of files must retain the above copyright notice.
::
:: @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
:: @link          http://cakephp.org CakePHP(tm) Project
:: @package       app.Console
:: @since         CakePHP(tm) v 2.0
::
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

:: In order for this script to work as intended, the cake\console\ folder must be in your PATH

@echo.
@echo off

SET app=%0
SET lib=%~dp0

php -q "%lib%cake.php" -working "%CD% " %*

echo.

exit /B %ERRORLEVEL%
