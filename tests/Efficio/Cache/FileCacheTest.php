<?php

namespace Efficio\Test\Cache;

use Efficio\Cache\FileCache;
use Efficio\Test\Mock\Cache\NoFileExistsOrMkdirCache;
use Efficio\Test\Mock\Cache\NoIsResourceCache;
use Efficio\Test\Mock\Cache\NoTouchCache;
use PHPUnit_Framework_TestCase;

require_once 'tests/mocks/Cache/NoFileExistsOrMkdirCache.php';
require_once 'tests/mocks/Cache/NoIsResourceCache.php';
require_once 'tests/mocks/Cache/NoTouchCache.php';

class FileCacheTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RuntimeCache
     */
    public $cache;

    public $cachedir = 'tests/mocks/Cache/cachedirectory/';

    public $cachefile = 'tests/mocks/Cache/cachedirectory/test.cache';

    public function setUp()
    {
        // lock it
        $this->cache = new FileCache($this->cachefile);
    }

    public function tearDown()
    {
        // unlock it
        $this->cache->__destruct();
    }

    public function testFileNameGetter()
    {
        $this->assertEquals($this->cachefile, $this->cache->getFileName());
    }

    public function testTemporaryDirectoryIsCreated()
    {
        $this->assertTrue(is_dir(dirname($this->cachefile)));
    }

    public function testTemporaryFileIsCreated()
    {
        $this->assertTrue(is_file($this->cachefile));
    }

    /**
     * @expectedException Exception
     */
    public function testGeneratingANewCacheObjectWithAFileAlreadyInUseTriggersError()
    {
        new FileCache($this->cachefile);
    }

    public function testExistingCacheObjectsCanBeRetrievedUsingFileNames()
    {
        $this->assertEquals($this->cache, FileCache::create($this->cachefile));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Error creating cache file directory: tests/mocks/Cache/cachedirectory
     */
    public function testCreatingDirectoryErrors()
    {
        $cache = new NoFileExistsOrMkdirCache($this->cachedir . 'failmkdir.cache');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Error finding tests/mocks/Cache/cachedirectory/failtouch.cache cache file.
     */
    public function testCreatingFileErrors()
    {
        $cache = new NoTouchCache($this->cachedir . 'failtouch.cache');
    }

    /**
     * @expectedException Exception
     */
    public function testReadingFileErrors()
    {
        $cache = new NoIsResourceCache($this->cachedir . 'failresource.cache');
    }

    public function testKeySetter()
    {
        $val = uniqid();
        $this->assertTrue($this->cache->set('name', $val));
        $this->assertTrue($this->cache->has('name'));
    }

    public function testKeyGetter()
    {
        $val = uniqid();
        $this->cache->set('name', $val);
        $this->assertEquals($val, $this->cache->get('name'));
    }

    public function testKeysCanBeDeleted()
    {
        $val = uniqid();
        $this->cache->set('name', $val);
        $this->assertTrue($this->cache->has('name'));
        $this->cache->del('name');
        $this->assertFalse($this->cache->has('name'));
    }

    public function testDataIsSavedInFile()
    {
        $str = '{"fname":"Marcos"}';
        $this->cache->clear();
        $this->cache->set('fname', 'Marcos');
        $this->cache->__destruct();
        $this->assertEquals($str, trim(file_get_contents($this->cachefile)));
    }

    public function testDataIsReloadedFromExistsingCacheFiles()
    {
        $str = '{"fname":"Marcos"}';
        $this->cache->clear();
        $this->cache->set('fname', 'Marcos');
        $this->cache->__destruct();

        $cache = new FileCache($this->cachefile);
        $this->assertEquals('Marcos', $cache->get('fname'));
    }

    public function testCacheCanBeCleared()
    {
        $this->cache->set('name 1', 'Marcos');
        $this->cache->set('name 2', 'Marcos');
        $this->cache->set('name 3', 'Marcos');
        $this->assertEquals(3, count($this->cache));
        $this->cache->clear();
        $this->assertEquals(0, count($this->cache));
    }
}
