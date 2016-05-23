<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Nonprofit;

class GetNonprofitApiTest extends TestCase
{
     use DatabaseMigrations;

     public function testGetAllNonProfits() {
         factory(Nonprofit::class, 2)->create();
         $this->json('get', 'api/nonprofits')->seeJsonStructure(
             ['data' =>
                 ['*' =>
                     ['id', 'ein', 'name', 'city', 'state', 'country', 'deductibility_status_code']
                 ]
             ]
         );
     }
}