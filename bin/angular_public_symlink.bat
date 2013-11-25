@echo off

rem Fix me: This is too dirty. 

pushd %0\..\..\public
cls

MKLINK /D angular ..\vendor\angular\app

pause
exit

