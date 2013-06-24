<?php

namespace Efficio\Tests\Cache;

use Efficio\Test\Mock\Cache\CachingMock;
use Efficio\Cache\RuntimeCache;
use PHPUnit_Framework_TestCase;

require_once 'tests/mocks/Cache/CachingMock.php';

class CachingTest extends PHPUnit_Framework_TestCase
{
    public function testGetterAndSetter()
    {
        $cache = new RuntimeCache;
        $caching = new CachingMock;
        $caching->setCache($cache);
        $this->assertEquals($cache, $caching->getCache());
    }
}
