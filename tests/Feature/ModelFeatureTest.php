<?php


namespace AppsLab\Acl\Tests\Feature;
use AppsLab\Acl\Models\Review;
use AppsLab\Acl\Tests\TestCase;
use AppsLab\Acl\ReviewableServiceProvider;

class ModelFeatureTest extends TestCase
{
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    public function testCanCreateRole()
    {
        $role = new Review();

        dd(config('yaa.models.permission'));

//        $this->assertCount(1, Role::all());
    }
}