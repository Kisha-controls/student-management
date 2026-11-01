<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    private function as(string $email) { return $this->actingAs(User::where('email', $email)->first()); }

    public function test_seeders_are_idempotent(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->assertSame(6, Student::count());
        $this->assertSame(4, Course::count());
        $this->assertSame(12, CourseRegistration::count());
        $this->assertSame(9, User::count());
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/students')->assertRedirect('/login');
    }

    public function test_pages_load_for_each_role(): void
    {
        $this->get('/')->assertOk()->assertSee('Guaranteed');
        $this->get('/login')->assertOk();
        $this->get('/contact')->assertOk();
        foreach (['/dashboard', '/students', '/students/create', '/courses', '/courses/create', '/registrations', '/registrations/create', '/admin/users', '/admin/users/create'] as $url) {
            $this->as('admin@sms.test')->get($url)->assertOk();
        }
        $this->as('admin@sms.test')->get('/students/1')->assertOk();
        $this->as('admin@sms.test')->get('/students/1/edit')->assertOk();
        $this->as('admin@sms.test')->get('/courses/1')->assertOk();
        $this->as('admin@sms.test')->get('/courses/1/edit')->assertOk();
        $this->as('admin@sms.test')->get('/admin/users/1/edit')->assertOk();
        foreach (['/dashboard', '/courses', '/registrations'] as $url) {
            $this->as('student1@sms.test')->get($url)->assertOk();
            $this->as('lecturer1@sms.test')->get($url === '/registrations' ? '/dashboard' : $url)->assertOk();
        }
    }

    public function test_login_and_register(): void
    {
        $this->post('/login', ['email' => 'admin@sms.test', 'password' => 'password'])->assertRedirect('/dashboard');
        auth()->logout();
        $this->post('/login', ['email' => 'admin@sms.test', 'password' => 'wrong'])->assertSessionHasErrors('email');
        auth()->logout();
        $this->post('/register', ['name' => 'New Kid', 'email' => 'kid@sms.test', 'student_number' => 'X1', 'programme' => 'BBC', 'year_of_study' => 1, 'password' => 'secret123', 'password_confirmation' => 'secret123'])->assertRedirect('/dashboard');
        $this->assertTrue(User::where('email', 'kid@sms.test')->first()->hasRole('student'));
        $this->assertSame(1, Student::where('student_number', 'X1')->count());
    }

    public function test_student_cannot_manage_records(): void
    {
        $this->as('student1@sms.test')->get('/students')->assertForbidden();
        $this->as('student1@sms.test')->get('/courses/create')->assertForbidden();
        $this->as('student1@sms.test')->get('/admin/users')->assertForbidden();
        $this->as('student1@sms.test')->get('/registrations/create')->assertForbidden();
    }

    public function test_lecturer_only_sees_own_courses(): void
    {
        $own = Course::where('code', 'BUC3131')->first();
        $other = Course::where('code', 'BBC3127')->first();
        $this->as('lecturer1@sms.test')->get('/courses')->assertSee('BUC3131')->assertDontSee('BBC3127');
        $this->as('lecturer1@sms.test')->get("/courses/{$own->id}")->assertOk()->assertSee('Registered students');
        $this->as('lecturer1@sms.test')->get("/courses/{$other->id}")->assertForbidden();
        $this->as('lecturer1@sms.test')->get('/students')->assertForbidden();
        $this->as('lecturer1@sms.test')->get('/registrations')->assertForbidden();
    }

    public function test_student_sees_only_own_registrations_and_cannot_drop_others(): void
    {
        $this->as('student5@sms.test')->get('/registrations')->assertOk()->assertSee('BUC3112')->assertDontSee('2024/BBC/001');
        $others = CourseRegistration::where('student_id', Student::where('student_number', '2024/BBC/001')->value('id'))->first();
        $this->as('student5@sms.test')->delete("/registrations/{$others->id}")->assertForbidden();
        $this->assertNotNull(CourseRegistration::find($others->id));
    }

    public function test_registration_blocks_duplicates_and_full_courses(): void
    {
        $course = Course::where('code', 'BUC3131')->first();
        // student5 is not yet in BUC3131
        $this->as('student5@sms.test')->post('/registrations', ['course_id' => $course->id])->assertRedirect('/registrations');
        $this->as('student5@sms.test')->post('/registrations', ['course_id' => $course->id])->assertSessionHas('error');
        $this->assertSame(1, CourseRegistration::where('course_id', $course->id)->where('student_id', Student::where('student_number', '2024/BIT/005')->value('id'))->count());
        $this->as('student5@sms.test')->post('/registrations', ['course_id' => 999])->assertSessionHasErrors('course_id');

        $course->update(['capacity' => $course->students()->count()]);
        $this->as('student6@sms.test')->post('/registrations', ['course_id' => $course->id])->assertSessionHas('error');
    }

    public function test_relationships(): void
    {
        $s = Student::where('student_number', '2024/BBC/001')->first();
        $this->assertSame(3, $s->courses()->count());
        $c = Course::where('code', 'BUC3131')->first();
        $this->assertSame(3, $c->students()->count());
        $this->assertSame('Dr. Grace Namutebi', $c->lecturer->name);
        $this->assertSame(2, $c->lecturer->taughtCourses()->count());
        $this->assertSame($s->user->id, User::where('email', 'student1@sms.test')->first()->id);
    }

    public function test_admin_crud(): void
    {
        $this->as('admin@sms.test');
        $this->post('/students', ['name' => 'Zed', 'email' => 'zed@sms.test', 'student_number' => 'Z1', 'programme' => 'BBC', 'year_of_study' => 2])->assertRedirect('/students');
        $st = Student::where('student_number', 'Z1')->first();
        $this->assertTrue($st->user->hasRole('student'));
        $this->put("/students/{$st->id}", ['name' => 'Zed2', 'email' => 'zed@sms.test', 'student_number' => 'Z1', 'programme' => 'BBC', 'year_of_study' => 3])->assertRedirect('/students');
        $this->assertSame('Zed2', $st->fresh()->user->name);
        $this->post('/students', ['name' => '', 'email' => 'bad'])->assertSessionHasErrors(['name', 'email', 'student_number']);
        $this->delete("/students/{$st->id}")->assertRedirect('/students');
        $this->assertNull(Student::find($st->id));

        $this->post('/courses', ['code' => 'NEW1', 'title' => 'New', 'credit_units' => 3, 'capacity' => 10, 'lecturer_id' => ''])->assertRedirect('/courses');
        $c = Course::where('code', 'NEW1')->first();
        $this->post('/courses', ['code' => 'NEW1', 'title' => 'Dup', 'credit_units' => 3, 'capacity' => 10])->assertSessionHasErrors('code');
        $this->put("/courses/{$c->id}", ['code' => 'NEW1', 'title' => 'Renamed', 'credit_units' => 4, 'capacity' => 10])->assertRedirect('/courses');
        $this->delete("/courses/{$c->id}")->assertRedirect('/courses');

        $s = Student::first(); $course = Course::where('code', 'BUC3105')->first();
        $this->post('/registrations', ['student_id' => Student::where('student_number', '2024/BIT/005')->value('id'), 'course_id' => $course->id])->assertRedirect('/registrations');
        $this->post('/admin/users', ['name' => 'Lec3', 'email' => 'l3@sms.test', 'password' => 'secret123', 'password_confirmation' => 'secret123', 'role' => 'lecturer'])->assertRedirect('/admin/users');
        $u = User::where('email', 'l3@sms.test')->first();
        $this->put("/admin/users/{$u->id}", ['name' => 'Lec3', 'email' => 'l3@sms.test', 'role' => 'admin'])->assertRedirect('/admin/users');
        $this->assertTrue($u->fresh()->hasRole('admin'));
        $this->delete('/admin/users/'.User::where('email', 'admin@sms.test')->value('id'))->assertSessionHas('error');
    }
}
