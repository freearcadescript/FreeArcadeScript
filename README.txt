Thanks for downloading the FREE arcade script from http://freearcadescript.net

License:
-------
This is free to use for your own needs. You may not redistribute it, nor claim it as your
own. It is offered with out waranty of any type. You may not hold anybody liable if 
it does not meets your needs or fill any specific purpose. We retain all rights including 
the right to alter these terms with or without notice. You may not use this script if 
you do not agree to these terms, or any modifications made to them in the future. your 
use of this script constitutes acceptace of these terms.



Fresh Install:
-------------

PLEASE NOTE BEFORE INSSTALLING: This script is not set up to run from a subdirectory. It 
works best from the root directory of the domain, or subdomain. It can be run from a
subdirectory, but you will need to edit to .htaccess file acordingly. You will need 
to add the directory path the the begining of the target URL on every line in the 
.htaccess file, or it will not work. Some have reported it to work by simply removing 
the "/" from the begining of each target URL, but this may not work for everybody. If 
you need help with this, ask for it in the support forums.


1.) create a new database, and assign a user to the database you created.

2.) open includes/config.php edit it to match your database details and path to cache directory. If 
you do not set the proper path to the cache folder it will spit out errors! You can use a /cache 
directory that is under public_html, but one that is not under it, inaccessable to the public, is 
more secure. Either way, you need to edit in the file includes/configs.php and set proper permissions.
See below for more info.

3.) Upload the files to your server.

4.) Run yourdomain.com/install.php to set up your settings, and to install the default
users. DO NOT RUN MORE THAN ONCE!

5.) delete the install.php file after step 4 is completed.

6.) The following files must be chmod(set permissions) to 777:
 
           /games
           /games/thumbs
           /cache 
           /avatars 
           /includes/hitcounter.txt

If permissions are not set to 777, the script will spit out errors! 
All other files and folders need to be set to 755.

7) Login using the username admin and password admin and change the password! For security 
reasons we recomend either deleting the admin account or making it a non admin one.

8.) Go in and set your site settings through the admin panel.


PLEASE NOTE!!!! If no categories or games are loaded, the script will spit out some errors on some pages.
They will also display similar errors if none are activated in the admin panel.



Cache directory
-------------------
It is suggested that the cache directory be set up under your root hosting account folder instead of 
under the public_html folder. This is for security reasons. Some accounts will not allow this though, so
it is aceptable to put it where you need to. Make sure you edit the file /includes/config.php where it 
sets the path to it, or you will get errors from the script. It also needs premissions set to 777. It is 
more secure to put the cache directory where visitors can NOT access it, so try to not place it under 
the public_html directory if at all possible. It does not need to be named "cache" either. We call it 
that to make the instructions easier to follow, but it can be named something else for security purposes.
If you can not place it in the root account folder of your hosting, at least consider renaming it. Just 
make sure to get the correct path into the includes/config.php file.


Default login after installation has been completed:
User: admin
Pass: admin
Change it imeadiately! For security purposes we recomend setting up a different user as admin and 
deleting the admin account, or making that account a non admin one.





Upgrade From V2.0 - V2.1:
-----------------
1.) BACK UP YOUR FILES AND DATABASE FIRST!

2.) Make a copy of your includes/config.php file

3.) Run yourdomain.com/upgrade.php

3.) Copy files over the old files on your server.

4.) Delete upgrade.php and install.php

5.) Go in and change your site settings through your 
admin panel as needed.

6.) Test it out, and redo your template to your tastes.


Any problems, please open a topic on the forums.
http://freearcadescript.net/forums/index.php?action=forum
Copyrighted to freearcadescript.net

This is FREE software, you may NOT sell this, please leave credits and the backlink
back to our site, unless you pay for copyright removal.

For copyright removal please contact us on the forum or email us support@freearcadescript.net


Thanks again,
FreeArcadeScript.net staff.