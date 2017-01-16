#!/bin/bash
# Script: uninstall.sh
# Purpose: Desinstalleur
# Author:Amaury
# -------------------------------------------------------

sudo apt-get remove --yes --force-yes apache2
sudo apt-get purge --yes --force-yes apache2

sudo apt-get remove --yes --force-yes php5
sudo apt-get purge --yes --force-yes php5


sudo apt-get remove --yes --force-yes motion
sudo apt-get purge --yes --force-yes motion

sudo apt-get remove --yes --force-yes phpmyadmin
sudo apt-get purge --yes --force-yes phpmyadmin

sudo apt-get remove --yes --force-yes openssl
sudo apt-get purge --yes --force-yes openssl

sudo rm -r /var/www/RaspiWatch/

