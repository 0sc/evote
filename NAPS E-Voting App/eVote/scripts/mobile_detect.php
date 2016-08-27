<?
	 function isMobile(){
		 $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		 $mobile_browser = '0';
		 
		 if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i', $ua)) {
			 $mobile_browser++;
		 }
		 
		 if (stripos($_SERVER['HTTP_ACCEPT'], 'application/vnd.wap.xhtml+xml') !== false ||
		 isset($_SERVER['HTTP_X_WAP_PROFILE']) ||
		 isset($_SERVER['HTTP_PROFILE'])) {
			 $mobile_browser++;
		 }
		 
		 $mobile_ua = substr($ua, 0, 4);
		 $mobile_agents = array(
			 'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
			 'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
			 'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
			 'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
			 'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
			 'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
			 'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
			 'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
			 'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-');
		 
		 if (in_array($mobile_ua, $mobile_agents)) {
			 $mobile_browser++;
		 }

		 if (isset($_SERVER['ALL_HTTP']) && stripos($_SERVER['ALL_HTTP'], 'operamini') !== false) {
			 $mobile_browser++;
		 }
		 
		 if (strpos($ua, 'windows') > 0) {
			 $mobile_browser = 0;
		 }
		 
		 $_switcher_is_mobile_browser = ($mobile_browser > 0);
			
		 return $_switcher_is_mobile_browser;
	 }
?>