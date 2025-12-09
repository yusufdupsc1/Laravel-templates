<?php

namespace Tests\Feature;

use App\Models\AttendanceSummary;
use App\Models\ClassSession;
use App\Models\Invoice;
use App\Models\Message;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageRenderingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_dashboard_page_loads_with_configured_data(): void
    {
        $response = $this->get(route('dashboard'));

        $response
            ->assertOk()
            ->assertViewIs('dashboard')
            ->assertViewHas('dashboard', function (array $dashboard) {
                return isset($dashboard['overview'], $dashboard['stats'], $dashboard['charts']) && count($dashboard['classes']) > 0;
            });
    }

    public function test_students_page_uses_config_records(): void
    {
        $response = $this->get(route('students.index'));

        $response
            ->assertOk()
            ->assertViewIs('students')
            ->assertViewHas('students', function ($students) {
                return $students instanceof \Illuminate\Pagination\LengthAwarePaginator && $students->count() > 0;
            });
    }

    public function test_classes_page_renders_schedule(): void
    {
        $response = $this->get(route('classes.index'));

        $response
            ->assertOk()
            ->assertViewIs('classes')
            ->assertViewHas('classes', function ($classes) {
                return $classes instanceof \Illuminate\Pagination\LengthAwarePaginator && $classes->count() > 0;
            });
    }

    public function test_attendance_page_renders_tables(): void
    {
        $response = $this->get(route('attendance'));

        $response
            ->assertOk()
            ->assertViewIs('attendance')
            ->assertViewHasAll([
                'summary',
                'grades',
            ]);
    }

    public function test_finance_page_renders_collections_and_budgets(): void
    {
        $response = $this->get(route('finance.index'));

        $response
            ->assertOk()
            ->assertViewIs('finance')
            ->assertViewHasAll([
                'collections',
                'invoices',
                'budgets',
            ]);
    }

    public function test_messages_page_renders_threads_and_inbox(): void
    {
        $response = $this->get(route('messages.index'));

        $response
            ->assertOk()
            ->assertViewIs('messages')
            ->assertViewHasAll([
                'threads',
                'inbox',
            ]);
    }

    public function test_settings_page_renders_access_controls(): void
    {
        $response = $this->get(route('settings'));

        $response
            ->assertOk()
            ->assertViewIs('settings')
            ->assertViewHasAll([
                'settings',
                'teams',
            ]);
    }

    public function test_can_create_student_class_invoice_and_message(): void
    {
        $this->post(route('students.store'), [
            'name' => 'New Student',
            'grade' => '9 STEM',
            'gpa' => 3.50,
            'status' => 'Active',
            'guardian' => 'Guardian Name',
            'contact' => '+1 555 123 4567',
        ])->assertRedirect(route('students.index'));

        $this->post(route('classes.store'), [
            'name' => 'Biology',
            'teacher' => 'Jane Doe',
            'time' => '09:00 - 10:00',
            'room' => 'B2',
            'status' => 'Ready',
        ])->assertRedirect(route('classes.index'));

        $this->post(route('finance.store'), [
            'student' => 'New Student',
            'amount' => 1000,
            'status' => 'Pending',
            'due' => now()->format('Y-m-d'),
        ])->assertRedirect(route('finance.index'));

        $this->post(route('messages.store'), [
            'author' => 'Ops',
            'subject' => 'Test',
            'body' => 'Body',
            'priority' => 'Normal',
        ])->assertRedirect(route('messages.index'));

        $this->assertDatabaseHas('students', ['name' => 'New Student']);
        $this->assertDatabaseHas('class_sessions', ['name' => 'Biology']);
        $this->assertDatabaseHas('invoices', ['student' => 'New Student', 'amount' => 1000]);
        $this->assertDatabaseHas('messages', ['subject' => 'Test']);
    }

    public function test_student_validation_prevents_duplicates(): void
    {
        $payload = [
            'name' => 'Duplicate',
            'grade' => '9 STEM',
            'gpa' => 3.1,
            'status' => 'Active',
        ];

        $this->post(route('students.store'), $payload);
        $response = $this->post(route('students.store'), $payload);

        $response->assertSessionHasErrors('name');
    }
}
