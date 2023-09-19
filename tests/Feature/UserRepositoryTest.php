<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use DTApi\Models\User;
use DTApi\Repository\UserRepository;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateOrUpdateUser()
    {
        // Create a user input data array for testing
        $userData = [
            'role' => 'customer',
            'name' => 'John Doe',
            // Add other user data here...
        ];

        // Instantiate the UserRepository
        $userRepository = new UserRepository(new User);

        // Call the createOrUpdate method with the user data
        $user = $userRepository->createOrUpdate(null, $userData);

        // Assert that the user was created or updated
        $this->assertInstanceOf(User::class, $user);

        // You can add additional assertions to check specific attributes or conditions
        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('customer', $user->user_type);
        // Add more assertions for other attributes...

        // You can also test the case when updating an existing user
        $updatedUserData = [
            'name' => 'Updated Name',
            // Add other updated user data here...
        ];

        // Call the createOrUpdate method with an existing user ID
        $updatedUser = $userRepository->createOrUpdate($user->id, $updatedUserData);

        // Assert that the user was updated
        $this->assertEquals('Updated Name', $updatedUser->name);

    }
}
