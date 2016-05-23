<?php

use \Mockery as m;

class FileDatabaseProcessorTest extends PHPUnit_Framework_TestCase
{
     public function tearDown() {
          m::close();
     }

     public function testFileDatabaseExec() {
          $pdo = m::mock('PDO');
          $pdo->shouldReceive('quote')->atLeast(30);
          $pdo->shouldReceive('exec')->times(32);
          $path =  __DIR__ . '/test.txt';
          $db = new \App\Processors\FileDatabaseProcessor($path, $pdo);
          $this->assertTrue($db->execute());
     }
}