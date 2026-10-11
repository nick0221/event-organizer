<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Event;
use App\Models\EventSchedule;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@eventorganizer.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Create a Customer
        $customer = Customer::create([
            'user_id' => null, // Guest booking example
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '555-0198',
            'company' => 'Tech Corp',
            'address' => '123 Main St, Cityville',
        ]);

        // 3. Create an Event
        $event = Event::create([
            'title' => 'Annual Tech Summit 2026',
            'slug' => 'annual-tech-summit-2026',
            'description' => 'A premier gathering of tech leaders and innovators.',
            'category' => 'Conference',
            'base_price' => 299.99,
            'total_capacity' => 500,
            'status' => 'published',
            'start_date' => '2026-11-15',
            'end_date' => '2026-11-17',
        ]);

        // 4. Create Event Schedules
        $schedule = EventSchedule::create([
            'event_id' => $event->id,
            'schedule_date' => '2026-11-15',
            'start_time' => '09:00:00',
            'end_time' => '17:00:00',
            'available_slots' => 500,
        ]);

        // 5. Create a Booking
        $booking = Booking::create([
            'customer_id' => $customer->id,
            'event_schedule_id' => $schedule->id,
            'status' => 'confirmed',
            'total_amount' => 299.99,
            'payment_status' => 'paid',
        ]);

        // Deduct available slots
        $schedule->decrement('available_slots', 1);



        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
