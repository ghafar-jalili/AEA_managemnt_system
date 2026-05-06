# Course Request & Waitlist System

## Overview
Add a system allowing students to request courses, track interest, and automatically notify admin when enough students (3+) want the same course. Courses can have a "will_start_soon" status before officially launching.

---

## Phase 1: Database Migration

### 1.1 Add Course Status Fields
**File**: Create migration `add_course_request_fields_to_courses_table.php`

Add to `courses` table:
- `status` enum: 'active', 'inactive', 'will_start_soon' (default: 'active')
- `minimum_students` integer (default: 3)
- `current_interested_count` integer (default: 0)
- `scheduled_start_time` string nullable (e.g., "3:00 PM")

### 1.2 Create Course Requests Table
**File**: Create migration `create_course_requests_table.php`

```
course_requests:
- id
- course_name (string) - e.g., "AutoCAD"
- student_name (string)
- student_phone (string)
- student_id (foreign key, nullable if not registered)
- preferred_time (string) - e.g., "3:00 PM"
- status: 'pending', 'notified', 'enrolled'
- created_at
- updated_at
```

---

## Phase 2: Models

### 2.1 Update Course Model
**File**: `app/Models/Course.php`

Add to `$fillable`:
- `status`
- `minimum_students`
- `current_interested_count`
- `scheduled_start_time`

Add new scope:
```php
public function scopeWillStartSoon($query)
{
    return $query->where('status', 'will_start_soon');
}

public function scopeRequestable($query)
{
    return $query->whereIn('status', ['active', 'will_start_soon']);
}
```

Add relationships:
```php
public function requests()
{
    return $this->hasMany(CourseRequest::class);
}
```

### 2.2 Create CourseRequest Model
**File**: Create `app/Models/CourseRequest.php`

```php
class CourseRequest extends Model
{
    protected $fillable = [
        'course_name',
        'student_name',
        'student_phone',
        'student_id',
        'preferred_time',
        'status'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function getGroupedByNameAttribute()
    {
        return static::where('course_name', $this->course_name)
                     ->where('status', 'pending')
                     ->count();
    }
}
```

---

## Phase 3: Controllers

### 3.1 Update CourseController
**File**: `app/Http/Controllers/CourseController.php`

Add methods:
```php
// For public users and students
public function requestCourse(Request $request)
{
    // Validate: course_name, student_name, student_phone, preferred_time
    // Create CourseRequest record
    // Check if 3+ requests exist for this course
    // If yes, update course interested_count and create notification
    // Return success message
}

public function showWishlistCourses()
{
    // Get all unique course requests grouped by course_name
    // Show courses with 1-2 requests (not yet started)
    // Display "I Want This Course" button
}
```

### 3.2 Create CourseRequestController
**File**: Create `app/Http/Controllers/Admin/CourseRequestController.php`

```php
class CourseRequestController extends Controller
{
    public function index()
    {
        // Show all course requests grouped by course
        // Highlight courses with 3+ requests
        // Show "Create Course" button for ready courses
    }

    public function createCourseFromRequest($courseName)
    {
        // Admin creates actual course from requests
        // Set status to 'will_start_soon'
        // Ask for: teacher, price, scheduled time
        // Enroll all requesting students
        // Update their request status to 'enrolled'
        // Send notifications to students
    }

    public function notifyAdmin($courseName)
    {
        // Create in-app notification for admin
        // Mark requests as 'notified'
    }
}
```

---

## Phase 4: Routes

### 4.1 Add Public Routes
**File**: `routes/web.php`

```php
// Public course request
Route::post('/courses/request', [CourseController::class, 'requestCourse'])
     ->name('courses.request');

// View wishlist courses (courses people want)
Route::get('/courses/wishlist', [CourseController::class, 'showWishlistCourses'])
     ->name('courses.wishlist');
```

### 4.2 Add Admin Routes
**File**: `routes/web.php` (inside admin middleware group)

```php
// Course request management
Route::get('/course-requests', [CourseRequestController::class, 'index'])
     ->name('course-requests.index');
Route::post('/course-requests/{courseName}/create-course', 
     [CourseRequestController::class, 'createCourseFromRequest'])
     ->name('course-requests.create-course');
Route::post('/course-requests/{courseName}/notify', 
     [CourseRequestController::class, 'notifyAdmin'])
     ->name('course-requests.notify');
```

---

## Phase 5: Views

### 5.1 Add "Request Course" Button to Course Show Page
**File**: `resources/views/courses/show.blade.php`

After course details, add:
```blade
@if($course->status === 'will_start_soon')
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4">
        <h4 class="font-bold text-yellow-900">This course will start soon!</h4>
        <p>{{ $course->current_interested_count }} students interested</p>
        <form action="{{ route('courses.request') }}" method="POST">
            <!-- Name, Phone, Time fields -->
            <button>I Want This Course</button>
        </form>
    </div>
@endif
```

### 5.2 Create Wishlist Courses Page
**File**: Create `resources/views/courses/wishlist.blade.php`

Display:
- Grid of requested courses
- Each card shows:
  - Course name
  - Number of interested students (e.g., "2/3 students")
  - Progress bar
  - "I Want This Course" button with modal
  - Requested times from other students

Modal form:
- Student Name (required)
- Phone Number (required)
- Preferred Time (dropdown or text input)
- Submit button

### 5.3 Add Wishlist Link to Navigation
**File**: `resources/views/layouts/navigation.blade.php`

Add link in courses dropdown:
```blade
<a href="{{ route('courses.wishlist') }}">Courses Wishlist</a>
```

### 5.4 Create Admin Course Requests Dashboard
**File**: Create `resources/views/admin/course-requests/index.blade.php`

Features:
- Stats cards: Total requests, Courses ready to start (3+), Pending courses
- Table grouped by course name:
  - Course name
  - Number of requests
  - Status badge (Pending/Ready/Notified)
  - Requested times
  - "Create Course" button (enabled when 3+ requests)
- Click "Create Course" opens modal/form:
  - Pre-filled: course name, student list
  - Admin enters: teacher, price, scheduled time
  - Submit creates course and enrolls students

### 5.5 Add Admin Dashboard Notification Badge
**File**: `resources/views/admin/dashboard.blade.php`

Add to Quick Actions:
```blade
<a href="{{ route('admin.course-requests.index') }}" class="...">
    <i class="fas fa-bell text-white text-xl"></i>
    @if($pendingCourseRequests > 0)
        <span class="badge">{{ $pendingCourseRequests }}</span>
    @endif
    <h5>Course Requests</h5>
</a>
```

---

## Phase 6: Notification Logic

### 6.1 Create Notification Check
**File**: Create `app/Http/Controllers/Admin/AdminDashboardController.php` (update existing)

Add to dashboard method:
```php
$pendingCourseRequests = CourseRequest::select('course_name')
    ->where('status', 'pending')
    ->groupBy('course_name')
    ->havingRaw('COUNT(*) >= 3')
    ->count();
```

### 6.2 Auto-Check on New Request
**File**: In `CourseController::requestCourse()`

After creating request:
```php
$interestedCount = CourseRequest::where('course_name', $courseName)
    ->where('status', 'pending')
    ->count();

if ($interestedCount >= 3) {
    // Create in-app notification for admin
    // Could store in a notifications table or session
    session()->flash('admin_alert', 
        "Course '{$courseName}' has {$interestedCount} requests and is ready to start!");
}
```

---

## Phase 7: Workflow Summary

### Student Workflow:
1. Student visits `/courses` or `/courses/wishlist`
2. Sees course they want (either existing or requested by others)
3. Clicks "I Want This Course" button
4. Fills form: Name, Phone, Preferred Time
5. Submits request
6. If 3+ students requested same course:
   - Course status changes to "will_start_soon"
   - Admin gets notification
   - Student sees message: "We'll contact you soon!"

### Admin Workflow:
1. Admin sees notification badge on dashboard
2. Clicks "Course Requests" in Quick Actions
3. Views all pending requests grouped by course
4. Courses with 3+ requests show "Create Course" button
5. Admin clicks "Create Course"
6. Fills form: Teacher, Price, Scheduled Time
7. System:
   - Creates actual course with status "will_start_soon"
   - Enrolls all requesting students automatically
   - Updates their request status to "enrolled"
   - Shows success message

### Student After Course Created:
1. Student receives notification (in-app)
2. Can see course in "My Courses"
3. Can attend classes when course becomes "active"

---

## Phase 8: Testing Checklist

- [ ] Student can request a course with name, phone, time
- [ ] Request count increments correctly
- [ ] Course status updates to "will_start_soon" at 3 requests
- [ ] Admin sees notification on dashboard
- [ ] Admin can view all requests in course-requests page
- [ ] Admin can create course from requests
- [ ] Students auto-enrolled when course created
- [ ] Wishlist page shows all requested courses
- [ ] Progress bars show request count (1/3, 2/3, 3/3 ✓)
- [ ] Form validation works (required fields, phone format)
- [ ] Non-registered users can submit requests
- [ ] Registered users get their user_id linked automatically

---

## Files to Create/Modify:

**New Files:**
- `database/migrations/xxxx_add_course_request_fields_to_courses_table.php`
- `database/migrations/xxxx_create_course_requests_table.php`
- `app/Models/CourseRequest.php`
- `app/Http/Controllers/Admin/CourseRequestController.php`
- `resources/views/courses/wishlist.blade.php`
- `resources/views/admin/course-requests/index.blade.php`

**Modified Files:**
- `app/Models/Course.php` - Add fields, scopes, relationships
- `app/Http/Controllers/CourseController.php` - Add request methods
- `app/Http/Controllers/Admin/AdminDashboardController.php` - Add notification count
- `routes/web.php` - Add new routes
- `resources/views/courses/show.blade.php` - Add request form
- `resources/views/layouts/navigation.blade.php` - Add wishlist link
- `resources/views/admin/dashboard.blade.php` - Add course requests card

---

This plan provides a complete course request and waitlist system that integrates seamlessly with your existing course management!
