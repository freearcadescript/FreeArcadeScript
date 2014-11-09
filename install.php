<?php
include('includes/config.php');
include_once ('includes/db.class.php');
$config = new config();

mysql_connect($config->getHost(), $config->getUser(), $config->getPass()) or die(mysql_error());
mysql_select_db($config->getName()) or die(mysql_error());



if(isset($_POST['submit'])){

	$ssitename = $_POST['sitename'];
	$sdomain = $_POST['domain'];
	$directorypath = $_POST['directorypath'];
	$stemplate = $_POST['template'];
	$sgamesfolder = $_POST['gamesfolder'];
	$sgamesthumbs = $_POST['thumbsfolder'];
	$slimitboxgames = $_POST['limitboxgames'];
	$sgamesonpage = $_POST['gamesonpage'];
	$scomments_on = $_POST['comments_on'];
	$sautoapprovecomments = $_POST['autoapprovecomments'];
	$sseo_on = $_POST['seo_on'];
	$senabled_code = $_POST['enabled_code'];
	$email = $_POST['email'];


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
  `total_played` int(11) NOT NULL DEFAULT '0',
  `played_today` int(11) NOT NULL,
  `timestamp` varchar(600) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2;");

mysql_query("INSERT INTO `fas_gamestats` (`id`, `total_played`, `played_today`, `timestamp`) VALUES
(1, 0, 0, '01:01:2014 12:00 AM');");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_report_game` (
  `ID` int(11) NOT NULL NOT NULL auto_increment,
  `gamename` varchar(250) NOT NULL,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_categories` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `tags` text NOT NULL,
  `metadescr` text NOT NULL,
  `active` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;");

mysql_query("INSERT INTO `fas_categories` (`ID`, `name`, `tags`, `metadescr`, `active`) VALUES
(1, 'Sports', '', '', 1),
(2, 'Puzzle', '', '', 1),
(3, 'Arcade', '', '', 1),
(4, 'Shooter', '', '', 1),
(5, 'Adventure', '', '', 1),
(6, 'Strategy', '', '', 1),
(7, 'Dress Up', '', '', 1),
(8, 'Casino', '', '', 1),
(9, 'Action', '', '', 1),
(10, 'Other', '', '', 1);");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_blogcategories` (
  `categoryid` int(11) NOT NULL auto_increment,
  `topcategory` int(11) NOT NULL default '1',
  `categoryname` varchar(50) NOT NULL,
  `activate` tinyint(1) NOT NULL,
  `metatags` text NOT NULL,
  `metadescr` text NOT NULL,
  PRIMARY KEY  (`categoryid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_blogcomments` (
  `commentid` int(11) NOT NULL auto_increment,
  `blogentryid` int(11) NOT NULL,
  `commenttitle` varchar(50) NOT NULL,
  `commentbody` longtext NOT NULL,
  `commenter` varchar(50) NOT NULL,
  `commenterid` int(11) NOT NULL,
  `commenterurl` varchar(50) NOT NULL,
  `visible` tinyint(1) NOT NULL default '0',
  `commentdate` varchar(250) NOT NULL,
  `ipaddress` text NOT NULL,
  PRIMARY KEY  (`commentid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_blogentries` (
  `entryid` int(11) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `entrydate` date NOT NULL,
  `visible` tinytext NOT NULL,
  `category` varchar(50) NOT NULL,
  `tags` varchar(100) NOT NULL,
  PRIMARY KEY  (`entryid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_links` (
  `ID` int(11) NOT NULL auto_increment,
  `title` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `hits` int(11) NOT NULL default '0',
  `dateadded` varchar(250) NOT NULL,
  `activate` int(1) NOT NULL default '0',
  `IPaddress` text NOT NULL,
  `linkbackreq` tinyint(1) NOT NULL default '1',
  `linkbackat` varchar(60) NOT NULL,
  `emailaddress` varchar(80) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_games` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `description` longtext NOT NULL,
  `file` varchar(250) NOT NULL,
  `width` varchar(250) NOT NULL,
  `height` varchar(250) NOT NULL,
  `category` int(11) NOT NULL,
  `thumb` varchar(250) NOT NULL,
  `dateadded` int(11) NOT NULL,
  `type` int(11) NOT NULL default '1',
  `thumburl` text NOT NULL,
  `enabledcode` longtext NOT NULL,
  `views` int(11) NOT NULL default '0',
  `active` tinyint(1) NOT NULL default '1',
  `tags` varchar(100) NOT NULL,
  `highscore` bigint(20) NOT NULL,
  `highscoreable` tinyint(1) NOT NULL default '0',
  `highscoreuser` int(11) NOT NULL,
  `highscoredate` varchar(20) NOT NULL,
  `highscoreip` text NOT NULL,
  `gameadder` int(11) NOT NULL,
  `adderip` text NOT NULL,
  `sponsor` text NOT NULL,
  `sponsordate` int(11) NOT NULL,
  `sponsorexpire` int(11) NOT NULL,
  `sponsornotes` text NOT NULL,
  `sponsoractive` tinyint(1) NOT NULL default '0',
  `ads1` text NOT NULL,
  `ads2` text NOT NULL,
  `ads3` text NOT NULL,
  `headerspace` text NOT NULL,
  `footerspace` text NOT NULL,
  `abovegames` text NOT NULL,
  `belowgames` text NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_comments` (
  `ID` int(11) NOT NULL auto_increment,
  `gameid` int(11) NOT NULL,
  `commenter` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `date` varchar(250) NOT NULL,
  `approved` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_messages` (
  `ID` int(11) NOT NULL auto_increment,
  `from_userid` int(11) NOT NULL,
  `to_userid` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `content` longtext NOT NULL,
  `status` int(11) NOT NULL default '0',
  `datesent` varchar(250) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_onlineuser` (
  `timestamp` int(15) NOT NULL default '0',
  `ip` varchar(40) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_settings` (
  `domain` varchar(250) NOT NULL,
  `directorypath` varchar(250) NOT NULL,
  `tzone` varchar(250) NOT NULL,
  `slogan` varchar(250) NOT NULL,
  `template` varchar(250) NOT NULL,
  `gamesfolder` varchar(250) NOT NULL,
  `thumbsfolder` varchar(250) NOT NULL,
  `limitboxgames` int(11) NOT NULL,
  `email_on` int(11) NOT NULL default '1',
  `comments_on` int(11) NOT NULL default '1',
  `taf_on` int(11) NOT NULL default '1',
  `fbcomments_on` int(11) NOT NULL default '1',
  `autoapprovecomments` int(11) NOT NULL,
  `seo_on` int(11) NOT NULL,
  `sitename` varchar(250) NOT NULL,
  `gamesonpage` int(11) NOT NULL,
  `enabledcode_on` int(11) NOT NULL default '1',
  `bannersleft` text NOT NULL,
  `bannersright` text NOT NULL,
  `ads1` text NOT NULL,
  `ads2` text NOT NULL,
  `ads3` text NOT NULL,
  `headerspace` text NOT NULL,
  `footerspace` text NOT NULL,
  `abovegames` text NOT NULL,
  `belowgames` text NOT NULL,
  `analytics` text NOT NULL,
  `socialmedia1` text NOT NULL,
  `socialmedia2` text NOT NULL,
  `socialmedia3` text NOT NULL,
  `socialmedia4` text NOT NULL,
  `socialmedia5` text NOT NULL,
  `socialmedia6` text NOT NULL,
  `socialmedia7` text NOT NULL,
  `socialmedia8` text NOT NULL,
  `socialmedia9` text NOT NULL,
  `socialmedia10` text NOT NULL,
  `facebookappid` text NOT NULL,
  `showwebsitelimit` int(11) NOT NULL default '10',
  `supportemail` varchar(60) NOT NULL,
  `showblog` tinyint(1) NOT NULL default '1',
  `blogentriesshown` int(11) NOT NULL default '5',
  `blogcharactersshown` int(11) NOT NULL default '300',
  `blogcommentpermissions` tinyint(1) NOT NULL default '1',
  `blogcommentsshown` int(11) NOT NULL default '10',
  `blogfollowtags` varchar(10) NOT NULL default 'nofollow',
  `blogcharactersrss` int(11) NOT NULL default '500',
  `showforum` tinyint(1) NOT NULL default '1',
  `metatags` text NOT NULL,
  `metadescr` text NOT NULL,
  `avatar_on` int(11) NOT NULL default '0',
  `aimg` text NOT NULL,
  `gender_on` int(11) NOT NULL default '0',
  `mimg` text NOT NULL,
  `fimg` text NOT NULL,
  PRIMARY KEY  (`domain`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1; ");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_users` (
  `userid` int(11) NOT NULL auto_increment,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `salt` varchar(3) NOT NULL,
  `email` varchar(250) NOT NULL,
  `user_level` int(11) NOT NULL default '1',
  `joindate` varchar(255) NOT NULL,
  `plays` int(11) NOT NULL default '0',
  `template` varchar(250) NOT NULL default 'default',
  `newsletter` varchar(4) NOT NULL,
  `aim` varchar(50) NOT NULL,
  `icq` varchar(50) NOT NULL,
  `msn` varchar(50) NOT NULL,
  `yim` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `job` varchar(50) NOT NULL,
  `website` varchar(50) NOT NULL,
  `link1` varchar(50) NOT NULL,
  `link2` varchar(50) NOT NULL,
  `link3` varchar(50) NOT NULL,
  `link4` varchar(50) NOT NULL,
  `link5` varchar(50) NOT NULL,
  `link6` varchar(50) NOT NULL,
  `link7` varchar(50) NOT NULL,
  `link8` varchar(50) NOT NULL,
  `sex` varchar(4) NOT NULL,
  `interests` varchar(100) NOT NULL,
  `bio` varchar(250) NOT NULL,
  `ip` text NOT NULL,
  `bloglevel` tinyint(1) NOT NULL default '1',
  `forumlevel` tinyint(1) NOT NULL default '1',
  `gamelevel` tinyint(1) NOT NULL default '1',
  `signature` varchar(100) NOT NULL,
  `avatar` tinyint(1) NOT NULL default '0',
  `avatarfile` varchar(50) NOT NULL,
  PRIMARY KEY  (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_user_favorites` (
  `ID` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_ratings` (
  `id` int(11) NOT NULL auto_increment,
  `rating_id` varchar(80) NOT NULL,
  `rating_num` int(11) NOT NULL,
  `IP` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_newsletter` (
  `pageid` int(11) NOT NULL auto_increment,
  `sent` tinyint(1) NOT NULL default '0',
  `showpage` tinyint(1) NOT NULL default '0',
  `pagetitle` text,
  `pagebody` text,
  `pageauthor` text,
  `datesent` date NOT NULL,
  PRIMARY KEY  (`pageid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_pagecategories` (
  `categoryid` int(11) NOT NULL auto_increment,
  `topcategory` int(11) NOT NULL default '1',
  `categoryname` varchar(50) NOT NULL,
  `activate` tinyint(1) NOT NULL,
  `metatags` text NOT NULL,
  `metadescr` text NOT NULL,
  PRIMARY KEY  (`categoryid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_pageentries` (
  `entryid` int(11) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `entrydate` date NOT NULL,
  `visible` tinytext NOT NULL,
  `category` varchar(50) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `metadescription` varchar(300) NOT NULL,
  PRIMARY KEY  (`entryid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ; ");

mysql_query("CREATE TABLE IF NOT EXISTS `fas_themes` (
  `ID` int(11) NOT NULL NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `template` varchar(250) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `default` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ; ");


mysql_query("INSERT INTO `fas_blogcategories` (`categoryid`, `topcategory`, `categoryname`, `activate`, `metatags`, `metadescr`) VALUES
(1, 1, 'Main', 0, 'Main, general', 'Main blog category');");

$date = date('Y-m-d H:i:s');
mysql_query("INSERT INTO `fas_blogentries` VALUES
(1, 'Blog test', 'This is a test of the emergency blogging system, this is only a test. If this had been an actual blog you would be laughing by now.\r\n\r\n;)', 'admin', '$date', '1', '1', 'blog test 1');");

mysql_query("INSERT INTO `fas_links` (`ID`, `title`, `url`, `hits`, `dateadded`, `activate`, `IPaddress`) VALUES
(1, 'Free Arcade Script', 'http://freearcadescript.net', 0, '', 2, '');");

mysql_query("INSERT INTO fas_settings SET
 					domain='$sdomain',
 					directorypath='$directorypath',
 					slogan='',
 					template='$stemplate',
 					gamesfolder='$sgamesfolder',
 					thumbsfolder='$sgamesthumbs',
 					limitboxgames='$slimitboxgames',
 					comments_on='$scomments_on',
 					taf_on='',
 					fbcomments_on='',
 					autoapprovecomments='$sautoapprovecomments',
 					seo_on='$sseo_on',
 					sitename='$ssitename',
 					gamesonpage='$sgamesonpage',
 					enabledcode_on='$senabled_code',
 					bannersleft='bannersleft',
 					bannersright='bannersright',
 					ads1='ads1',
 					ads2='ads2',
 					ads3='ads3',
 					headerspace='headerspace',
 					footerspace='footerspace',
 					abovegames='abovegames',
 					belowgames='belowgames',
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

$time = time();
mysql_query("INSERT INTO `fas_users` (`userid`, `username`, `password`, `email`, `user_level`, `plays`, `newsletter`, `aim`, `icq`, `msn`, `yim`, `location`, `job`, `website`, `link1`, `link2`, `link3`, `link4`, `link5`, `link6`, `link7`, `link8`, `sex`, `interests`, `bio`, `ip`, `bloglevel`, `forumlevel`, `gamelevel`, `signature`, `avatar`, `avatarfile`, `joindate`) VALUES(0, 'Guest', 'hhhhhhhhhhhhhhhhh', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, 1, '', 0, '', '$time');");

$time = time();
mysql_query("INSERT INTO `fas_users` (`userid`, `username`, `password`, `email`, `user_level`, `plays`, `joindate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '$email', 2, 0, '$time')");
$date = date('Y-m-d H:i:s');
mysql_query("INSERT INTO `fas_newsletter` (`pageid`, `sent`, `showpage`, `pagetitle`, `pagebody`, `pageauthor`, `datesent`) VALUES(1, 1, 1, 'We want to hear from you!', 'We want to hear from you.\r\n\r\nWe want to hear what you want added or changed in here. Let us know. We are thinking a blog for starters, or a shoutbox.\r\n\r\n', 'Admin', '$date');");
mysql_query("INSERT INTO `fas_pagecategories` (`categoryid`, `topcategory`, `categoryname`, `activate`, `metatags`, `metadescr`) VALUES(1, 1, 'Main', 1, '', ''); ");
$date = date('Y-m-d H:i:s');
mysql_query("INSERT INTO `fas_pageentries` (`entryid`, `title`, `body`, `author`, `entrydate`, `visible`, `category`, `tags`, `metadescription`) VALUES(1, 'Demo Page', 'This is a demo of the pages\r\n\r\nYou may use HTML or JavaScript', '1', '$date', '1', '1', 'Demo Page', ''); ");
mysql_query("INSERT INTO `fas_themes` (`ID`, `name`, `template`, `active`, `default`) VALUES('1', 'Monster', 'monster', '1', '1'); ");


mysql_query("ALTER TABLE  `fas_users` ADD  `activation_key` VARCHAR( 255 ) NOT NULL; ");
mysql_query("ALTER TABLE  `fas_users` ADD  `status` VARCHAR( 255 ) NOT NULL; ");
mysql_query("UPDATE `fas_users` SET `activation_key`='0' WHERE `userid`=0; ");
mysql_query("UPDATE `fas_users` SET `activation_key`='0' WHERE `userid`=1; ");
mysql_query("ALTER TABLE  `fas_users` ADD  `pass_answer` VARCHAR( 255 ) NOT NULL; ");
mysql_query("ALTER TABLE  `fas_users` ADD  `pass_question` VARCHAR( 255 ) NOT NULL; ");
mysql_query("ALTER TABLE  `fas_users` ADD  `new_email` VARCHAR( 255 ) NOT NULL,
ADD  `new_email_key` VARCHAR( 255 ) NOT NULL; ");
mysql_query("ALTER TABLE `fas_settings` ADD `showpages` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `showblog` ;");
mysql_query("UPDATE fas_users SET `userid` = '0' WHERE `username` ='Guest' LIMIT 1 ; ");

mysql_query("ALTER TABLE  `fas_categories` ADD  `visible` tinyint(1) NOT NULL default '1'; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `version` varchar(12) NOT NULL DEFAULT '3.0.1'; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `disabled` char(3) NOT NULL DEFAULT 'no'; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `seoheading` text NOT NULL; ");
mysql_query("ALTER TABLE  `fas_settings` ADD  `seotext` text NOT NULL; ");

echo '<div class=\'msg\'>Updated.</div><br />
Please delete the install.php file. <br /><br />Username: admin Password: admin<br />
These are to login to the admin panel (default admin account). CHANGE THEM NOW!!! ';
exit;

} else {

echo '<form action=\'install.php\' method=\'POST\'>
	<table align=\'center\' cellpadding=\'5\'>
		<tr>
			<th class=\'header5\' colspan=\'2\'>Settings</th>
		</tr>
			<td class=\'content5\'>Site Name:</td>
			<td class=\'content5\'><input type=\'text\' name=\'sitename\' size=\'40\' value=\'\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Domain:</td>
			<td class=\'content5\'><input type=\'text\' name=\'domain\' size=\'40\' value=\'http://\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Directory Path:</td>
			<td class=\'content5\'><input type=\'text\' name=\'directorypath\' size=\'40\' value=\'/home/hostingaccountname/public_html/\'></td>
		</tr>

		</tr>
			<td class=\'content5\'>Template:</td>
			<td class=\'content5\'><input type=\'text\' name=\'template\' size=\'40\' value=\'monster\' readonly></td>
		</tr>
		</tr>
			<td class=\'content5\'>Games Folder:<br /><small>
			Make sure you chmod the folder to 0777
			</small></td>
			<td class=\'content5\'><input type=\'text\' name=\'gamesfolder\' size=\'40\' value=\'games\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Thumbs Folder:<br /><small>
			Make sure you chmod the folder to 0777
			</small></td>
			<td class=\'content5\'><input type=\'text\' name=\'thumbsfolder\' size=\'40\' value=\'games/thumbs\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Games On Home:<br /><small>
			How many games in each category do you want to be displayed in each box on the homepage?
			</small></td>
			<td class=\'content5\'><input type=\'text\' name=\'limitboxgames\' size=\'40\' value=\'3\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Games in category per page:</td>
			<td class=\'content5\'><input type=\'text\' name=\'gamesonpage\' size=\'40\' value=\'12\'></td>
		</tr>
		</tr>
			<td class=\'content5\'>Comments Enabled:</td>
			<td class=\'content5\'><select type=\'dropdown\' name=\'comments_on\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\'>No</option>
						</select></td>
		</tr>
		</tr>
			<td class=\'content5\'>Auto Approve Comments:</td>
			<td class=\'content5\'><select type=\'dropdown\' name=\'autoapprovecomments\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\'>No</option>
						</select></td>
		</tr>
		</tr>
			<td class=\'content5\'>SEO On:</td>
			<td class=\'content5\'><select type=\'dropdown\' name=\'seo_on\'>
							<option value=\'0\'>No</option>
							<option value=\'1\'>Yes</option>
						</select></td>
		</tr>
		</tr>
			<td class=\'content5\'>Allow Enabled Code:</td>
			<td class=\'content5\'><select type=\'dropdown\' name=\'enabled_code\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\'>No</option>
						</select></td>
		</tr>
		</tr>
			<td class=\'content5\'>Your email:</td>
			<td class=\'content5\'><input type=\'text\' name=\'email\' size=\'40\'></td>
		</tr>


			<tr>
				<th colspan=\'2\' class=\'header5\'><input type=\'submit\' name=\'submit\' value=\'Update\'></th>
	</table>
	</form>
';
}
?>