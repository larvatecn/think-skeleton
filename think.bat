@echo off

rem -------------------------------------------------------------
rem  Think command line bootstrap script for Windows.
rem -------------------------------------------------------------

@setlocal

set LARAVEL_PATH=%~dp0

if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe

"%PHP_COMMAND%" "%LARAVEL_PATH%think" %*

@endlocal
