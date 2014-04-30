Demo Project for Saving Sight
=======================

Introduction
------------
This is a simple, skeleton application using the ZF2 MVC layer and module
systems. This application is meant to be a demonstration project to show
aquired skills for Saving Sight.


Installation
------------
`Run the sql script located at data/database.sql enter your information
into global.php and local.php. Add your connection params to global.php &
local.php in the /config/autoload/ directory. Add your vhost config and your ready to go.`


By default, this application is configured to load all configs in
`./config/autoload/{,*.}{global,local}.php`. Doing this provides a
location for a developer to drop in configuration override files provided by
modules, as well as cleanly provide individual, application-wide config files
for things like database connections, etc.
