<?php
return array(
	//'配置项'=>'配置值'
	// 'SHOW_PAGE_TRACE' => true,
	'TMPL_L_DELIM' => '<{', //修改左定界符
	'TMPL_R_DELIM' => '}>', //修改右定界符
	'DB_PREFIX' => 'fr_',//必须有，没有前缀写作'DB_PREFIX' => '',
	'DB_DSN' => 'mysql://root:@localhost:3306/fanruo',
	'TMPL_CACHE_ON' => false,
);
?>