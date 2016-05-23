<?php

use \Mockery as m;

class FileMoveUnpackedProcessorTest extends PHPUnit_Framework_TestCase
{
     public function tearDown() {
          m::close();
     }

     public function testFileMoved() {
          $filesystem = m::mock('files');
          $filesystem->shouldReceive('glob')->once()->andReturn(['test.txt']);
          $filesystem->shouldReceive('move')->once();
          $filesystem->shouldReceive('copy')->once();
          $filesystem->shouldReceive('delete')->once();
          $move = new \App\Processors\FileMoveUnpackedProcessor('', '', '', $filesystem);
          $this->assertTrue($move->execute());
     }
}