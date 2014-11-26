<?php
class HomeController extends AppController
{
	var $uses	=	NULL;

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->set('lft_menu_category_id',"1");
	}

	public function Index()
	{

	}

	public function bilna() {
		$temp = file_get_contents("http://www.bilna.com/mamy-poko-tape-l-40.html");

		//preg_match_all ('/^<div class="price-box">(.*?)<span class="price">(.*?)<\/span>(.*?)<\/div>/s', $temp, $matches);
		preg_match_all('/<span class="price">/', $temp, $matches);
		pr($matches);
		var_dump($temp);
		/**
			preg_match_all("/^<div class="price-box">(.*?)<span class="price">(.*?)<\/span>(.*?)<\/div>/s", $input_lines, $output_array);
			<div class="price-box">
				<span class="regular-price">
					<span class="price">Rp90,000</span>
				</span>
			</div>
		**/
	}

}
?>
