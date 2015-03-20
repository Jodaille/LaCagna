# LaCagna installation notes
===========

## How to load a sql file ?


```sh
mysql -uroot -p < ./docs/create_database_sample.sql
```

## Add virtual host to apache2 (on Debian)

```sh
sudo cp ./docs/vhost_sample_config /etc/apache2/sites-available/lacagna
```

To enable the new configuration (named here lacagna):

```sh
sudo a2ensite lacagna
```

The to reload apache configuration:

```sh
sudo service apache2 reload
```

## Edit hosts to add your development url

add ServerName of your virtual host config in file /etc/hosts

In the example file it is: lacagna.local

The entries will be for a server running localy:


> 127.0.0.1 lacagna.local
