<?php

namespace Pimlie\DataTables\Tests;

use Yajra\DataTables\DataTables;
use Pimlie\DataTables\Tests\Models\Post;
use Pimlie\DataTables\Tests\TestCase;

// Skip these tests, $lookup/joins are not supported
abstract class BelongsToRelationTest extends TestCase
{
    /** @test */
    public function it_returns_all_records_with_the_relation_when_called_without_parameters()
    {
        $response = $this->call('GET', '/relations/belongsTo');
        $response->assertJson([
            'draw'            => 0,
            'recordsTotal'    => 60,
            'recordsFiltered' => 60,
        ]);

        $this->assertArrayHasKey('user', $response->json()['data'][0]);
        $this->assertEquals(60, count($response->json()['data']));
    }

    /** @test */
    public function it_can_perform_global_search_on_the_relation()
    {
        $response = $this->getJsonResponse([
            'search' => ['value' => 'email-19@example.com'],
        ]);

        $response->assertJson([
            'draw'            => 0,
            'recordsTotal'    => 60,
            'recordsFiltered' => 3,
        ]);

        $this->assertEquals(3, count($response->json()['data']));
    }

    /** @test */
    public function it_can_sort_using_the_relation_with_pagination()
    {
        $response = $this->getJsonResponse([
            'order'  => [
                [
                    'column' => 1,
                    'dir'    => 'desc',
                ],
            ],
            'length' => 10,
            'start'  => 0,
            'draw'   => 1,
        ]);

        $response->assertJson([
            'draw'            => 1,
            'recordsTotal'    => 60,
            'recordsFiltered' => 60,
        ]);

        $this->assertEquals('Email-9@example.com', $response->json()['data'][0]['user']['email']);
        $this->assertEquals(10, count($response->json()['data']));
    }

    protected function getJsonResponse(array $params = [])
    {
        $data = [
            'columns' => [
                ['data' => 'user.name', 'name' => 'user.name', 'searchable' => "true", 'orderable' => "true"],
                ['data' => 'user.email', 'name' => 'user.email', 'searchable' => "true", 'orderable' => "true"],
                ['data' => 'title', 'name' => 'posts.title', 'searchable' => "true", 'orderable' => "true"],
            ],
        ];

        return $this->call('GET', '/relations/belongsTo', array_merge($data, $params));
    }

    protected function setUp()
    {
        parent::setUp();

        $this->app['router']->get('/relations/belongsTo', function () {
            return datatables(Post::with('user')->select('posts.*'))->make('true');
        });
    }
}