<?php
$this->data['header'] = $this->t('{login:user_pass_header}');

if (strlen($this->data['username']) > 0) {
	$this->data['autofocus'] = 'password';
} else {
	$this->data['autofocus'] = 'username';
}
$this->includeAtTemplateBase('includes/header.php');


$themeconf = SimpleSAML_Configuration::getConfig('module_sspopenmooc.php');

$urls = $themeconf->getarray('urls');

// Needed due includeLanguageFile funtion only works with the base dictionaries
$file = SimpleSAML_Module::getModuleDir('sspopenmooc') . '/dictionaries/sspopenmooc';
$lang = $this->readDictionaryJSON($file);
$this->langtext = array_merge($this->langtext, $lang);

?>

<?php
if ($this->data['errorcode'] !== NULL) {
?>
	<div class="alert alert-error">		
		<h4 class="alert-heading"><?php echo $this->t('{errors:title_' . $this->data['errorcode'] . '}'); ?></h4>
		<p><?php echo $this->t('{errors:descr_' . $this->data['errorcode'] . '}'); ?></p>
	</div>
<?php
}
?>
	<h2 style="break: both"><?php echo $this->t('{login:login_button}'); ?></h2>

	<form action="?" method="post" name="f">
	<table class="login" cellspacing="10">
		<tr>
			<td class="pull-right"><label><?php echo $this->t('{attributes:attribute_mail}'); ?>:</label></td>
			<td>
<?php
if ($this->data['forceUsername']) {
	echo '<strong style="font-size: medium">' . htmlspecialchars($this->data['username']) . '</strong>';
} else {
	echo '<input type="text" id="username" tabindex="1" name="username" value="' . htmlspecialchars($this->data['username']) . '" />';
}
?>
			</td>
		</tr>
		<tr>
			<td class="pull-right"><label><?php echo $this->t('{login:password}'); ?>:</label></td>
			<td><input id="password" type="password" tabindex="2" name="password" /></td>
		</tr>

		<tr>
			<td></td>
			<td>
<?php
			echo '<a href="'.$urls['forgotpassword'].'">'.$this->t('forgotpassword').'</a>';
?>

			</td>
		</tr>


		<tr>
			<td></td>
			<td>
				<input class="btn" type="submit" tabindex="4" value="<?php echo $this->t('log_in'); ?>" />
			</td>
		</tr>

	</table>

<?php
foreach ($this->data['stateparams'] as $name => $value) {
	echo('<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '" />');
}
?>

	</form>

<?php

if(!empty($this->data['links'])) {
	echo '<ul class="links" style="margin-top: 2em">';
	foreach($this->data['links'] AS $l) {
		echo '<li><a href="' . htmlspecialchars($l['href']) . '">' . htmlspecialchars($this->t($l['text'])) . '</a></li>';
	}
	echo '</ul>';
}



$this->includeAtTemplateBase('includes/footer.php');
?>
