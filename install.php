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
	$email = $_POST['email'];
	


mysql_query("CREATE TABLE IF NOT EXISTS `dd_categories` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL,
  `tags` text NOT NULL,
  `metadescr` text NOT NULL,
  `active` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;");

mysql_query("INSERT INTO `dd_categories` (`ID`, `name`, `tags`, `metadescr`, `active`) VALUES
(1, 'Sport', '', '', 1),
(2, 'Puzzle', '', '', 1),
(3, 'Life & Style', '', '', 1),
(4, 'Shooter', '', '', 1),
(5, 'Adventure', '', '', 1),
(6, 'Strategy', '', '', 1);");




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




mysql_query("INSERT INTO `dd_games` (`ID`, `name`, `description`, `file`, `width`, `height`, `category`, `thumb`, `dateadded`, `type`, `thumburl`, `enabledcode`, `views`, `active`, `tags`, `highscore`, `highscoreable`, `highscoreuser`, `highscoredate`, `highscoreip`, `gameadder`, `adderip`, `sponsor`, `sponsordate`, `sponsorexpire`, `sponsornotes`, `sponsoractive`, `ads1`, `ads2`, `ads3`, `headerspace`, `footerspace`, `abovegames`, `belowgames`) VALUES
	    (2, 'Hoop Fever Live', 'Shoot hoops with your friends and get the best score! Play against thousands of players online in a LIVE game!', '', '', '', 1, '', 1271102947, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_hoop-fever-live_515416_50x50_39.PNG', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=hoop-fever-live__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"always\"\\n       width=\\\"760\\\" height=\\\"500\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=hoop-fever-live\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"always\"        width=\"760\" height=\"500\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 3, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (3, 'High Speed Chase 2', 'Drive like a maniac on the highway and destroy the target vehicles as quickly as can to earn enough credits for medals. You\'ll need to finish each mission with at least a bronze medal to progress. You can use your credits to purchase and upgrade power-ups that will appear throughout mis', '', '', '', 1, '', 1271104595, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_high-speed-chase-2_456599_50x50_61.PNG', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=high-speed-chase-2__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"600\\\" height=\\\"500\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=high-speed-chase-2\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"600\" height=\"500\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 2, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (4, 'Slugger Baseball', 'Slugger Baseball Hardball Smackdown!', '', '', '', 1, '', 1271102947, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_slugger-baseball-3_104947_50x50_62.jpeg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=slugger-baseball-3__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"700\\\" height=\\\"420\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=slugger-baseball-3\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"700\" height=\"420\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 2, 1, '', 0, 0, 0, '', '', 0, '', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (5, 'Trick Hoops Challenge', 'Challenge the toughest basketball players and defeat them on the street, at their own game.', '', '', '', 1, '', 1271105283, 2, 'http://hzmedia.heyzap.com/thumbnail_games_trick-hoops-challenge_21201.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=trick-hoops-challenge__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"504\\\" height=\\\"400\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=trick-hoops-challenge\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"504\" height=\"400\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 1, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (6, 'Monster Truck Trials', 'You are a junior tester at the monster trucks factory. Get the best out of those monsters!', '', '', '', 1, '', 1271105339, 2, 'http://hzmedia.heyzap.com/thumbnail_games_monster-truck-trials_16171.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=monster-truck-trials__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"500\\\" height=\\\"400\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=monster-truck-trials\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"500\" height=\"400\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (7, 'Street Rally', 'Race through city streets in your monster truck! Bonus points and a speed boost given for squashing pedestrians.', '', '', '', 1, '', 1271105394, 2, 'http://hzmedia.heyzap.com/thumbnail_games_street-rally_16117.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=street-rally__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"600\\\" height=\\\"450\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=street-rally\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"600\" height=\"450\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (9, 'Bucket Ball 2', 'the next big thing when it comes to balls and buckets.', '', '', '', 2, '', 1271106075, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_bucketball-2-5_105160_50x50_4.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=bucketball-2-5__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"640\\\" height=\\\"480\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=bucketball-2-5\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"640\" height=\"480\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 1, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (10, 'Bloons', 'Fun new ninja kiwi game. Pop as many bloons as possible with the darts you are given each level.', '', '', '', 2, '', 1271106128, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_bloons-13_317316_50x50_69.PNG', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=bloons__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"640\\\" height=\\\"480\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=bloons\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"640\" height=\"480\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(11, 'Portal the flash version', 'Portal: The Flash Version includes over 40 challenging, portals thinking levels, which features almost every feature the real game does, in 2d - energy balls, cubes, turrets and even the famous crusher from the trailer. The game also includes a console to', '', '', '', 2, '', 1271106411, 2, 'http://hzmedia.heyzap.com/thumbnail_games_portal-the-flash-version_16630.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=portal-the-flash-version__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"700\\\" height=\\\"393\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=portal-the-flash-version\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"700\" height=\"393\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(12, 'Sacred Seasons', 'Sacred Seasons is a free to play MMORPG. The Heartlands was once a peaceful place, but now legends says there is a corrupted great spirit, driven mad and set loose upon the world. Pockets of this madness are beginning to sprout up, and spread like a cancerous plague. It?s up to you and your friends to answer the call to arms and defend the Heartlands. ', '', '', '', 2, '', 1271106521, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_sacred-seasons-mmorpg-6_209151_50x50_71.PNG', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=sacred-seasons-mmorpg__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"740\\\" height=\\\"600\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=sacred-seasons-mmorpg\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"740\" height=\"600\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (13, 'Tilt', 'Hi, hope you enjoy this game. :) Just use the mouse to tilt the board. Programming, Graphics, Level &amp; Game Design: Jan Rigerl Additional Level Design: Jonas Johansson Music/Sound: Daniel Beckman It\'s created with the use of papervision 3d and box2d. Two very nice libraries.', '', '', '', 2, '', 1271106599, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_tilt_130696_50x50_91.PNG', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=tilt-5__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"650\\\" height=\\\"500\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=tilt-5\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"650\" height=\"500\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 8, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (14, 'Fish Story', 'Play with your friends to build the best aquarium with amazing fish and decorations!', '', '', '', 3, '', 1271106824, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_fishstory_516131_50x50_47.PNG', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=fishstory__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"always\"\\n       width=\\\"760\\\" height=\\\"600\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=fishstory\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"always\"        width=\"760\" height=\"600\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 1, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (15, 'Magic FIngers', 'This Game Contains Adult Themes?', '', '', '', 3, '', 1271107417, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_magic-fingers_444611_50x50_70.PNG', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=magic-fingers__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"720\\\" height=\\\"480\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=magic-fingers\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"720\" height=\"480\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
 (16, 'Magic Pen', '\"Magic PenDraw Your Win!\"', '', '', '', 3, '', 1271107490, 2, 'http://hzmedia.heyzap.com/thumbnail_games_magic-pen_20661.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=magic-pen__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"800\\\" height=\\\"520\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=magic-pen\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"800\" height=\"520\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(17, 'Make Me Over', '\"Make Me OverHow Do I Look?\"', '', '', '', 3, '', 1271107637, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_make-me-over_53407_50x50_88.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=make-me-over__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"800\\\" height=\\\"600\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=make-me-over\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"800\" height=\"600\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (18, 'Sketch', 'Drawing puzzle game.', '', '', '', 3, '', 1271107685, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_sketch_54539_50x50_88.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=sketch__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"640\\\" height=\\\"480\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=sketch\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"640\" height=\"480\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 2, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(19, 'Dress My Pet', '\"Dress My PetBeautify those Puppies!\"', '', '', '', 3, '', 1271107797, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_dress-my-pet_121628_50x50_19.PNG', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=dress-my-pet__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"800\\\" height=\\\"600\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=dress-my-pet\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"800\" height=\"600\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 1, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (20, 'Red Storm', 'A special Unit has been sent to Mars to prevent a looming threat. By controlling one of the combat robots, your Unit will have to go through the series of missions; destroying a mob of enemies, earning awards and improving your own robot.', '', '', '', 4, '', 1271108017, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_red-storm_104687_50x50_15.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=red-storm__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"800\\\" height=\\\"600\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=red-storm\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"800\" height=\"600\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(21, 'Starmageddon', 'Those evil aliens are at it again, invading our little corner of the galaxy once more, trying to conquer the Earth, enslave all mankind and in a word, whatnot. Will they never learn that here on Earth we have an endless supply of fighter jocks with the right stuff to trash their entire armada from a single man spacecraft? Oh well, I suppose you\'d better get out there and show them who\'s the boss... Move with the mouse or WASD or arrow keys. Your guns fire automatically. Activate your shockwave using the mouse button or M or Z keys. Pause with the SPACE bar.', '', '', '', 4, '', 1271108128, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_starmageddon-2_489590_50x50_11.PNG', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=starmageddon-2__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"500\\\" height=\\\"600\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=starmageddon-2\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"500\" height=\"600\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(22, 'Thing Thing 3', '...', '', '', '', 4, '', 1271108292, 2, 'http://www.heyzap.com/images/payments/ghost-game-orange-50.png', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=thing-thing-arena-3-3__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"650\\\" height=\\\"755\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=thing-thing-arena-3-3\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"650\" height=\"755\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 1, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(23, 'The Last Stand', 'Survive the night fighting off zombies from your barricade. Survive longer than a day by making use of the daylight hours effectively by:\r\n*Repairing your barricade\r\n*Searching for weapons\r\n*Looking for other survivors to help repair', '', '', '', 4, '', 1271108656, 2, 'http://hzmedia.heyzap.com/thumbnail_games_the-last-stand_18620.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=the-last-stand__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"700\\\" height=\\\"367\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=the-last-stand\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"700\" height=\"367\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 2, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(24, 'Balloon Invasion', 'Defend the coast with your weapons agianst the upcoming invasion of enemy balloons!', '', '', '', 4, '', 1271108724, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_balloon-invasion_73896_50x50_55.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=balloon-invasion__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"720\\\" height=\\\"480\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=balloon-invasion\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"720\" height=\"480\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (25, 'Baby Vs Spiders', 'Fight against hordes of creepy spiders and other creatures in this incredible top-down shooter! Three game modes, 8 weapons, 5 insect Queens to kill, 10 perks, 4 types of ammo and an INFINITE amount of fun!', '', '', '', 4, '', 1271108807, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_baby-vs-spiders_516133_50x50_94.PNG', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=baby-vs-spiders__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"640\\\" height=\\\"505\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=baby-vs-spiders\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"640\" height=\"505\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 1, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(26, 'Agony: The Portal', 'After countless millenia of imprisonment in a long forgotten tomb, the lord of the undead is finally freed by careless grave robbers. The world is about to change forever.... Armed with a flail and an arsenal of spells and combat moves your ultimate goal is to collect ancient artifacts which are needed to open a portal to the realm of the dead. These artifacts are guarded by the kings of Gonia. There are 8 kings each belonging to a different race of enemies.', '', '', '', 5, '', 1271109139, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_agony-the-portal_82687_50x50_18.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=agony-the-portal-188__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"800\\\" height=\\\"500\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=agony-the-portal-188\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"800\" height=\"500\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (27, 'Arcuz: Behind the Dark', 'Arcuz is an Action Role Play Game (Like Zelda or Diablo). You fight with the monsters, train your hero, learn skills, search better weapons and equipments, compose new items using your creativity...and more! Don\'t be addicted! You got 18 different maps to discover, 25 quests to accomplish, 21 battle skills to learn, more than 10 types of monsters to kill, more than 100 weapons and gears to choose, and unlimited possibility of composition…Those are not all. We translated this game into 7 languages so half of the whole world can enjoy it! Hope Arcuz will bring you a lot of fun!', '', '', '', 5, '', 1271109193, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_arcuz-behind-the-dark_138455_50x50_75.PNG', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=arcuz-behind-the-dark__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"500\\\" height=\\\"450\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=arcuz-behind-the-dark\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"500\" height=\"450\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(28, 'Sonny', 'Dear Human,Zombies. You\'ve shot them, stabbed them, sliced and diced them. Today I put you in the shoes of a Zombie. Fight for your life in this crazy and twisted world.After two solid months of production, we present to you this epic interactive tale of', '', '', '', 5, '', 1271109270, 2, 'http://hzmedia.heyzap.com/thumbnail_games_sonny_16028.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=sonny__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"700\\\" height=\\\"503\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=sonny\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"700\" height=\"503\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(29, 'Neko Saga', 'You are the Cat Samurai Ko! Slash through Ninja armies with quick moves, and awesome specials. Tons of upgrades and loads of fun!', '', '', '', 5, '', 1271109334, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_hong-kong-cat_29524_50x50_70.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=nekosaga__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"700\\\" height=\\\"500\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=nekosaga\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"700\" height=\"500\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(30, 'Hero RPG', 'Venture through the world as a Warrior, Ranger, or Mage. Fight through the hordes of enemies as you complete quests for rewards and honor. Make sure you read the instructions carefully -(this is a very big game and the controls and gameplay can be sort of complex! Give it a chance!) - A lot of people are having odd bugs that really shouldn’t exist. Loading problems are not the fault of the g?', '', '', '', 5, '', 1271109404, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_hero-rpg_77111_50x50_14.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=hero-rpg__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"700\\\" height=\\\"600\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=hero-rpg\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"700\" height=\"600\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 1, 1, '', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(31, 'Battlefield General', 'This is the 6 level demo version of Battlefield General used for distribution. A strategy-war game set in ancient China, command an army and pacify the lands for your Emperor.', '', '', '', 5, '', 1271109464, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_battlefieldgeneral_126774_50x50_84.PNG', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=battlefieldgeneral__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"750\\\" height=\\\"580\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=battlefieldgeneral\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"750\" height=\"580\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 1, 1, 'strategy,&,defense,adventure,games,warfare,war,game,real-time,history,historical,chinese', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(32, 'Gem Craft', 'Havoc and corruption swarms through the land, and you are one of those few wizards who can put an end to it. Create and combine magic gems, put them into your towers and banish the monsters back to hell!', '', '', '', 6, '', 1271109654, 2, 'http://hzmedia.heyzap.com/thumbnail_games_gemworks_23078.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=gemcraft__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"640\\\" height=\\\"480\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=gemcraft\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"640\" height=\"480\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 1, 1, 'puzzle,thinking,strategy,gems,fun,casino,candystand', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(33, 'Protector', 'Deep strategy and involving depth, deceptively simple to play, yet so many avenues and strategies to master. Protecto...', '', '', '', 6, '', 1271110274, 2, 'http://hzmedia.heyzap.com/thumbnail_games_protector_15923.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=protector__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"800\\\" height=\\\"600\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=protector\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"800\" height=\"600\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, 'strategy,&,defense', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
(34, 'Army of Destruction', '[NOW WITH MORE LEVELS] This is an action shooter where you have to defend your city from the alien invasion. Th...', '', '', '', 6, '', 1271110334, 2, 'http://hzmedia.heyzap.com/thumbnail_games_army-of-destruction_16299.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=army-of-destruction__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"750\\\" height=\\\"350\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=army-of-destruction\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"750\" height=\"350\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, 'shooter,defense,games', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (35, 'The Last Stand 2', 'Thanks for the feedback so far, we\'re working on fixing the bugs highlighted so far. If you\'re going to leave feedback, take note of the version number of the game (on the loading screen) that you\'re playing, it helps if we know which version you\'re p', '', '', '', 6, '', 1271110418, 2, 'http://hzmedia.heyzap.com/thumbnail_games_the-last-stand-2_18619.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=the-last-stand-2__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"700\\\" height=\\\"367\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=the-last-stand-2\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"700\" height=\"367\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 1, 1, '', 0, 0, 0, 'shooting,action,defe', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
	    (36, 'Bugwave', 'BUGWAVE is a sophisticated tower defense game located in a neat environment with forces of nature in your hands. Control the bugs! Use the building modules of the flower. Place these elemental towers on the ground to prevent the bugs from reaching the right and bottom side of the arena.', '', '', '', 6, '', 1271110488, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_bugwave_52511_50x50_7.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=bugwave__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"1000\\\" height=\\\"600\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=bugwave\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"1000\" height=\"600\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, 'strategy,&,defense,games,tower,bugwave,towerdefense', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', ''),
    (37, 'Crop Circles', 'Aliens have landed and want to eat the farmers\' brains! You must defend the barn. Strategically arrange the crop circles to make them follow a path of your choice. Then place your military assets and blast them back to space!', '', '', '', 6, '', 1271110546, 2, 'http://hzmedia.heyzap.com/production_thumbnail_games_crop-circles_26994_50x50_9.jpg', '<script type=\"text/javascript\">   (function() {     var code = \"<embed id=\\\"game_object\\\" src=\\\"http://www.heyzap.com/heyzap/api_swf?permalink=crop-circles__REPLACE_WITH_PARENT__\\\"\\n       allowFullScreen=\\\"true\\\" menu=\\\"false\\\" quality=\\\"high\\\" allowscriptaccess = \"never\"\\n       width=\\\"640\\\" height=\\\"480\\\"\\n       type=\\\"application/x-shockwave-flash\\\"\\n       pluginspage=\\\"http://www.macromedia.com/go/getflashplayer\\\" />\\n\";     var match = window.location.href.match(/[?&]parent_url=([^&#]*)/);     try {       var top_href = top.location.href;     } catch (err) {       top_href = undefined;     }     var param = \"&\";     param += \"parent_url=\";     if (top_href) {       var replacement = param + encodeURIComponent(top.location.href);     } else if (match) {       replacement = param + match[1];     } else {       replacement = \"\";     }     code = code.replace(\"__REPLACE_WITH_PARENT__\", replacement);     document.write(code + \"<noscript>\");   })(); </script> <embed id=\"game_object\" src=\"http://www.heyzap.com/heyzap/api_swf?permalink=crop-circles\"        allowFullScreen=\"true\" menu=\"false\" quality=\"high\" allowscriptaccess = \"never\"        width=\"640\" height=\"480\"        type=\"application/x-shockwave-flash\"        pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /> </noscript>', 0, 1, 'strategy,&,defense,tower,glowmonkey,crop,circles', 0, 0, 0, '', '', 1, '24.63.138.202', '', 0, 0, '', 0, '', '', '', '', '', '', '')");



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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '$email', 2, 0)");

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



mysql_query("ALTER TABLE  `dd_users` ADD  `activation_key` VARCHAR( 255 ) NOT NULL; ");
mysql_query("ALTER TABLE  `dd_users` ADD  `status` VARCHAR( 255 ) NOT NULL; ");
mysql_query("UPDATE `dd_users` SET `activation_key`='0' WHERE `userid`=0; ");
mysql_query("UPDATE `dd_users` SET `activation_key`='0' WHERE `userid`=1; ");
mysql_query("ALTER TABLE  `dd_users` ADD  `pass_answer` TEXT NOT NULL; ");
mysql_query("ALTER TABLE  `dd_users` ADD  `pass_question` VARCHAR( 255 ) NOT NULL; ");
mysql_query("ALTER TABLE  `dd_users` ADD  `new_email` VARCHAR( 255 ) NOT NULL,
ADD  `new_email_key` VARCHAR( 255 ) NOT NULL; ");

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
?>