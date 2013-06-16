<?php

namespace Efficio\Tests\Cache;

use Efficio\Cache\RuntimeCache;
use PHPUnit_Framework_TestCase;

class RuntimeCacheTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RuntimeCache
     */
    public $cache;

    public function setUp()
    {
        $this->cache = new RuntimeCache;
    }

    public function testValuesCanBeSaved()
    {
        $this->assertTrue($this->cache->set('name', 'Marcos'));
    }

    public function testValuesCanBeRetrieved()
    {
        $this->cache->set('name', 'Marcos');
        $this->assertEquals('Marcos', $this->cache->get('name'));
    }

    public function testValuesCanBeFound()
    {
        $this->cache->set('name', 'Marcos');
        $this->assertTrue($this->cache->has('name'));
    }

    public function testValuesCannotBeFound()
    {
        $this->assertFalse($this->cache->has('name'));
    }

    public function testValuesCanBeDeleted()
    {
        $this->cache->set('name', 'Marcos');
        $this->cache->del('name');
        $this->assertFalse($this->cache->has('name'));
    }

    public function testCacheStartsOutEmpty()
    {
        $this->assertEquals(0, count($this->cache));
    }

    public function testValuesCanBeCounted()
    {
        $this->cache->set('name 1', 'Marcos');
        $this->cache->set('name 2', 'Marcos');
        $this->cache->set('name 3', 'Marcos');
        $this->assertEquals(3, count($this->cache));
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
