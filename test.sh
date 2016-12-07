sudo apt-get remove --yes --force-yes mysql-server-5.5
sudo apt-get remove --yes --force-yes phpmyadmin


echo 'mysql-server-5.5 mysql-server/root_password password raspberry' | debconf-set-selections
echo 'mysql-server-5.5 mysql-server/root_password_again password raspberry' | debconf-set-selections
sudo apt-get -y install mysql-server-5.5

echo 'phpmyadmin phpmyadmin/dbconfig-upgrade boolean false' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/dbconfig-install boolean false' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2' | debconf-set-selections
sudo apt-get install --yes --force-yes phpmyadmin
