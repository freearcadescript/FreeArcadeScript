<?php
include ('includes/config.php');
include_once ('includes/db.class.php');
mysql_connect("$dbhost", "$dbuser", "$dbpass") or die(mysql_error());
mysql_select_db("$dbname") or die(mysql_error());



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
	


mysql_query("CREATE TABLE IF NOT EXISTS `dd_categories` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `tags` text NOT NULL,
  `metadescr` text NOT NULL,
  `active` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;");

mysql_query("INSERT INTO `dd_categories` (`ID`, `name`, `tags`, `metadescr`, `active`) VALUES
(1, 'First Category', '', '', 1),
(2, 'Second Category', '', '', 1);");





mysql_query("CREATE TABLE IF NOT EXISTS `blogcategories` (
  `categoryid` int(11) NOT NULL auto_increment,
  `topcategory` int(11) NOT NULL default '1',
  `categoryname` varchar(50) NOT NULL,
  `activate` tinyint(1) NOT NULL,
  `metatags` text NOT NULL,
  `metadescr` text NOT NULL,
  PRIMARY KEY  (`categoryid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");


mysql_query("INSERT INTO `blogcategories` (`categoryid`, `topcategory`, `categoryname`, `activate`, `metatags`, `metadescr`) VALUES(1, 1, 'Main', 0, 'Main, general', 'Main blog category');");



mysql_query("CREATE TABLE IF NOT EXISTS `blogcomments` (
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


mysql_query("CREATE TABLE IF NOT EXISTS `blogentries` (
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



mysql_query("INSERT INTO `blogentries` VALUES(1, 'Blog test', 'This is a test of the emergency blogging system, this is only a test. If this had been an actual blog you would be laughing by now.\r\n\r\n;)', 'admin', '2009-11-21', '1', '1', 'blog test 1');");




mysql_query("CREATE TABLE IF NOT EXISTS `dd_links` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;");

mysql_query("INSERT INTO `dd_links` (`ID`, `title`, `url`, `hits`, `dateadded`, `activate`, `IPaddress`) VALUES(1, 'script-place.com', 'http://script-place.com', 0, '1235433190', 1, '');");

mysql_query("INSERT INTO `dd_links` (`ID`, `title`, `url`, `hits`, `dateadded`, `activate`, `IPaddress`) VALUES(2, 'Free Arcade Script', 'http://freearcadescript.net', 0, '1239646822', 2, '97.114.113.112');");



mysql_query("CREATE TABLE IF NOT EXISTS `dd_games` (
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
  `active` tinyint(1) NOT NULL default '0',
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



mysql_query("CREATE TABLE IF NOT EXISTS `dd_comments` (
  `ID` int(11) NOT NULL auto_increment,
  `gameid` int(11) NOT NULL,
  `commenter` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `date` varchar(250) NOT NULL,
  `approved` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `dd_messages` (
  `ID` int(11) NOT NULL auto_increment,
  `from_userid` int(11) NOT NULL,
  `to_userid` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `content` longtext NOT NULL,
  `status` int(11) NOT NULL default '0',
  `datesent` varchar(250) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");








mysql_query("CREATE TABLE IF NOT EXISTS `dd_settings` (
  `domain` varchar(250) NOT NULL,
  `directorypath` varchar(250) NOT NULL,
  `template` varchar(250) NOT NULL,
  `gamesfolder` varchar(250) NOT NULL,
  `thumbsfolder` varchar(250) NOT NULL,
  `limitboxgames` int(11) NOT NULL,
  `comments_on` int(11) NOT NULL default '1',
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
  PRIMARY KEY  (`domain`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1; ");





 		mysql_query("INSERT INTO dd_settings SET 
 					domain='$sdomain',
 					directorypath='$directorypath',
 					template='$stemplate',
 					gamesfolder='$sgamesfolder',
 					thumbsfolder='$sgamesthumbs',
 					limitboxgames='$slimitboxgames',
 					comments_on='$scomments_on',
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
 					belowgames='belowgames' ") ;



mysql_query("CREATE TABLE IF NOT EXISTS `dd_users` (
  `userid` int(11) NOT NULL auto_increment,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `user_level` int(11) NOT NULL default '1',
  `plays` int(11) NOT NULL default '0',
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

mysql_query("INSERT INTO `dd_users` (`userid`, `username`, `password`, `email`, `user_level`, `plays`, `newsletter`, `aim`, `icq`, `msn`, `yim`, `location`, `job`, `website`, `link1`, `link2`, `link3`, `link4`, `link5`, `link6`, `link7`, `link8`, `sex`, `interests`, `bio`, `ip`, `bloglevel`, `forumlevel`, `gamelevel`, `signature`, `avatar`, `avatarfile`) VALUES(0, 'Guest', 'hhhhhhhhhhhhhhhhh', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, 1, '', 0, '');");

mysql_query("INSERT INTO `dd_users` (`userid`, `username`, `password`, `email`, `user_level`, `plays`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'demo@email.com', 2, 0)");

mysql_query("UPDATE dd_users SET `userid` = '0' WHERE `username` ='Guest' LIMIT 1 ; ");


mysql_query("CREATE TABLE IF NOT EXISTS `dd_user_favorites` (
  `ID` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(11) NOT NULL auto_increment,
  `rating_id` varchar(80) NOT NULL,
  `rating_num` int(11) NOT NULL,
  `IP` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");



mysql_query("CREATE TABLE IF NOT EXISTS `newsletter` (
  `pageid` int(11) NOT NULL auto_increment,
  `sent` tinyint(1) NOT NULL default '0',
  `showpage` tinyint(1) NOT NULL default '0',
  `pagetitle` text,
  `pagebody` text,
  `pageauthor` text,
  `datesent` date NOT NULL,
  PRIMARY KEY  (`pageid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");


mysql_query("INSERT INTO `newsletter` (`pageid`, `sent`, `showpage`, `pagetitle`, `pagebody`, `pageauthor`, `datesent`) VALUES(1, 1, 1, 'We want to hear from you!', 'We want to hear from you.\r\n\r\nWe want to hear what you want added or changed in here. Let us know. We are thinking a blog for starters, or a shoutbox.\r\n\r\n', 'Admin', '2009-04-18');");




mysql_query("CREATE TABLE IF NOT EXISTS `pagecategories` (
  `categoryid` int(11) NOT NULL auto_increment,
  `topcategory` int(11) NOT NULL default '1',
  `categoryname` varchar(50) NOT NULL,
  `activate` tinyint(1) NOT NULL,
  `metatags` text NOT NULL,
  `metadescr` text NOT NULL,
  PRIMARY KEY  (`categoryid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");

mysql_query("CREATE TABLE IF NOT EXISTS `pageentries` (
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

mysql_query("ALTER TABLE `dd_settings` ADD `showpages` TINYINT( 1 ) NOT NULL DEFAULT '0' AFTER `showblog` ;");

mysql_query("INSERT INTO `pagecategories` (`categoryid`, `topcategory`, `categoryname`, `activate`, `metatags`, `metadescr`) VALUES(1, 1, 'Main', 1, '', ''); ");
mysql_query("INSERT INTO `pageentries` (`entryid`, `title`, `body`, `author`, `entrydate`, `visible`, `category`, `tags`, `metadescription`) VALUES(1, 'Demo Page', 'This is a demo of the pages\r\n\r\nYou may use HTML or JavaScript', '1', '2009-12-06', '1', '1', 'Demo Page', ''); ");



		echo '<div class=\'msg\'>Updated.</div><br />
		Please delete the install.php file. <br /><br />Username: admin Password: admin<br />
		These are to login to the admin panel (default admin account). CHANGE THEM NOW!!! ';
		exit;
	
}


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
			<td class=\'content5\'><input type=\'text\' name=\'directorypath\' size=\'40\' value=\'/home/hostingaccountname/public_html\'></td>
		</tr>

		</tr>
			<td class=\'content5\'>Template:</td>	
			<td class=\'content5\'><input type=\'text\' name=\'template\' size=\'40\' value=\'default\' readonly></td>
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
			<td class=\'content5\'><input type=\'text\' name=\'limitboxgames\' size=\'40\' value=\'5\'></td>
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
							<option value=\'1\'>Yes</option>
							<option value=\'0\'>No</option>
						</select></td>
		</tr>
		</tr>
			<td class=\'content5\'>Allow Enabled Code:</td>	
			<td class=\'content5\'><select type=\'dropdown\' name=\'enabled_code\'>
							<option value=\'1\'>Yes</option>
							<option value=\'0\'>No</option>
						</select></td>
		</tr>
			<tr>
				<th colspan=\'2\' class=\'header5\'><input type=\'submit\' name=\'submit\' value=\'Update\'></th>
	</table>
	</form>		
';
?>