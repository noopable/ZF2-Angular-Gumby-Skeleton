@echo off

rem Fix me: This is too dirty. 

pushd %0\..\..
cls

MKLINK /D public_html vendor\angular\app

pause
exit

