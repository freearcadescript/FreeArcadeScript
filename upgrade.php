<?php
include('includes/config.php');
include_once ('includes/db.class.php');
mysql_connect("$dbhost", "$dbuser", "$dbpass") or die(mysql_error());
mysql_select_db("$dbname") or die(mysql_error());

if(isset($_POST['submit'])){

mysql_query("ALTER TABLE dd_categories RENAME TO fas_categories");
mysql_query("ALTER TABLE blogcategories RENAME TO fas_blogcategories");
mysql_query("ALTER TABLE blogcomments RENAME TO fas_blogcomments");
mysql_query("ALTER TABLE blogentries RENAME TO fas_blogentries");
mysql_query("ALTER TABLE dd_links RENAME TO fas_links");
mysql_query("ALTER TABLE dd_games RENAME TO fas_games");
mysql_query("ALTER TABLE dd_comments RENAME TO fas_comments");
mysql_query("ALTER TABLE dd_messages RENAME TO fas_messages");
mysql_query("ALTER TABLE dd_settings RENAME TO fas_settings");
mysql_query("ALTER TABLE dd_users RENAME TO fas_users");
mysql_query("ALTER TABLE ratings RENAME TO fas_ratings");
mysql_query("ALTER TABLE newsletter RENAME TO fas_newsletter");
mysql_query("ALTER TABLE pagecategories RENAME TO fas_pagecategories");
mysql_query("ALTER TABLE pageentries RENAME TO fas_pageentries");
mysql_query("ALTER TABLE dd_user_favorites RENAME TO fas_user_favorites");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_report_comments` (
  `id` int(11) NOT NULL NOT NULL auto_increment,
  `comment` varchar(250) NOT NULL,
  `blogid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_agffeed` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `agf_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `thumb_url` varchar(200) NOT NULL,
  `file_url` varchar(200) NOT NULL,
  `width` int(4) NOT NULL,
  `height` int(4) NOT NULL,
  `category` varchar(40) NOT NULL,
  `installed` int(1) NOT NULL DEFAULT '0',
  `instructions` text NOT NULL,
  `tags` varchar(200) NOT NULL,
  `highscores` varchar(60) NOT NULL,
  `ads` varchar(60) NOT NULL,
  `zip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gametag` (`agf_id`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; ");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_gamestats` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numbers` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3;");

mysql_query("INSERT INTO `fas_gamestats` VALUES
('1', 'totalplays', '0'),
('2', 'dayplays', '0');");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_report_game` (
  `ID` int(11) NOT NULL NOT NULL auto_increment,
  `gamename` varchar(250) NOT NULL,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_onlineuser` (
  `timestamp` int(15) NOT NULL default '0',
  `ip` varchar(40) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_themes` (
  `ID` int(11) NOT NULL NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `template` varchar(250) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `default` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ; ");

mysql_query("INSERT INTO `fas_themes` (`name`, `template`, `active`, `default`) VALUES('Monster', 'monster', '1', '1'); ");

mysql_query("ALTER TABLE  `fas_categories` ADD  `visible` tinyint(1) NOT NULL default '1'; ");

mysql_query("ALTER TABLE  `fas_users` ADD  `salt` varchar(3) NOT NULL AFTER `password` ;");
mysql_query("ALTER TABLE  `fas_users` ADD  `template` varchar(250) NOT NULL default 'default' AFTER `plays` ;");
mysql_query("ALTER TABLE  `fas_users` ADD  `joindate` varchar(255) NOT NULL AFTER `user_level` ;");
mysql_query("ALTER TABLE  `fas_users` ADD  `activation_key` VARCHAR(255) NOT NULL; ");
mysql_query("ALTER TABLE  `fas_users` ADD  `status` VARCHAR(255) NOT NULL; ");
mysql_query("ALTER TABLE  `fas_users` ADD  `pass_answer` VARCHAR(255) NOT NULL; ");
mysql_query("ALTER TABLE  `fas_users` ADD  `pass_question` VARCHAR(255) NOT NULL; ");
mysql_query("ALTER TABLE  `fas_users` ADD  `new_email` VARCHAR(255) NOT NULL,
ADD  `new_email_key` VARCHAR( 255 ) NOT NULL; ");
mysql_query("UPDATE `fas_users` SET `activation_key`='0' WHERE `userid`=0; ");
mysql_query("UPDATE `fas_users` SET `activation_key`='0' WHERE `userid`=1; ");
mysql_query("UPDATE fas_users SET `userid` = '0' WHERE `username` ='Guest' LIMIT 1 ; ");


mysql_query("ALTER TABLE  `fas_settings` ADD  `email_on` int(11) NOT NULL default '1' AFTER `limitboxgames` ;");
mysql_query("ALTER TABLE  `fas_settings` ADD  `taf_on` int(11) NOT NULL default '1' AFTER `comments_on` ;");
mysql_query("ALTER TABLE  `fas_settings` ADD  `fbcomments_on` int(11) NOT NULL default '1' AFTER `taf_on` ;");
mysql_query("ALTER TABLE  `fas_settings` ADD  `showpages` TINYINT(1) NOT NULL DEFAULT '0' AFTER `showblog` ;");
mysql_query("ALTER TABLE  `fas_settings` ADD  `analytics` text NOT NULL  AFTER `belowgames` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `socialmedia1` text NOT NULL AFTER `analytics` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `socialmedia2` text NOT NULL AFTER `socialmedia1` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `socialmedia3` text NOT NULL AFTER `socialmedia2` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `socialmedia4` text NOT NULL AFTER `socialmedia3` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `socialmedia5` text NOT NULL AFTER `socialmedia4` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `socialmedia6` text NOT NULL AFTER `socialmedia5` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `socialmedia7` text NOT NULL AFTER `socialmedia6` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `socialmedia8` text NOT NULL AFTER `socialmedia7` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `socialmedia9` text NOT NULL AFTER `socialmedia8` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `socialmedia10` text NOT NULL AFTER `socialmedia9` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `facebookappid` text NOT NULL AFTER `socialmedia10` ; ");

mysql_query("ALTER TABLE  `fas_settings` ADD `avatar_on` int(11) NOT NULL default '0' AFTER `metadescr` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `aimg` text NOT NULL AFTER `avatar_on` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `gender_on` int(11) NOT NULL default '0' AFTER `aimg` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `mimg` text NOT NULL AFTER `gender_on` ; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `fimg` text NOT NULL AFTER `mimg` ; ");

mysql_query("ALTER TABLE  `fas_settings` ADD  `version` varchar(12) NOT NULL DEFAULT '3.0'; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `disabled` char(3) NOT NULL DEFAULT 'no'; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `seoheading` text NOT NULL; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `seotext` text NOT NULL; ");



mysql_query("UPDATE fas_settings SET
                    			analytics='',
 					socialmedia1='#',
 					socialmedia2='#',
 					socialmedia3='#',
 					socialmedia4='#',
 					socialmedia5='#',
 					socialmedia6='#',
 					socialmedia7='#',
 					socialmedia8='#',
 					socialmedia9='#',
 					socialmedia10='',
 					facebookappid=''") ;


echo '<div class=\'msg\'>Updated.</div><br />
Upgrade is Now Complete!<br />
Please delete the upgrade.php and install.php files.';
exit;

} else {

echo '<form action=\'upgrade.php\' method=\'POST\'>
	<table align=\'center\' cellpadding=\'5\'>
		<tr>
				<th class=\'header5\' colspan=\'2\'><b>Please back up your files and database before proceeding!</b></th>
		</tr>

		<tr>
				<th colspan=\'2\' class=\'header5\'><input type=\'submit\' name=\'submit\' value=\'Update\'></th>
	</table>
	</form>
';
}
?>