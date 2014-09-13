1. Download the version you wish and unzip it on your computer.
2. Using the tools provided by your hosting provider, add a database to your hosting account and record the name carefully.
3. Using Notepad (or any other text editor you have), edit the file /includes/config.php with the following:
   - Where it says USER change the text in quotes to the database username that your webhosting provider has given you.
   - Where it says PASS change the text in quotes to the database password that your webhosting provider has given you.
   - Where it says NAME change the text in quotes to the database name that you made in step 3.
   - Where it says /home/hostingaccountname/cache/ change the text in quotes to the path to your website's cache. Please check with your hosting provider for this information.
4. Save all changes that you have made.
5. Copy the contents of the FAS directory to the root web directory your web hosting provider (most likely public_html)
6. Go to the install.php file with your web browser. This is in the root directory of your domain - i.e. http://www.yourdomain.com/install.php
7. Fill in the following information:
   - Under "Site Name", enter your site name - what you want your site to be called (e.g. My Game Site)
   - Under "Domain" enter the URL that the site is located at (e.g. http://www.yourdomain.com), Leave out the / at the end of the domain
   - Under "Directory Path" enter the location of the FAS directory on your hosting account (e.g. /home/myaccount/public_html)
   - Leave everything else at the default setting.
8. Click on "Update".
9. Delete the install.php file from your web hosting account.
10. Go to the location of your site (whatever you entered for "Domain" in the install page in step 7) in your web browser.
11. Congratulations - you now have your very own Arcade Site! If your site does not work please read the installation instructions in the FAS directory or you can always ask for help in the support forums.
