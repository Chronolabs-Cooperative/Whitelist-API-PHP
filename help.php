<?php
/**
 * Chronolabs REST Checksums/Hashes Selector API
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Chronolabs Cooperative http://labs.coop
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         checksums
 * @since           1.0.2
 * @author          Simon Roberts <meshy@labs.coop>
 * @version         $Id: functions.php 1000 2013-06-07 01:20:22Z mynamesnot $
 * @subpackage		api
 * @description		Checksums/Hashes API Service REST
 * @link			https://screening.labs.coop Screening API Service Operates from this URL
 * @category		control
 * @category		gui
 * @filesource
 */


	global $domain, $protocol, $business, $entity, $contact, $referee, $peerings, $source;
	
	if (strlen($theip = whitelistGetIP(true))==0)
		$theip = "127.0.0.1";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta property="og:title" content="User Agents API Services"/>
<meta property="og:type" content="api"/>
<meta property="og:image" content="https://icons.ringwould.com.au/trusting/apple-touch-icon-114x114.png"/>
<meta property="og:url" content="<?php echo (isset($_SERVER["HTTPS"])?"https://":"http://").$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" />
<meta property="og:site_name" content="<?php echo $business; ?>"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="rating" content="general" />
<meta http-equiv="author" content="wishcraft@users.sourceforge.net" />
<meta http-equiv="copyright" content="<?php echo $business; ?> &copy; <?php echo date("Y"); ?>" />
<meta http-equiv="generator" content="Chronolabs Cooperative (AUS)" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Whitelist API Services || <?php echo $business; ?></title>
<!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50f9a1c208996c1d"></script>
<script type="text/javascript">
  addthis.layers({
	'theme' : 'transparent',
	'share' : {
	  'position' : 'right',
	  'numPreferredServices' : 6
	}, 
	'follow' : {
	  'services' : [
		{'service': 'facebook', 'id': 'Chronolabs'},
		{'service': 'twitter', 'id': 'JohnRingwould'},
		{'service': 'twitter', 'id': 'ChronolabsCoop'},
		{'service': 'twitter', 'id': 'Cipherhouse'},
		{'service': 'twitter', 'id': 'OpenRend'},
	  ]
	},  
	'whatsnext' : {},  
	'recommended' : {
	  'title': 'Recommended for you:'
	} 
  });
</script>
<!-- AddThis Smart Layers END -->
<link rel="stylesheet" href="<?php echo $source; ?>/style.css" type="text/css" />
<link rel="stylesheet" href="https://css.ringwould.com.au/3/gradientee/stylesheet.css" type="text/css" />
<link rel="stylesheet" href="https://css.ringwould.com.au/3/shadowing/styleheet.css" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script>
	var icoroite = 9966 * Math.random() + 7755;
	setTimeout(function() {
		jQuery.getJSON( "https://icons.ringwould.com.au/icons/java/<?php echo ($GLOBALS["domain"]=="ringwould.com.au"?"ringwould":"invader"); ?>/random.json", function( data ) {
			$.each(data, function( keyey, value ) {
				$( "#" + keyey ).href = value;
			});
		});
	}, icoroite);
</script>
<?php
	if ((!isset($_SESSION['icon-meta-html']) || empty($_SESSION['icon-meta-html'])) && session_id())
		$_SESSION['icon-meta-html'] = file_get_contents("https://icons.ringwould.com.au/icons/java/".($GLOBALS["domain"]=="ringwould.com.au"?"ringwould":"invader")."/random.html");
	if (isset($_SESSION['icon-meta-html']) && !empty($_SESSION['icon-meta-html']))
		echo $_SESSION['icon-meta-html'];
	else
		echo file_get_contents("https://icons.ringwould.com.au/icons/java/".($GLOBALS["domain"]=="ringwould.com.au"?"ringwould":"invader")."/random.html");
?>
</head>
<body>
<?php if (isset($GLOBALS['written'])&&isset($GLOBALS['value'])) { ?>
<div style="margins: 16px; border: 4px dash red; background-color: light green; font-size: 0.98em; padding: 20px; text-align:center;">Written <em><strong><?php echo $GLOBALS['value']?></strong></em> into the <?php echo ucfirst($GLOBALS['written']); ?> whitelist!</div>
<?php } ?>
<div class="main">
    <h1>Whitelist API Services - <?php echo $business; ?></h1>
    <p>This is an API Service for whitelisting either a netBIOS address or IPv4 or IPv6 address!</p>
    <h2>Code API Documentation</h2>
    <p>You can find the phpDocumentor code API documentation at the following path :: <a target="_blank" href="<?php echo $source; ?>docs/" target="_blank"><?php echo $source; ?>docs/</a>. These should outline the source code core functions and classes for the API to function!</p>
    <h2>API Services' Peers</h2>
    <p>This is the services the key is dupicated on when lodged for a multiple recover points and options!</p>
    <blockquote>
    	<ol>
    		<?php foreach($peerings as $domain => $peer) { 
    				if (!strpos($domain, $source)) {
    					?>				<li><a href="mailto:<?php echo $peer['contact']; ?>" target="_blank"><?php echo $peer['business']; ?></a> ~~ <a href="<?php echo $peer['protocol'] . $peer['domain']; ?>" target="_blank"><?php echo $peer['protocol'] . $peer['domain']; ?></a><?php if ($peer['ping']>1.0001) { ?> --- <em>ping <?php echo $peer['ping']; ?>ms</em><?php } else { ?> -- Unabled to Ping! <?php } ?></li>
    					
			<?php }	}?>
    	</ol>
    </blockquote>
    <h2>Submisstion form</h2>
    <p>Use this form to submit it now to the API!</p>
    <blockquote>
    	<form method="POST">
    		<table>
    			<tr>
    				<th colspan"2">Submit this form now selecting the options to whitelist the Internet Address on all API's</th>
    			</tr>
    			<tr>
    				<td colspan"2">&nbsp;</th>
    			</tr>
    			<tr>
    				<td><input name="mode" type="radio" value="ip" id="mode[ip]" /><label for="mode[ip]">&nbsp;Allow IP to be Whitelisted</label></td>
    				<td><input name="ip" type="text" size="42" maxlen="198" value="<?php echo $theip; ?>"/></td>
    			</tr>
    			<tr>
    				<td><input name="mode" type="radio" value="netbios" id="mode[netbios]" /><label for="mode[netbios]">&nbsp;Allow Netbios to be Whitelisted - <em>No Wilcard!</em></label></td>
    				<td><input name="netbios" type="text" size="42" maxlen="198" value="<?php echo gethostbyaddr($theip); ?>"/></td>
    			</tr>
    			<tr>
    				<td>Solve Puzzle: [type: <em><?php echo $_SESSION['solve']; ?></em> ]</td>
    				<td><input name="md5" type="text" size="<?php echo strlen($_SESSION['solve'])+2; ?>" maxlen="<?php echo strlen($_SESSION['solve']); ?>" /></td>
    			</tr>
    			<tr>
    				<td colspan="2"><input type="submit" value="Test and Save to Whitelist's" /></td>
    			</tr>
   			</table>
    	</form>
    </blockquote>
    <?php if (file_exists(API_FILE_IO_FOOTER)) {
    	readfile(API_FILE_IO_FOOTER);
    }?>	
    <?php if (!in_array(whitelistGetIP(true), whitelistGetIPAddy())) { ?>
    <h2>Limits</h2>
    <p>There is a limit of <?php echo MAXIMUM_QUERIES; ?> queries per hour. You can add yourself to the whitelist by using the following form API <a href="http://whitelist.<?php echo domain; ?>/">Whitelisting form (whitelist.<?php echo domain; ?>)</a>. This is only so this service isn't abused!!</p>
    <?php } ?>
    <h2>The Author</h2>
    <p>This was developed by Simon Roberts in 2013 and is part of the Chronolabs System and api's.<br/><br/>This is open source which you can download from <a href="https://sourceforge.net/projects/chronolabsapis/">https://sourceforge.net/projects/chronolabsapis/</a> contact the scribe  <a href="mailto:wishcraft@users.sourceforge.net">wishcraft@users.sourceforge.net</a></p></body>
</div>
</html>
<?php 
