<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<?php

$session = SimpleSAML_Session::getInstance();

$themeconf = SimpleSAML_Configuration::getConfig('module_sspopenmooc.php');

$urls = $themeconf->getArray('urls');
$cssfile = $themeconf->getString('cssfile', 'default.css');
$bootstrapfile = $themeconf->getString('bootstrapfile', 'bootstrap.css');
$imgfile = $themeconf->getString('imgfile', 'logo.png');
$slogan = $themeconf->getString('slogan', 'Knowledge for the masses');
$title = $themeconf->getString('title', 'OpenMooc');

if(empty($cssfile)) {
	$cssfile = 'default.css';
}
if(empty($bootstrapfile)) {
	$bootstrapfile = 'bootstrap.css';
}
if(empty($imgfile)) {
	$imgfile = 'logo.png';
}
if(empty($title)) {
	$title = 'OpenMooc';
}
if(empty($slogan)) {
	$slogan = 'Knowledge for the masses';
}


if (strpos($cssfile, '//') === FALSE) {
	$cssfile = '/'. $this->data['baseurlpath'] .'module.php/sspopenmooc/openmooc/css/'.$cssfile;
}
if (strpos($bootstrapfile, '//') === FALSE) {
	$bootstrapfile = '/'. $this->data['baseurlpath'] .'module.php/sspopenmooc/openmooc/css/'.$bootstrapfile;
}

if (strpos($imgfile, '//') === FALSE) {
	$imgfile = '/'. $this->data['baseurlpath'] .'module.php/sspopenmooc/openmooc/img/'.$imgfile;
}


// Needed due includeLanguageFile funtion only works with the base dictionaries
$file = SimpleSAML_Module::getModuleDir('sspopenmooc') . '/dictionaries/sspopenmooc';
$lang = $this->readDictionaryJSON($file);
$this->langtext = array_merge($this->langtext, $lang);


/**
 * Support the htmlinject hook, which allows modules to change header, pre and post body on all pages.
 */
$this->data['htmlinject'] = array(
	'htmlContentPre' => array(),
	'htmlContentPost' => array(),
	'htmlContentHead' => array(),
);


$jquery = array();
if (array_key_exists('jquery', $this->data)) $jquery = $this->data['jquery'];

if (array_key_exists('pageid', $this->data)) {
	$hookinfo = array(
		'pre' => &$this->data['htmlinject']['htmlContentPre'], 
		'post' => &$this->data['htmlinject']['htmlContentPost'], 
		'head' => &$this->data['htmlinject']['htmlContentHead'], 
		'jquery' => &$jquery, 
		'page' => $this->data['pageid']
	);
		
	SimpleSAML_Module::callHooks('htmlinject', $hookinfo);	
}
// - o - o - o - o - o - o - o - o - o - o - o - o -

/**
 * Do not allow to frame simpleSAMLphp pages from another location.
 * This prevents clickjacking attacks in modern browsers.
 *
 * If you don't want any framing at all you can even change this to
 * 'DENY', or comment it out if you actually want to allow foreign
 * sites to put simpleSAMLphp in a frame. The latter is however
 * probably not a good security practice.
 */
header('X-Frame-Options: SAMEORIGIN');

?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript" src="/<?php echo $this->data['baseurlpath']; ?>resources/script.js"></script>
<title><?php
if(array_key_exists('header', $this->data)) {
	echo $this->data['header'];
} else {
	echo 'simpleSAMLphp';
}
?></title>

<?php
	echo    '<link rel="stylesheet" type="text/css" href="'. $bootstrapfile.'" />';
	echo	'<link rel="stylesheet" type="text/css" href="'. $cssfile.'" />';

?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>
		window.jQuery || document.write('<script src="/static/js/libs/jquery-1.7.2.min.js"><\/script>')
	</script>
	<script src="/<?php echo $this->data['baseurlpath']; ?>module.php/sspopenmooc/openmooc/js/bootstrap.js"></script>
	<link rel="icon" type="image/icon" href="/<?php echo $this->data['baseurlpath']; ?>module.php/sspopenmooc/openmooc/img/favicon.ico" />

<?php

if(!empty($jquery)) {
	$version = '1.5';
	if (array_key_exists('version', $jquery))
		$version = $jquery['version'];
		
	if ($version == '1.5') {
		if (isset($jquery['core']) && $jquery['core'])
			echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery.js"></script>' . "\n");
	
		if (isset($jquery['ui']) && $jquery['ui'])
			echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery-ui.js"></script>' . "\n");
	
		if (isset($jquery['css']) && $jquery['css'])
			echo('<link rel="stylesheet" media="screen" type="text/css" href="/' . $this->data['baseurlpath'] . 
				'resources/uitheme/jquery-ui-themeroller.css" />' . "\n");	
			
	} else if ($version == '1.6') {
		if (isset($jquery['core']) && $jquery['core'])
			echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery-16.js"></script>' . "\n");
	
		if (isset($jquery['ui']) && $jquery['ui'])
			echo('<script type="text/javascript" src="/' . $this->data['baseurlpath'] . 'resources/jquery-ui-16.js"></script>' . "\n");
	
		if (isset($jquery['css']) && $jquery['css'])
			echo('<link rel="stylesheet" media="screen" type="text/css" href="/' . $this->data['baseurlpath'] . 
				'resources/uitheme16/ui.all.css" />' . "\n");	
	}
}

if(!empty($this->data['htmlinject']['htmlContentHead'])) {
	foreach($this->data['htmlinject']['htmlContentHead'] AS $c) {
		echo $c;
	}
}




if ($this->isLanguageRTL()) {
?>
	<link rel="stylesheet" type="text/css" href="/<?php echo $this->data['baseurlpath']; ?>resources/default-rtl.css" />
<?php	
}
?>

	
	<meta name="robots" content="noindex, nofollow" />
	

<?php	
if(array_key_exists('head', $this->data)) {
	echo '<!-- head -->' . $this->data['head'] . '<!-- /head -->';
}
?>
</head>
<?php
$onLoad = '';
if(array_key_exists('autofocus', $this->data)) {
	$onLoad .= 'SimpleSAML_focus(\'' . $this->data['autofocus'] . '\');';
}
if (isset($this->data['onLoad'])) {
	$onLoad .= $this->data['onLoad']; 
}

if($onLoad !== '') {
	$onLoad = ' onload="' . $onLoad . '"';
}
?>
<body<?php echo $onLoad; ?>>

<div id="wrap" class="container">
	
    <header>

		<?php 
	
		$includeLanguageBar = TRUE;
		if (isset($this->data['hideLanguageBar']) && $this->data['hideLanguageBar'] === TRUE) 
			$includeLanguageBar = FALSE;
	
		if ($includeLanguageBar) {
		
		
			echo '<div id="languagebar" class="pull-right">';
			$languages = $this->getLanguageList();
			$langnames = array(
						'en' => 'English',
						'es' => 'Español',
			);
		
			$textarray = array();
			foreach ($languages AS $lang => $current) {
				if (isset($langnames[$lang])) {
					$lang = strtolower($lang);
					if ($current) {
						$textarray[] = $langnames[$lang];
					} else {
						$textarray[] = '<a href="' . htmlspecialchars(SimpleSAML_Utilities::addURLparameter(SimpleSAML_Utilities::selfURL(), array('language' => $lang))) . '">' .
							$langnames[$lang] . '</a>';
					}
				}
			}
			echo join(' | ', $textarray);
			echo '</div>';

		}
		?>

		<hgroup>
<?php
	echo '<h1><a class="hide-text" href="'.$urls['site'].'"><img alt="'.$title.'" src="'.$imgfile.'">'.$title.'</a></h1>';
?>
 		  <h2 class="small pull-left"><?php echo $slogan; ?></h2>
		</hgroup>

<?php

	if($session->isAuthenticated() && $session->remainingTime() > 0) {
                $isadmin = SimpleSAML_Utilities::isAdmin();
                if ($isadmin) {
                    $friendlyName = 'admin';
                } else {
                    $attrs = $session->getAttributes(); 	
                    $friendlyName = $attrs['cn'][0].' '.$attrs['sn'][0];
                }


                echo '<div class="btn-toolbar pull-right">';
                echo '<div class="btn-group">';
                echo '<a class="btn" href="'.$urls['site'].'">'.$this->t('courses').'</a>';
?>
                </div>
                <div class="btn-group">
                        <a data-toggle="dropdown" class="btn dropdown-toggle">
<?php
      echo  $this->t('welcome').', '.$friendlyName.' ';
?>
                      <span class="caret"></span>
            </a>
                <ul class="dropdown-menu">
<?php
    if (!$isadmin) {
        echo	'<li><a href="'.$urls['profile'].'">'.$this->t('profile').'</a></li>';
        echo	'<li><a href="'.$urls['changepassword'].'">'.$this->t('changepassword').'</a></li>';
	if(isset($urls['changemail'])) {
		echo    '<li><a href="'.$urls['changemail'].'">'.$this->t('changemail').'</a></li>';
	}
    } else {
        echo	'<li><a href="'.$urls['newuser'].'">'.$this->t('newuser').'</a></li>';
        echo	'<li><a href="'.$urls['manageusers'].'">'.$this->t('manageusers').'</a></li>';
    }
	echo	'<li class="divider"></li>';
	echo    '<li><a href="'.$urls['logout'].'">'.$this->t('log_out'),'</a></li>';
?>
		</ul>
	  </div>
     </div>
<?php
	}
?>
	<div class="clearfix"></div>

    </header>

	<div id="content">


<?php

if(!empty($this->data['htmlinject']['htmlContentPre'])) {
	foreach($this->data['htmlinject']['htmlContentPre'] AS $c) {
		echo $c;
	}
}


?>

