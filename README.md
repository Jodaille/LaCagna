# LaCagna
===========

LaCagna: a Zend Framework application

LaCagna is a menu application, it allows to manage products.

The first aim was to be able to easily choice your drink :-)

We use [ZendSkeletonApplication] as default layout/CSS,
It should be "mobile first".

## Objectives

- [x] Products listing
- [x] Categories management (tree)
- [x] Simple images fetch (thumbs generation)
- [x] User roles
- [x] Dynamic navigation
- [ ] Articles/characteristics/prices management
- [ ] Generate ready to print menu

## Installation

Install dependencies (use composer.json)

```sh
php composer.phar update
```

> It could take some time to get ZendFramework and so on

### Create database

You will find a simple SQL file: [DbSample]

That will create a database named **lacagna**,

with a user **valtom** having a password **CHANGEME**

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
[ZendSkeletonApplication]:https://github.com/zendframework/ZendSkeletonApplication
