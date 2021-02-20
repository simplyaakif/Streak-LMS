<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('query_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/queries*") ? "c-show" : "" }} {{ request()->is("admin/query-statuses*") ? "c-show" : "" }} {{ request()->is("admin/query-interaction-types*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-address-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.queryManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('query_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.queries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/queries") || request()->is("admin/queries/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.query.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('query_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.query-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/query-statuses") || request()->is("admin/query-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-check c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.queryStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('query_interaction_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.query-interaction-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/query-interaction-types") || request()->is("admin/query-interaction-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-exchange-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.queryInteractionType.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('students_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/students*") ? "c-show" : "" }} {{ request()->is("admin/batch-students*") ? "c-show" : "" }} {{ request()->is("admin/student-statuses*") ? "c-show" : "" }} {{ request()->is("admin/batch-attendances*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-graduate c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.studentsManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.students.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/students") || request()->is("admin/students/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-graduation-cap c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.student.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('batch_student_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.batch-students.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/batch-students") || request()->is("admin/batch-students/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.batchStudent.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('student_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/student-statuses") || request()->is("admin/student-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-asterisk c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.studentStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('batch_attendance_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.batch-attendances.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/batch-attendances") || request()->is("admin/batch-attendances/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hand-paper c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.batchAttendance.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('study_material_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/student-tasks*") ? "c-show" : "" }} {{ request()->is("admin/course-materials*") ? "c-show" : "" }} {{ request()->is("admin/course-videos*") ? "c-show" : "" }} {{ request()->is("admin/daily-lesson-planners*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.studyMaterial.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('student_task_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.student-tasks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/student-tasks") || request()->is("admin/student-tasks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.studentTask.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('course_material_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.course-materials.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/course-materials") || request()->is("admin/course-materials/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-pen c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.courseMaterial.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('course_video_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.course-videos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/course-videos") || request()->is("admin/course-videos/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-video c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.courseVideo.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('daily_lesson_planner_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.daily-lesson-planners.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/daily-lesson-planners") || request()->is("admin/daily-lesson-planners/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-pencil-ruler c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.dailyLessonPlanner.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('academic_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/courses*") ? "c-show" : "" }} {{ request()->is("admin/course-durations*") ? "c-show" : "" }} {{ request()->is("admin/batches*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-align-justify c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.academic.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('course_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.courses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/courses") || request()->is("admin/courses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.course.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('course_duration_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.course-durations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/course-durations") || request()->is("admin/course-durations/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.courseDuration.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('batch_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.batches.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/batches") || request()->is("admin/batches/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.batch.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('staff_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/employees*") ? "c-show" : "" }} {{ request()->is("admin/staff-attendances*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-address-card c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.staffManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('employee_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.employees.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/employees") || request()->is("admin/employees/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-address-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.employee.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('staff_attendance_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.staff-attendances.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/staff-attendances") || request()->is("admin/staff-attendances/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hand-paper c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.staffAttendance.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('examination_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/tests*") ? "c-show" : "" }} {{ request()->is("admin/questions*") ? "c-show" : "" }} {{ request()->is("admin/question-options*") ? "c-show" : "" }} {{ request()->is("admin/test-results*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-pen-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.examinationManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('test_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tests.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tests") || request()->is("admin/tests/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-accusoft c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.test.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/questions") || request()->is("admin/questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.question.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('question_option_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.question-options.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/question-options") || request()->is("admin/question-options/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.questionOption.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('test_result_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.test-results.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/test-results") || request()->is("admin/test-results/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-affiliatetheme c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.testResult.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('asset_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/asset-categories*") ? "c-show" : "" }} {{ request()->is("admin/asset-locations*") ? "c-show" : "" }} {{ request()->is("admin/asset-statuses*") ? "c-show" : "" }} {{ request()->is("admin/assets*") ? "c-show" : "" }} {{ request()->is("admin/assets-histories*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.assetManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('asset_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-categories") || request()->is("admin/asset-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_location_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-locations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-locations") || request()->is("admin/asset-locations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marker c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetLocation.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-statuses") || request()->is("admin/asset-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assets.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assets") || request()->is("admin/assets/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.asset.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('assets_history_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assets-histories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assets-histories") || request()->is("admin/assets-histories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-th-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetsHistory.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('notification_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/user-alerts*") ? "c-show" : "" }} {{ request()->is("admin/batch-notifications*") ? "c-show" : "" }} {{ request()->is("admin/staff-notifications*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-paper-plane c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.notification.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('user_alert_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userAlert.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('batch_notification_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.batch-notifications.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/batch-notifications") || request()->is("admin/batch-notifications/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.batchNotification.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('staff_notification_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.staff-notifications.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/staff-notifications") || request()->is("admin/staff-notifications/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-comment c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.staffNotification.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('expense_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/recoveries*") ? "c-show" : "" }} {{ request()->is("admin/incomes*") ? "c-show" : "" }} {{ request()->is("admin/expenses*") ? "c-show" : "" }} {{ request()->is("admin/expense-reports*") ? "c-show" : "" }} {{ request()->is("admin/payment-types*") ? "c-show" : "" }} {{ request()->is("admin/expense-categories*") ? "c-show" : "" }} {{ request()->is("admin/income-categories*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-money-bill c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.expenseManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('recovery_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.recoveries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/recoveries") || request()->is("admin/recoveries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-dollar-sign c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.recovery.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('income_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.incomes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/incomes") || request()->is("admin/incomes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrow-circle-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.income.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('expense_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expenses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expenses") || request()->is("admin/expenses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrow-circle-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expense.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('expense_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expense-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expense-reports") || request()->is("admin/expense-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expenseReport.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('payment_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payment-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/payment-types") || request()->is("admin/payment-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-invoice-dollar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.paymentType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('expense_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expense-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expense-categories") || request()->is("admin/expense-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expenseCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('income_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.income-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/income-categories") || request()->is("admin/income-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.incomeCategory.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('task_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/task-statuses*") ? "c-show" : "" }} {{ request()->is("admin/task-tags*") ? "c-show" : "" }} {{ request()->is("admin/tasks*") ? "c-show" : "" }} {{ request()->is("admin/tasks-calendars*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.taskManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('task_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.task.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tasks_calendar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks-calendars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tasksCalendar.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('setting_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.settings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.setting.title') }}
                </a>
            </li>
        @endcan
        @can('test_answer_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.test-answers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/test-answers") || request()->is("admin/test-answers/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.testAnswer.title') }}
                </a>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>