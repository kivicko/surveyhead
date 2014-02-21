<?php
class controller{

	public $module = '';
	public $page = '';
	protected $_pageOutput = '';

	public function run(){

		$this -> _parseUrl();
		$this -> _includePage();

		$layout = new layout($this);
		$layout->exec();
	}

	protected function _parseUrl(){
		if(isset($_GET["action"])){
			$action = $_GET["action"];
			
			if( isset($action) ){
				
				$this->page = $action;
			
			}else{
				
				$this->page = "error";
			}
		}else{

				$this->page = "start";
			}

		}

	protected function _includePage(){
		if(is_file("../modules/" . $this->page . ".php") ){
			
			ob_start();
			include_once "../modules/" . $this->page . ".php";
			$this->_pageOutput = ob_get_contents();
				if(ob_get_length()>0){
					ob_clean();
				}
		}else{
			
			ob_start();
			include_once "../modules/notFound.php";
			$this->_pageOutput = ob_get_contents();
				if(ob_get_length()>0){
					ob_clean();
				}
		}

	}

	public function getPageOutput(){

		return $this->_pageOutput;
	}

	public function getHeader(){

		return $this->page;
	}

}
?>