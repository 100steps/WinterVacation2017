<?php
/**
 * 璀璨的死法 /common/cool_die.php
 * ====================================================
 * 包含几个自定义的die()函数，让你的代码死得与众不同 [滑稽]
 * ====================================================
 */
 
	function die_with_code($code) {
		http_response_code($code);
		die();
	}
?>
