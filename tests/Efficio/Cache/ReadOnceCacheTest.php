<?php

namespace Efficio\Tests\Cache;

use Efficio\Cache\ReadOnceCache;
use PHPUnit_Framework_TestCase;

class ReadOnceCacheTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RuntimeCache
     */
    public $cache;

    public function setUp()
    {
        $this->cache = new ReadOnceCache;
    }

    public function testValuesCanBeSet()
    {
        $this->assertTrue($this->cache->set('name', 'Marcos'));
        $this->assertTrue($this->cache->has('name'));
    }

    public function testValuesCanBeSetThenRead()
    {
        $this->cache->set('name', 'Marcos');
        $this->assertEquals('Marcos', $this->cache->get('name'));
    }

    public function testValuesCanBeSetThenReadAndIsThenUnset()
    {
        $this->cache->set('name', 'Marcos');
        $this->cache->get('name');
        $this->assertFalse($this->cache->has('name'));
    }
}
