<?php

namespace Tests\Feature;

use App\Models\Events;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_can_read_all_the_events()
    {
        $event = Events::factory()->create();
        $response = $this->get('/event');
        $response->assertSee($event->title);
    }


    /** @test */
    public function users_can_create_a_new_event()
    {
        $event = Events::factory()->make();
       $this->post('/event',$event->toArray());
        $this->assertEquals(1,Events::all()->count());
    }

    /** @test */
    public function a_user_can_read_single_event()
    {
        $event = Events::factory()->create();
        $response = $this->get('/event/'.$event->id);
        $response->assertSee($event->title)
            ->assertSee($event->description);
    }

    /** @test */
    public function an_event_requires_a_title(){
        $events = Events::factory()->make(['title' => null]);
        $this->post('/event',$events->toArray())
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function an_event_requires_a_description(){

        $events = Events::factory()->make(['description' => null]);
        $this->post('/event',$events->toArray())
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_update_the_event(){

        $event = Events::factory()->create();
        $event->title = "Updated Title";
        $this->put('/event/'.$event->id, $event->toArray());
        $this->assertDatabaseHas('events',['id'=> $event->id , 'title' => 'Updated Title']);

    }

    /** @test */
    public function user_can_delete_the_event(){

        $event = Events::factory()->create();
        $this->delete('/event/'.$event->id);
        $this->assertDatabaseMissing('events',['id'=> $event->id]);

    }



}
