--TEST--
CacheFile::update()

--FILE--
<?php
	require_once dirname(__FILE__) . '/../cachecore.class.php';
	require_once dirname(__FILE__) . '/../cachefile.class.php';
	$cache = new CacheFile('test', dirname(__FILE__) . '/cache', 60);
	$cache->create('test data');
	var_dump($cache->update('test data updated'));
	var_dump($cache->update('test data updated'));
?>

--EXPECT--
bool(true)
bool(true)

--CLEAN--
<?php
	require_once dirname(__FILE__) . '/../cachecore.class.php';
	require_once dirname(__FILE__) . '/../cachefile.class.php';
	$cache = new CacheFile('test', dirname(__FILE__) . '/cache', 60);
	$cache->delete();
?>
