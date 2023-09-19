<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use DTApi\Helpers\TeHelper;

class TeHelperTest extends TestCase
{
    use RefreshDatabase;

    public function testWillExpireAt()
    {
        // Define test data for due_time and created_at
        $due_time = Carbon::now();
        $created_at = Carbon::now()->subHours(2); // 2 hours ago

        // Call the willExpireAt method with the test data
        $result = TeHelper::willExpireAt($due_time, $created_at);

        // Assert that the result is a valid DateTime string
        $this->assertInstanceOf(Carbon::class, $result);

        // You can add assertions to check specific conditions based on your logic
        // For example, if $difference <= 90, the result should be equal to $due_time
        if ($created_at->diffInHours($due_time) <= 90) {
            $this->assertEquals($due_time->format('Y-m-d H:i:s'), $result->format('Y-m-d H:i:s'));
        } elseif ($created_at->diffInHours($due_time) <= 24) {
            // Add assertions for this case
            $this->assertEquals($created_at->addMinutes(90)->format('Y-m-d H:i:s'), $result->format('Y-m-d H:i:s'));
        } elseif ($created_at->diffInHours($due_time) > 24 && $created_at->diffInHours($due_time) <= 72) {
            // Add assertions for this case
            $this->assertEquals($created_at->addHours(16)->format('Y-m-d H:i:s'), $result->format('Y-m-d H:i:s'));
        } else {
            // Add assertions for this case
            $this->assertEquals($due_time->subHours(48)->format('Y-m-d H:i:s'), $result->format('Y-m-d H:i:s'));
        }
    }
}
