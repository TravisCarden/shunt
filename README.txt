
CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Installation
 * Usage
 * Implementation


INTRODUCTION
------------

  "In electronics, a shunt is a device which allows electric current to pass
  around another point in the circuit by creating a low resistance path."
  - source: http://en.wikipedia.org/wiki/Shunt_(electrical)

Shunt module provides a facility for developers to create virtual "shunts" that
site administrators can enable (or "trip") in emergency situations, instructing
Drupal to fail gracefully.

For example, you might create a shunt that disables certain expensive database
operations. In the case of an overwhelming traffic event, like a denial of
service (DOS) attack, a site administrator could trip the shunt and thereby
reduce load on the server and save legitimate users the frustration of getting
white screens or losing form submissions.

This is an API module. It doesn't do anything by itself. Rather, it provides
module developers the ability to define shunts and make functionality dependant
on them. It also gives site administrators the ability to enable and disable
said shunts via the web UI or Drush.


INSTALLATION
------------

Shunt module is installed in the usual way. See
https://drupal.org/documentation/install/modules-themes/modules-8.


USAGE
-----

Shunts can be enabled and disabled via the web UI at admin/config/system/shunt
or via Drush. For a list of available Drush commands execute the following:

  drush --filter=shunt


IMPLEMENTATION
--------------

For instructions on defining shunts or shunt-enabling a module, see
shunt.api.php. For a working example see the included Shunt Example module.
