<?php


if($seo_on == 1){
		$con1 = ''.$domain.'/contact/';
	}else{
		$con1 = ''.$domain.'/index.php?action=contact';
	};




echo '
<table><tr><td class=\'header\'>The Fine Print</td></tr>
<tr>
<td class=\'content\'>
<p><b>Privacy Policy:</b>
<p>During your visit, '.$sitename.' may collect the following</p>
<ul>
  <li>IP Address </li>
  <li>Web Cookies </li>
  <li>Session IDs </li>
  <li>Web browser</li>
</ul>
<p>This site contains links to other sites. '.$sitename.' is not responsible 
for the privacy practices or content of those web sites. '.$sitename.' recommends 
 you refer to other sites privacy policies for more information. </p>
<p>In addition, Some of our advertisers might collect info as well. We have no control over 
their collection of data.</p>


<p>Should you have any questions about this privacy statement,  
 the practices of this site, or a technical problem about the 
 site that you cannot resolve, please contact us <br />
 </p>
<p>
<b>Legal Notice:</b>
<p>


'.$sitename.' claims no ownership of any game(s) on our site. 
All rights revert back to the authors of said games and may be taken down at any time 
if desired. All games presented on '.$sitename.' are for the enjoyment of our visitors, and 
are not in any way for sale, resale, or distribution through '.$sitename.'. If you feel that 
your material is in violation of copyright laws, please contact us immediately and we will 
remove your content as soon as possible. Please make sure to reference EXACTLY what it is that 
you feel is in violation; ie, which game, URL, ect. If you do not include such information we 
may not know what material it is and will not be able to act on it until you provide such information.


<p>
<b>Terms of Service:</b>
<p>
<ol>
<li>You may not be abusive to others, attack them, etc. Hate, bigotry, racisim, etc, have no place here.</li>
<li>You may not hold '.$sitename.' responsible for anything that you see on this site. We attempt to moderate it to 
some degree, but we can not watch everything all the time. If you have a problem with somebody, or something they do or 
say, take it up with them in a legal fashion, not with us.</li>
<li>If you have any issue with anything that you find on this site, please do let us know about it. It may be that it is 
something we also do not like, and will attempt to do something about it. Please bear in mind though that we do try to give 
people some leeway in here.</li>
<li>We reserve all rights to ourselves, including the rights to delete anybody\'s account for any reason or none, change these 
terms as we see fit, and take control as we see fit.</li>
<li>This site may not be used for anything against the law, In our jurisdiction or your own.</li>
<li>When we make a descision, it is final. There is no route of appeal.</li>
<li>You may not use this site unless you agree to these terms, and any alterations we make to them. Your use of this site 
is taken as aceptence of these terms.</li>
</ol>

<p>
<b>F.A.Q.</b><p>


<ol>
<li>

Why doesn\'t the game play?

<p>
There may be more than one reason
<p>

<ul>
<li>you might be having problems with a firewall or security setting on your computer. You have to deal with your network admin over this one.</li>
<p>
<li>You might need to install the proper plugin. Here is a link to the flash player.</li><p>

<a href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash&promoid=BIOW">Flash</a>            
<p>

</ul>
</li>
<li>Where do the games, pics, etc come from?<p>
Various places. Usually they are put out for use by their author for use by the public or arcade sites. Some are paid for.<p>

<p>
</li>

<li>Are they for sale??<p>
Not through us. They belong to their originator or authors, contact them about buying them.
 

<p>
</li>
<li>I entered my website or comment, why doesn\'t it show up?<p>
It might need to be approved, or the site settings might be set up so that you need to play a certain number of games first.<p>

</li>
<li>I want to know about advertising on your site.<p>
Use the contact us form below.<p>
</li>


</td>
</tr>


	<tr>
		<td class=\'header\' colspan=\'2\'>Contact Us</td>
	</tr>
	<tr>
		<td  width=\'70%\' valign=\'top\' colspan=\'2\' class=\'content\' >
	

<form action =\''.$con1.'\' method=\'POST\'>
Your E-mail:<br><input type=\'text\' name=\'sender\' size=\'50\'><p>
Your Message:<br><textarea name=\'message\' rows=\'10\' cols=\'50\' ></textarea>

<p>
<input type=\'submit\' value=\'Send\'>





            
            </td>
      </tr>

</table>







';


?>