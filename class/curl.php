<?php
class curl
{
	public $url;
	//public $useragent = "Opera/9.80 (J2ME/MIDP; Opera Mini/4.2.14912/870; U; id) Presto/2.4.15";
	public $useragent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1";
	public $output;
	public $explodeCount = 0;
	public $explodeArray;
	private $ch;
	private $filterlist;

	public function __construct ($url)
	{
		$this->url = $url;
		$this->ch = curl_init ();
		curl_setopt ($this->ch, CURLOPT_URL, $this->url);
		curl_setopt ($this->ch, CURLOPT_USERAGENT, $this->useragent);
		curl_setopt ($this->ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, TRUE);
		$this->output = curl_exec ($this->ch);
		curl_close($this->ch);
	}

	public function filterlist($array)
	{
		$this->filterlist = $array;
	}

	public function proxy($proxy)
	{
		curl_setopt($this->ch, CURLOPT_PROXY, $proxy);
	}

	public function explode($firstpattern,$lastpattern=null)
	{
		$explode = explode($firstpattern,$this->output);
		array_splice($explode, 0, 1);
		$this->explodeArray = $explode;
		$this->explodeCount = count($explode);

		if($lastpattern!=null)
		{
			$this->lastExplode($lastpattern);
		}
	}

	private function lastExplode($lastpattern)
	{
		$array = array();
		foreach ($this->explodeArray as $item) 
		{
			$item = explode($lastpattern,$item);
			if(array_search($item[0], $this->filterlist)!==0)
			{
				array_push($array, $item[0]);
			}
		}
		$this->explodeArray = $array;
	}
}

?>