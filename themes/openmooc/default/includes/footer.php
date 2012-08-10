<?php

$themeconf = SimpleSAML_Configuration::getConfig('module_sspopenmooc.php');

$urls = $themeconf->getarray('urls');


// Needed due includeLanguageFile funtion only works with the base dictionaries
$file = SimpleSAML_Module::getModuleDir('sspopenmooc') . '/dictionaries/sspopenmooc';
$lang = $this->readDictionaryJSON($file);
$this->langtext = array_merge($this->langtext, $lang);


if(!empty($this->data['htmlinject']['htmlContentPost'])) {
	foreach($this->data['htmlinject']['htmlContentPost'] AS $c) {
		echo $c;
	}
}


?>

	</div><!-- #content -->
	
	<footer> 
		<div class="footerLinks">
<?php
	echo	'<a href="'.$urls['legal'].'" >'.$this->t('legal').'</a> - <a href="'.$urls['tos'].'">'.$this->t('tos').'</a> - <a href="'.$urls['copyright'].'">'.$this->t('copyright').'</a>';
?>
		</div>
	</footer>
	
</div><!-- #wrap -->

</body>
</html>
