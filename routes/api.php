<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Asset Categories
    Route::apiResource('asset-categories', 'AssetCategoryApiController');

    // Asset Locations
    Route::apiResource('asset-locations', 'AssetLocationApiController');

    // Asset Statuses
    Route::apiResource('asset-statuses', 'AssetStatusApiController');

    // Assets
    Route::post('assets/media', 'AssetApiController@storeMedia')->name('assets.storeMedia');
    Route::apiResource('assets', 'AssetApiController');

    // Assets Histories
    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Task Statuses
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tags
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Tasks
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Expense Categories
    Route::apiResource('expense-categories', 'ExpenseCategoryApiController');

    // Income Categories
    Route::apiResource('income-categories', 'IncomeCategoryApiController');

    // Expenses
    Route::apiResource('expenses', 'ExpenseApiController');

    // Incomes
    Route::apiResource('incomes', 'IncomeApiController');

    // Queries
    Route::apiResource('queries', 'QueriesApiController');

    // Courses
    Route::post('courses/media', 'CoursesApiController@storeMedia')->name('courses.storeMedia');
    Route::apiResource('courses', 'CoursesApiController');

    // Course Durations
    Route::apiResource('course-durations', 'CourseDurationApiController');

    // Query Statuses
    Route::apiResource('query-statuses', 'QueryStatusApiController');

    // Query Interaction Types
    Route::apiResource('query-interaction-types', 'QueryInteractionTypeApiController');

    // Batches
    Route::post('batches/media', 'BatchesApiController@storeMedia')->name('batches.storeMedia');
    Route::apiResource('batches', 'BatchesApiController');

    // Students
    Route::post('students/media', 'StudentsApiController@storeMedia')->name('students.storeMedia');
    Route::apiResource('students', 'StudentsApiController');

    // Batch Students
    Route::apiResource('batch-students', 'BatchStudentsApiController');

    // Student Statuses
    Route::apiResource('student-statuses', 'StudentStatusApiController');

    // Batch Attendances
    Route::apiResource('batch-attendances', 'BatchAttendanceApiController');

    // Employees
    Route::post('employees/media', 'EmployeesApiController@storeMedia')->name('employees.storeMedia');
    Route::apiResource('employees', 'EmployeesApiController');

    // Staff Attendances
    Route::apiResource('staff-attendances', 'StaffAttendanceApiController');

    // Student Tasks
    Route::post('student-tasks/media', 'StudentTaskApiController@storeMedia')->name('student-tasks.storeMedia');
    Route::apiResource('student-tasks', 'StudentTaskApiController');

    // Course Materials
    Route::post('course-materials/media', 'CourseMaterialApiController@storeMedia')->name('course-materials.storeMedia');
    Route::apiResource('course-materials', 'CourseMaterialApiController');

    // Course Videos
    Route::post('course-videos/media', 'CourseVideoApiController@storeMedia')->name('course-videos.storeMedia');
    Route::apiResource('course-videos', 'CourseVideoApiController');

    // Tests
    Route::apiResource('tests', 'TestsApiController');

    // Questions
    Route::post('questions/media', 'QuestionsApiController@storeMedia')->name('questions.storeMedia');
    Route::apiResource('questions', 'QuestionsApiController');

    // Question Options
    Route::apiResource('question-options', 'QuestionOptionsApiController');

    // Recoveries
    Route::apiResource('recoveries', 'RecoveriesApiController');

    // Payment Types
    Route::apiResource('payment-types', 'PaymentTypesApiController');

    // Batch Notifications
    Route::apiResource('batch-notifications', 'BatchNotificationsApiController');

    // Settings
    Route::apiResource('settings', 'SettingsApiController');

    // Staff Notifications
    Route::apiResource('staff-notifications', 'StaffNotificationApiController');

    // Daily Lesson Planners
    Route::post('daily-lesson-planners/media', 'DailyLessonPlannerApiController@storeMedia')->name('daily-lesson-planners.storeMedia');
    Route::apiResource('daily-lesson-planners', 'DailyLessonPlannerApiController');

    // Test Results
    Route::apiResource('test-results', 'TestResultsApiController');

    // Test Answers
    Route::apiResource('test-answers', 'TestAnswersApiController');

    // Certificates
    Route::apiResource('certificates', 'CertificateApiController');

    // Sms Templates
    Route::apiResource('sms-templates', 'SmsTemplatesApiController');

    // Email Templates
    Route::post('email-templates/media', 'EmailTemplatesApiController@storeMedia')->name('email-templates.storeMedia');
    Route::apiResource('email-templates', 'EmailTemplatesApiController');

    // Institution Calendars
    Route::apiResource('institution-calendars', 'InstitutionCalendarApiController');

    // Marketing Ads
    Route::post('marketing-ads/media', 'MarketingAdsApiController@storeMedia')->name('marketing-ads.storeMedia');
    Route::apiResource('marketing-ads', 'MarketingAdsApiController');
});
