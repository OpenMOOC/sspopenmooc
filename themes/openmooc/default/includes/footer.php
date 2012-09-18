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
			<ul>
<?php echo  (!empty($urls['legal'])?'<li><a href="'.$urls['legal'].'" >'.$this->t('legal').'</a>':'').(!empty($urls['copyright'])?'</li><li><a href="'.$urls['copyright'].'">'.$this->t('copyright').'</a></li>':'').(!empty($urls['tos'])?'<li><a href="'.$urls['tos'].'">'.$this->t('tos').'</a></li>':'');
?>
			</ul>
		</div>
	</footer>
	
</div><!-- #wrap -->

</body>
</html>
