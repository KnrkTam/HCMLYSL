<?php
/**
 * elFinder Plugin Abstract
 *
 * @package elfinder
 * @author Naoki Sawada
 * @license New BSD
 */
class elFinderPlugin {
	
	/**
	 * This plugin's options
	 * 
	 * @var array
	 */
	protected $opts = array();
	
	/**
	 * Get current volume's options
	 * 
	 * @param object $volume
	 * @return array options
	 */
	protected function getCurrentOpts($volume) {
		$name = substr(get_class($this), 14); // remove "elFinderPlugin"
		$opts = $this->opts;
		if (is_object($volume)) {
			$volOpts = $volume->getOptionsPlugin($name);
			if (is_array($volOpts)) {
				$opts = array_merge($opts, $volOpts);
			}
		}
		return $opts;
	}
	
	/**
	 * Is enabled with options
	 * 
	 * @param array $opts
	 * @return boolean
	 */
	protected function iaEnabled($opts) {
		if (! $opts['enable']) {
			return false;
		}
		
		if (isset($opts['offDropWith']) && ! is_null($opts['offDropWith']) && isset($_REQUEST['dropWith'])) {
			$offDropWith = $opts['offDropWith'];
			$action = (int)$_REQUEST['dropWith'];
			if (! is_array($offDropWith)) {
				$offDropWith = array($offDropWith);
			}
			$res = true;
			foreach($offDropWith as $key) {
				$key = (int)$key;
				if ($key === 0) {
					if ($action === 0) {
						$res = false;
						break;
					}
				} else {
					if (($action & $key) === $key) {
						$res = false;
						break;
					}
				}
			}
			if (! $res) {
				return false;
			}
		}
		
		return true;
	}
}