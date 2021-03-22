<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Asset Categories
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Locations
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Statuses
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Assets
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets Histories
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Task Statuses
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tags
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Tasks
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendars
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Expense Categories
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Categories
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expenses
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Incomes
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Expense Reports
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Queries
    Route::delete('queries/destroy', 'QueriesController@massDestroy')->name('queries.massDestroy');
    Route::post('queries/parse-csv-import', 'QueriesController@parseCsvImport')->name('queries.parseCsvImport');
    Route::post('queries/process-csv-import', 'QueriesController@processCsvImport')->name('queries.processCsvImport');
    Route::resource('queries', 'QueriesController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::post('courses/parse-csv-import', 'CoursesController@parseCsvImport')->name('courses.parseCsvImport');
    Route::post('courses/process-csv-import', 'CoursesController@processCsvImport')->name('courses.processCsvImport');
    Route::resource('courses', 'CoursesController');

    // Course Durations
    Route::delete('course-durations/destroy', 'CourseDurationController@massDestroy')->name('course-durations.massDestroy');
    Route::resource('course-durations', 'CourseDurationController');

    // Query Statuses
    Route::delete('query-statuses/destroy', 'QueryStatusController@massDestroy')->name('query-statuses.massDestroy');
    Route::resource('query-statuses', 'QueryStatusController');

    // Query Interaction Types
    Route::delete('query-interaction-types/destroy', 'QueryInteractionTypeController@massDestroy')->name('query-interaction-types.massDestroy');
    Route::resource('query-interaction-types', 'QueryInteractionTypeController');

    // Batches
    Route::delete('batches/destroy', 'BatchesController@massDestroy')->name('batches.massDestroy');
    Route::post('batches/media', 'BatchesController@storeMedia')->name('batches.storeMedia');
    Route::post('batches/ckmedia', 'BatchesController@storeCKEditorImages')->name('batches.storeCKEditorImages');
    Route::post('batches/parse-csv-import', 'BatchesController@parseCsvImport')->name('batches.parseCsvImport');
    Route::post('batches/process-csv-import', 'BatchesController@processCsvImport')->name('batches.processCsvImport');
    Route::resource('batches', 'BatchesController');

    // Students
    Route::delete('students/destroy', 'StudentsController@massDestroy')->name('students.massDestroy');
    Route::post('students/media', 'StudentsController@storeMedia')->name('students.storeMedia');
    Route::post('students/ckmedia', 'StudentsController@storeCKEditorImages')->name('students.storeCKEditorImages');
    Route::post('students/parse-csv-import', 'StudentsController@parseCsvImport')->name('students.parseCsvImport');
    Route::post('students/process-csv-import', 'StudentsController@processCsvImport')->name('students.processCsvImport');
    Route::resource('students', 'StudentsController');

    // Batch Students
    Route::delete('batch-students/destroy', 'BatchStudentsController@massDestroy')->name('batch-students.massDestroy');
    Route::post('batch-students/parse-csv-import', 'BatchStudentsController@parseCsvImport')->name('batch-students.parseCsvImport');
    Route::post('batch-students/process-csv-import', 'BatchStudentsController@processCsvImport')->name('batch-students.processCsvImport');
    Route::resource('batch-students', 'BatchStudentsController');

    Route::get('batch-wise-students/{batch}','BatchStudentsController@batch')->name('batch-wise-students');




    // Student Statuses
    Route::delete('student-statuses/destroy', 'StudentStatusController@massDestroy')->name('student-statuses.massDestroy');
    Route::resource('student-statuses', 'StudentStatusController');

    // Batch Attendances
    Route::delete('batch-attendances/destroy', 'BatchAttendanceController@massDestroy')->name('batch-attendances.massDestroy');
    Route::resource('batch-attendances', 'BatchAttendanceController');

    // Employees
    Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/media', 'EmployeesController@storeMedia')->name('employees.storeMedia');
    Route::post('employees/ckmedia', 'EmployeesController@storeCKEditorImages')->name('employees.storeCKEditorImages');
    Route::resource('employees', 'EmployeesController');

    // Staff Attendances
    Route::delete('staff-attendances/destroy', 'StaffAttendanceController@massDestroy')->name('staff-attendances.massDestroy');
    Route::resource('staff-attendances', 'StaffAttendanceController');

    // Student Tasks
    Route::delete('student-tasks/destroy', 'StudentTaskController@massDestroy')->name('student-tasks.massDestroy');
    Route::post('student-tasks/media', 'StudentTaskController@storeMedia')->name('student-tasks.storeMedia');
    Route::post('student-tasks/ckmedia', 'StudentTaskController@storeCKEditorImages')->name('student-tasks.storeCKEditorImages');
    Route::resource('student-tasks', 'StudentTaskController');

    // Course Materials
    Route::delete('course-materials/destroy', 'CourseMaterialController@massDestroy')->name('course-materials.massDestroy');
    Route::post('course-materials/media', 'CourseMaterialController@storeMedia')->name('course-materials.storeMedia');
    Route::post('course-materials/ckmedia', 'CourseMaterialController@storeCKEditorImages')->name('course-materials.storeCKEditorImages');
    Route::resource('course-materials', 'CourseMaterialController');

    // Course Videos
    Route::delete('course-videos/destroy', 'CourseVideoController@massDestroy')->name('course-videos.massDestroy');
    Route::post('course-videos/media', 'CourseVideoController@storeMedia')->name('course-videos.storeMedia');
    Route::post('course-videos/ckmedia', 'CourseVideoController@storeCKEditorImages')->name('course-videos.storeCKEditorImages');
    Route::resource('course-videos', 'CourseVideoController');

    // Tests
    Route::delete('tests/destroy', 'TestsController@massDestroy')->name('tests.massDestroy');
    Route::resource('tests', 'TestsController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::post('questions/media', 'QuestionsController@storeMedia')->name('questions.storeMedia');
    Route::post('questions/ckmedia', 'QuestionsController@storeCKEditorImages')->name('questions.storeCKEditorImages');
    Route::resource('questions', 'QuestionsController');

    // Question Options
    Route::delete('question-options/destroy', 'QuestionOptionsController@massDestroy')->name('question-options.massDestroy');
    Route::resource('question-options', 'QuestionOptionsController');

    // Recoveries
    Route::delete('recoveries/destroy', 'RecoveriesController@massDestroy')->name('recoveries.massDestroy');
    Route::resource('recoveries', 'RecoveriesController');

    // Payment Types
    Route::delete('payment-types/destroy', 'PaymentTypesController@massDestroy')->name('payment-types.massDestroy');
    Route::resource('payment-types', 'PaymentTypesController');

    // Batch Notifications
    Route::delete('batch-notifications/destroy', 'BatchNotificationsController@massDestroy')->name('batch-notifications.massDestroy');
    Route::resource('batch-notifications', 'BatchNotificationsController');

    // Settings
    Route::delete('settings/destroy', 'SettingsController@massDestroy')->name('settings.massDestroy');
    Route::resource('settings', 'SettingsController');

    // Staff Notifications
    Route::delete('staff-notifications/destroy', 'StaffNotificationController@massDestroy')->name('staff-notifications.massDestroy');
    Route::resource('staff-notifications', 'StaffNotificationController');

    // Daily Lesson Planners
    Route::delete('daily-lesson-planners/destroy', 'DailyLessonPlannerController@massDestroy')->name('daily-lesson-planners.massDestroy');
    Route::post('daily-lesson-planners/media', 'DailyLessonPlannerController@storeMedia')->name('daily-lesson-planners.storeMedia');
    Route::post('daily-lesson-planners/ckmedia', 'DailyLessonPlannerController@storeCKEditorImages')->name('daily-lesson-planners.storeCKEditorImages');
    Route::resource('daily-lesson-planners', 'DailyLessonPlannerController');

    // Test Results
    Route::delete('test-results/destroy', 'TestResultsController@massDestroy')->name('test-results.massDestroy');
    Route::resource('test-results', 'TestResultsController');

    // Test Answers
    Route::delete('test-answers/destroy', 'TestAnswersController@massDestroy')->name('test-answers.massDestroy');
    Route::resource('test-answers', 'TestAnswersController');

    // Certificates
    Route::delete('certificates/destroy', 'CertificateController@massDestroy')->name('certificates.massDestroy');
    Route::resource('certificates', 'CertificateController');

    // Sms Templates
    Route::delete('sms-templates/destroy', 'SmsTemplatesController@massDestroy')->name('sms-templates.massDestroy');
    Route::resource('sms-templates', 'SmsTemplatesController');

    // Email Templates
    Route::delete('email-templates/destroy', 'EmailTemplatesController@massDestroy')->name('email-templates.massDestroy');
    Route::post('email-templates/media', 'EmailTemplatesController@storeMedia')->name('email-templates.storeMedia');
    Route::post('email-templates/ckmedia', 'EmailTemplatesController@storeCKEditorImages')->name('email-templates.storeCKEditorImages');
    Route::resource('email-templates', 'EmailTemplatesController');

    // Institution Calendars
    Route::delete('institution-calendars/destroy', 'InstitutionCalendarController@massDestroy')->name('institution-calendars.massDestroy');
    Route::resource('institution-calendars', 'InstitutionCalendarController');

    // Marketing Ads
    Route::delete('marketing-ads/destroy', 'MarketingAdsController@massDestroy')->name('marketing-ads.massDestroy');
    Route::post('marketing-ads/media', 'MarketingAdsController@storeMedia')->name('marketing-ads.storeMedia');
    Route::post('marketing-ads/ckmedia', 'MarketingAdsController@storeCKEditorImages')->name('marketing-ads.storeCKEditorImages');
    Route::resource('marketing-ads', 'MarketingAdsController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
    Route::get('user-alerts/read', 'UserAlertsController@read');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth','student']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Asset Categories
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Locations
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Statuses
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Assets
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets Histories
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Task Statuses
//    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
//    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tags
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Tasks
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendars
//    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Expense Categories
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Categories
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expenses
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Incomes
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Queries
    Route::delete('queries/destroy', 'QueriesController@massDestroy')->name('queries.massDestroy');
    Route::resource('queries', 'QueriesController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::resource('courses', 'CoursesController');

    // Course Durations
    Route::delete('course-durations/destroy', 'CourseDurationController@massDestroy')->name('course-durations.massDestroy');
    Route::resource('course-durations', 'CourseDurationController');

    // Query Statuses
    Route::delete('query-statuses/destroy', 'QueryStatusController@massDestroy')->name('query-statuses.massDestroy');
    Route::resource('query-statuses', 'QueryStatusController');

    // Query Interaction Types
    Route::delete('query-interaction-types/destroy', 'QueryInteractionTypeController@massDestroy')->name('query-interaction-types.massDestroy');
    Route::resource('query-interaction-types', 'QueryInteractionTypeController');

    // Batches
    Route::delete('batches/destroy', 'BatchesController@massDestroy')->name('batches.massDestroy');
    Route::post('batches/media', 'BatchesController@storeMedia')->name('batches.storeMedia');
    Route::post('batches/ckmedia', 'BatchesController@storeCKEditorImages')->name('batches.storeCKEditorImages');
    Route::resource('batches', 'BatchesController');

    // Students
    Route::delete('students/destroy', 'StudentsController@massDestroy')->name('students.massDestroy');
    Route::post('students/media', 'StudentsController@storeMedia')->name('students.storeMedia');
    Route::post('students/ckmedia', 'StudentsController@storeCKEditorImages')->name('students.storeCKEditorImages');
    Route::resource('students', 'StudentsController');

    // Batch Students
    Route::delete('batch-students/destroy', 'BatchStudentsController@massDestroy')->name('batch-students.massDestroy');
    Route::resource('batch-students', 'BatchStudentsController');

    // Student Statuses
    Route::delete('student-statuses/destroy', 'StudentStatusController@massDestroy')->name('student-statuses.massDestroy');
    Route::resource('student-statuses', 'StudentStatusController');

    // Batch Attendances
    Route::delete('batch-attendances/destroy', 'BatchAttendanceController@massDestroy')->name('batch-attendances.massDestroy');
    Route::resource('batch-attendances', 'BatchAttendanceController');

    // Employees
    Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/media', 'EmployeesController@storeMedia')->name('employees.storeMedia');
    Route::post('employees/ckmedia', 'EmployeesController@storeCKEditorImages')->name('employees.storeCKEditorImages');
    Route::resource('employees', 'EmployeesController');

    // Staff Attendances
    Route::delete('staff-attendances/destroy', 'StaffAttendanceController@massDestroy')->name('staff-attendances.massDestroy');
    Route::resource('staff-attendances', 'StaffAttendanceController');

    // Student Tasks
    Route::delete('student-tasks/destroy', 'StudentTaskController@massDestroy')->name('student-tasks.massDestroy');
    Route::post('student-tasks/media', 'StudentTaskController@storeMedia')->name('student-tasks.storeMedia');
    Route::post('student-tasks/ckmedia', 'StudentTaskController@storeCKEditorImages')->name('student-tasks.storeCKEditorImages');
    Route::resource('student-tasks', 'StudentTaskController');

    // Course Materials
    Route::delete('course-materials/destroy', 'CourseMaterialController@massDestroy')->name('course-materials.massDestroy');
    Route::post('course-materials/media', 'CourseMaterialController@storeMedia')->name('course-materials.storeMedia');
    Route::post('course-materials/ckmedia', 'CourseMaterialController@storeCKEditorImages')->name('course-materials.storeCKEditorImages');
    Route::resource('course-materials', 'CourseMaterialController');

    // Course Videos
    Route::delete('course-videos/destroy', 'CourseVideoController@massDestroy')->name('course-videos.massDestroy');
    Route::post('course-videos/media', 'CourseVideoController@storeMedia')->name('course-videos.storeMedia');
    Route::post('course-videos/ckmedia', 'CourseVideoController@storeCKEditorImages')->name('course-videos.storeCKEditorImages');
    Route::resource('course-videos', 'CourseVideoController');

    // Tests
    Route::delete('tests/destroy', 'TestsController@massDestroy')->name('tests.massDestroy');
    Route::resource('tests', 'TestsController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::post('questions/media', 'QuestionsController@storeMedia')->name('questions.storeMedia');
    Route::post('questions/ckmedia', 'QuestionsController@storeCKEditorImages')->name('questions.storeCKEditorImages');
    Route::resource('questions', 'QuestionsController');

    // Question Options
    Route::delete('question-options/destroy', 'QuestionOptionsController@massDestroy')->name('question-options.massDestroy');
    Route::resource('question-options', 'QuestionOptionsController');

    // Recoveries
    Route::delete('recoveries/destroy', 'RecoveriesController@massDestroy')->name('recoveries.massDestroy');
    Route::resource('recoveries', 'RecoveriesController');

    // Payment Types
    Route::delete('payment-types/destroy', 'PaymentTypesController@massDestroy')->name('payment-types.massDestroy');
    Route::resource('payment-types', 'PaymentTypesController');

    // Batch Notifications
    Route::delete('batch-notifications/destroy', 'BatchNotificationsController@massDestroy')->name('batch-notifications.massDestroy');
    Route::resource('batch-notifications', 'BatchNotificationsController');

    // Settings
    Route::delete('settings/destroy', 'SettingsController@massDestroy')->name('settings.massDestroy');
    Route::resource('settings', 'SettingsController');

    // Staff Notifications
    Route::delete('staff-notifications/destroy', 'StaffNotificationController@massDestroy')->name('staff-notifications.massDestroy');
    Route::resource('staff-notifications', 'StaffNotificationController');

    // Daily Lesson Planners
    Route::delete('daily-lesson-planners/destroy', 'DailyLessonPlannerController@massDestroy')->name('daily-lesson-planners.massDestroy');
    Route::post('daily-lesson-planners/media', 'DailyLessonPlannerController@storeMedia')->name('daily-lesson-planners.storeMedia');
    Route::post('daily-lesson-planners/ckmedia', 'DailyLessonPlannerController@storeCKEditorImages')->name('daily-lesson-planners.storeCKEditorImages');
    Route::resource('daily-lesson-planners', 'DailyLessonPlannerController');

    // Test Results
    Route::delete('test-results/destroy', 'TestResultsController@massDestroy')->name('test-results.massDestroy');
    Route::resource('test-results', 'TestResultsController');

    // Test Answers
    Route::delete('test-answers/destroy', 'TestAnswersController@massDestroy')->name('test-answers.massDestroy');
    Route::resource('test-answers', 'TestAnswersController');

    // Certificates
    Route::delete('certificates/destroy', 'CertificateController@massDestroy')->name('certificates.massDestroy');
    Route::resource('certificates', 'CertificateController');

    // Sms Templates
    Route::delete('sms-templates/destroy', 'SmsTemplatesController@massDestroy')->name('sms-templates.massDestroy');
    Route::resource('sms-templates', 'SmsTemplatesController');

    // Email Templates
    Route::delete('email-templates/destroy', 'EmailTemplatesController@massDestroy')->name('email-templates.massDestroy');
    Route::post('email-templates/media', 'EmailTemplatesController@storeMedia')->name('email-templates.storeMedia');
    Route::post('email-templates/ckmedia', 'EmailTemplatesController@storeCKEditorImages')->name('email-templates.storeCKEditorImages');
    Route::resource('email-templates', 'EmailTemplatesController');

    // Institution Calendars
    Route::delete('institution-calendars/destroy', 'InstitutionCalendarController@massDestroy')->name('institution-calendars.massDestroy');
    Route::resource('institution-calendars', 'InstitutionCalendarController');

    // Marketing Ads
    Route::delete('marketing-ads/destroy', 'MarketingAdsController@massDestroy')->name('marketing-ads.massDestroy');
    Route::post('marketing-ads/media', 'MarketingAdsController@storeMedia')->name('marketing-ads.storeMedia');
    Route::post('marketing-ads/ckmedia', 'MarketingAdsController@storeCKEditorImages')->name('marketing-ads.storeCKEditorImages');
    Route::resource('marketing-ads', 'MarketingAdsController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
