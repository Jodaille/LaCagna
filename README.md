# LaCagna
===========

LaCagna: a Zend Framework application

## Installation

Install dependencies (use composer.json)

```sh
php composer.phar update
```

> It could take some time to get ZendFramework and so on

### Create database

You will find a simple SQL file: [DbSample]
That will create a database named lacagna,
with a user valtom having a passowrd CHANGEME

### Database configuration
rename or duplicate the file
**doctrine.local.php.dist.dist** to **doctrine.local.php**

in **config/[autoload]** directory

Then edit values for database access: dbname, user, password ...

Update database schema:
```sh
php public/index.php  orm:schema-tool:update --force
```

Database will be updated from [Entities].

Then you can add roles using [RoleEntries] SQL file.

[autoload]:https://github.com/Jodaille/LaCagna/tree/master/config/autoload
[Entities]:https://github.com/Jodaille/LaCagna/tree/master/module/LaCagnaProduct/src/LaCagnaProduct/Entity
[DbSample]:https://github.com/Jodaille/LaCagna/blob/master/docs/create_database_sample.sql
[RoleEntries]:https://github.com/Jodaille/LaCagna/blob/master/docs/add_role_entries.sql
