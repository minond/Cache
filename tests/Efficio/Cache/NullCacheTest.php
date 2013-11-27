<?php

namespace Efficio\Tests\Cache;

use Efficio\Cache\NullCache;
use PHPUnit_Framework_TestCase;

class NullCacheTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var NullCache
     */
    public $cache;

    public function setUp()
    {
        $this->cache = new NullCache;
    }

    public function testSetterReturnsTrue()
    {
        $this->assertTrue($this->cache->set('name', 'Marcos'));
    }

    public function testValuesAreThrownAway()
    {
        $this->cache->set('name', 'Marcos');
        $this->assertFalse($this->cache->has('name'));
    }

    public function testCountIsZero()
    {
        $this->cache->set('name1', 'Marcos');
        $this->cache->set('name2', 'Marcos');
        $this->cache->set('name3', 'Marcos');
        $this->cache->set('name4', 'Marcos');
        $this->assertEquals(0, count($this->cache));
    }
}
