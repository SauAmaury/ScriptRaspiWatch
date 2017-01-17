#!/bin/bash
# Script: installMotion.sh
# Purpose: Installation compléte du projet
# Author:Amaury
# -------------------------------------------------------

# Introduction
echo Bienvenue dans l installation du système de vidéo surveillance motion
echo l installation est autonome, votre appareil redémarrera à la fin de la procédure
read -rsp $'Appuyer sur une touche pour continuer\n' -n1 key



# Mise a jour des paquets

sudo apt-get update --yes --force-yes
sudo apt-get upgrade --yes --force-yes

#desinstallation des paquets

sudo apt-get remove --yes --force-yes  mysql-server-5.5
sudo apt-get remove --yes --force-yes phpmyadmin


sudo apt-get remove --yes --force-yes motion
sudo apt-get install --yes --force-yes motion

sudo apt-get remove --yes --force-yes apache2
sudo apt-get install --yes --force-yes apache2

sudo apt-get remove --yes --force-yes php5
sudo apt-get install --yes --force-yes php5-common libapache2-mod-php5 php5-cli

sudo apt-get remove --yes --force-yes openssl
sudo apt-get install --yes --force-yes openssl


# Configuration de apache2

sudo rm /etc/apache2/apache2.conf
sudo rm /etc/apache2/sites-available/*
sudo rm /etc/apache2/sites-enabled/*
sudo cp apache2.conf /etc/apache2/
sudo cp 000-default.conf /etc/apache2/sites-available
sudo cp 000-default.conf /etc/apache2/sites-enabled
sudo chmod 644 /etc/apache2/sites-available/000-default.conf
sudo chmod 777 /etc/apache2/sites-enabled/000-default.conf
sudo cp -R  RaspiWatch /var/www/

# Configuration de motion

sudo rm /etc/motion/*
sudo cp motion.conf /etc/motion/
sudo cp thread1.conf /etc/motion/
sudo cp thread2.conf /etc/motion/
sudo cp thread3.conf /etc/motion/
sudo cp thread4.conf /etc/motion/
sudo chmod 755 /etc/motion/motion.conf
sudo chmod 755 /etc/motion/thread1.conf
sudo chmod 755 /etc/motion/thread2.conf
sudo chmod 755 /etc/motion/thread3.conf
sudo chmod 755 /etc/motion/thread4.conf
sudo chmod 755 /usr/bin/motion
sudo chmod 775 /tmp/motion.log
sudo mkdir /var/www/RaspiWatch/imgCamera1
sudo mkdir /var/www/RaspiWatch/imgCamera2
sudo mkdir /var/www/RaspiWatch/imgCamera3
sudo mkdir /var/www/RaspiWatch/imgCamera4
sudo chmod 777 /var/www/RaspiWatch/imgCamera1
sudo chmod 777 /var/www/RaspiWatch/imgCamera2
sudo chmod 777 /var/www/RaspiWatch/imgCamera3
sudo chmod 777 /var/www/RaspiWatch/imgCamera4
sudo rm /etc/default/motion
sudo cp motion /etc/default

# Configuration de la BDD

echo "mysql-server-5.5 mysql-server/root_password password raspberry" | debconf-set-selections
echo "mysql-server-5.5 mysql-server/root_password_again password raspberry" | debconf-set-selections
sudo apt-get -y install mysql-server-5.5


echo "phpmyadmin phpmyadmin/internal/skip-preseed boolean true" | debconf-set-selections
echo "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2" | debconf-set-selections
echo "phpmyadmin phpmyadmin/dbconfig-install boolean false" | debconf-set-selections
sudo apt-get install --yes --force-yes phpmyadmin


mysql -uroot -praspberry < Script.sql

sudo chmod 711 uninstall.sh

echo Installation terminée
echo Redemarrage Iminent


sudo reboot
