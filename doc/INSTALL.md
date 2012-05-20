AdminAid Install
=============

o What is AdminAid

AdminAid started as a simple module to be able to switch users
easily while debugging. After that I decided to extend it a little,
and make a proper extension out of it. Today you can also view 
detailed content object data, and a list of all objects based on
a class. Latest addition is a class translation tool.
More functionality may come in the future.

I do not recommend using this extension on live servers for more
than a limited timespan. It does represent a potential security
risk, even though in theory it should be secure. You are hereby warned.


o Requirements

* Recently tested on eZ Publish Community Build 2012.02
* Previously tested on eZ Publish 4.1, 4.2 and 4.3

AdminAid is a well written extension and should work normally on most versions of eZ Publish.


o Installation

Extract extension to the extension/adminaid/ directory.

Activate the new extension by adding it in 
settings/override/site.ini.append.php like this:

[ExtensionSettings]
ActiveExtensions[]=adminaid


o Settings

Have a look at the settings/aid.ini.append.php file for more settings you can customize.


Clear cache.

Add access to the module/views for any users who need to use this functionality.


o Usage 

See the documentation in doc/USAGE.md for detailed instructions on how to use AdminAid and how it works.

