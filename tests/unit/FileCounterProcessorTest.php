<?php

use \Mockery as m;

class FileCounterProcessorTest extends PHPUnit_Framework_TestCase
{
     public function tearDown() {
          m::close();
     }

     public function testFileLineCount() {
          $path = __DIR__ . '/test.txt';
          $counter = new \App\Processors\FileCounterProcessor($path);
          $count = $counter->execute();
          $this->assertEquals(33, $count);
     }

     /**
      * @expectedException ErrorException
      */
     public function testNoFileFound() {
          $path = __DIR__ . '/notest.txt';
          $counter = new \App\Processors\FileCounterProcessor($path);
          $counter->execute();
     }
}