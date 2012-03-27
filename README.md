AdminAid extension for eZ Publish
=============

* Functionality to log in as any user from admin user, without password. 

* Also gives a detailed overview of content object data, an easy interface
for translation of content classes, functionality for searching for
id's in the database, as well as a list of content objects based on 
specified class.


What is AdminAid ?
-----------

AdminAid started as a simple module to be able to switch users
easily while debugging. After that I decided to extend it a little,
and make a proper extension out of it. Today you can also view 
detailed content object data, and a list of all objects based on
a class. Latest addition is a class translation tool.
More functionality may come in the future.

I do not recommend using this extension on live servers for more
than a limited timespan. It does represent a potential security
risk, even though in theory it should be secure. You are hereby warned.


Requirements
-----------

* Recently tested on eZ Publish Community Build 2012.02
* Previously tested on eZ Publish 4.1, 4.2 and 4.3

AdminAid is a well written extension and should work normally on most versions of eZ Publish.


Installation
-----------

See the documentation in doc/INSTALL.md for detailed installation instructions.


Usage
-----------

See the documentation in doc/USAGE.md for detailed instructions on how to use AdminAid and how it works.



Copyright
-----------

AdminAid is Copyright (C) 2010 - 2012 A.Bakkeboe. All rights reserved.

See: doc/COPYRIGHT.md for more information on the terms of the copyright and license


License
-----------

GNU General Public License v2.0

This program is free software; you can redistribute it and/or
modify it under the terms of version 2.0 of the GNU General
Public License as published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with AdminAid in doc/LICENSE.  If not, see <http://www.gnu.org/licenses/>.

