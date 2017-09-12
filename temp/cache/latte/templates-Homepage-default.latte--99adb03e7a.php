<?php
// source: C:\xampp\htdocs\CatMap\app\presenters/templates/Homepage/default.latte

use Latte\Runtime as LR;

class Template99adb03e7a extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
		'scripts' => 'blockScripts',
		'head' => 'blockHead',
	];

	public $blockTypes = [
		'content' => 'html',
		'scripts' => 'html',
		'head' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
?>


<?php
		$this->renderBlock('scripts', get_defined_vars());
?>


<?php
		$this->renderBlock('head', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
    
        <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
        <!-- Overlay -->
        <div class="overlay"></div>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item slides active">
            <div class="slide-1"></div>
            <div class="hero">
              <hgroup>
                  <h1>Kočičí mapa</h1>        
                  <h3>Pomozte nám starat se o opuštěné kočky</h3>
              </hgroup>
              <button class="btn btn-hero btn-lg" role="button">Našel jsem kočku</button>
            </div>
          </div>
          
        </div> 
      </div>
    
      <div id="addNewCatArea">
        <div class="alert alert-danger">Pro dokončení akce je nutné kliknutím vybrat místo na mapě</div>  
<?php
		/* line 26 */ $_tmp = $this->global->uiControl->getComponent("addNewCatForm");
		if ($_tmp instanceof Nette\Application\UI\IRenderable) $_tmp->redrawControl(null, false);
		$_tmp->render();
?>
      </div>  

        <div id="map"></div>
        
<?php
	}


	function blockScripts($_args)
	{
		extract($_args);
?>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://files.nette.org/sandbox/jush.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 38 */ ?>/js/nette.ajax.js"></script>
    <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 39 */ ?>/js/ajaxify.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 42 */ ?>/js/googleMarkerClusterer.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 43 */ ?>/css/addMarker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 44 */ ?>/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 45 */ ?>/css/catForm.css">
    <link rel="stylesheet" type="text/css" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 46 */ ?>/css/netteExtensions.css">
    <!--<script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlComment($basePath) /* line 47 */ ?>/js/mainScript.js"></script>-->
    <script src="https://nette.github.io/resources/js/netteForms.min.js"></script>
    <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 49 */ ?>/js/mainCatMaps.js"></script>
    <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 50 */ ?>/js/main.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAq_FnSD00VYTGX5ls-Tua4r8bt5ItYs9k&callback=initialize"></script>
<?php
	}


	function blockHead($_args)
	{
?>    <meta charset="utf-8">
    <title>Cat Maps</title>
    
        
        
        
<?php
	}

}
