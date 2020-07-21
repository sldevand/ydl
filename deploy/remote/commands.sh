#!/bin/bash

red=`tput setaf 1`
green=`tput setaf 2`
reset=`tput sgr0`

function myEcho(){
    echo ""
    echo "${green}--> $1 ${reset}"
}

myEcho "Executing remote script"

REMOTE_HOST=pi@raspi3
REMOTE_WWW_PATH=/var/www
REMOTE_TMP_PATH=/home/pi/tmp
REMOTE_APP_NAME=ydl
REMOTE_APP_PATH=$REMOTE_WWW_PATH/$REMOTE_APP_NAME
REMOTE_COMPOSER=/usr/bin/composer
REMOTE_NPM=/usr/bin/npm
REMOTE_ENV_FILE=/home/pi/deployFiles/ydl/.env

myEcho "***Remote : removing previous site***"
sudo rm -rvf $REMOTE_WWW_PATH/$REMOTE_APP_NAME

myEcho "Remote : Move from tmp folder to app folder"
sudo mv -v $REMOTE_TMP_PATH/$REMOTE_APP_NAME $REMOTE_APP_PATH &&

myEcho "Remote : Composer Install" &&
cd $REMOTE_APP_PATH &&
sudo $REMOTE_COMPOSER install &&
sudo rm -rfv $REMOTE_APP_PATH/composer.* &&

myEcho "Remote : Npm Install" &&
cd $REMOTE_APP_PATH &&
sudo $REMOTE_NPM install &&
sudo rm -rfv $REMOTE_APP_PATH/package* &&

myEcho "Remote : Add .env file" &&
sudo cp $REMOTE_ENV_FILE $REMOTE_APP_PATH &&

myEcho "Remote : Giving correct rights" &&
sudo chown -R www-data:www-data $REMOTE_APP_PATH &&
sudo find $REMOTE_APP_PATH -type d -exec chmod 0755 {} \; &&
sudo find $REMOTE_APP_PATH -type f -exec chmod 0644 {} \;