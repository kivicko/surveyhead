<?php
class layout{

	protected $_controller;
	protected $_output = '';
	protected $_theme = '';

	public function __construct(Controller $controller){
		$this->_controller = $controller;
		$this->_loadTheme();
	}

	public function exec(){
		$this->_replaceHTMLVariables();
		$this->_printOutput();

	}

	protected function _loadTheme(){
		if(is_file("../layout/siteLayout.html")){
			$this->_theme = file_get_contents("../layout/siteLayout.html");
		}else{
			echo "Cannot locate the theme!";
		}
	}

	protected function _replaceHTMLVariables(){

		$this->_theme = str_replace( "[content]" , $this->_controller->getPageOutput() , $this->_theme );
		$this->_theme = str_replace( "{header}" , $this->_setHeader() , $this->_theme );
	}
	protected function _printOutput(){
		echo $this->_theme;
	}
	protected function _setHeader(){
		return $this->_controller->getHeader();
	}
}
?>