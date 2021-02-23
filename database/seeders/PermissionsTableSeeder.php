<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 20,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 21,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 22,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 23,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 24,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 25,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 26,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 27,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 28,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 29,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 30,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 31,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 32,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 33,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 34,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 35,
                'title' => 'asset_create',
            ],
            [
                'id'    => 36,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 37,
                'title' => 'asset_show',
            ],
            [
                'id'    => 38,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 39,
                'title' => 'asset_access',
            ],
            [
                'id'    => 40,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 41,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 42,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 43,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 44,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 45,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 46,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 47,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 48,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 49,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 50,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 51,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 52,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 53,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 54,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 55,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 56,
                'title' => 'task_create',
            ],
            [
                'id'    => 57,
                'title' => 'task_edit',
            ],
            [
                'id'    => 58,
                'title' => 'task_show',
            ],
            [
                'id'    => 59,
                'title' => 'task_delete',
            ],
            [
                'id'    => 60,
                'title' => 'task_access',
            ],
            [
                'id'    => 61,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 62,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 63,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 64,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 65,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 66,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 67,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 68,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 69,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 70,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 71,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 72,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 73,
                'title' => 'expense_create',
            ],
            [
                'id'    => 74,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 75,
                'title' => 'expense_show',
            ],
            [
                'id'    => 76,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 77,
                'title' => 'expense_access',
            ],
            [
                'id'    => 78,
                'title' => 'income_create',
            ],
            [
                'id'    => 79,
                'title' => 'income_edit',
            ],
            [
                'id'    => 80,
                'title' => 'income_show',
            ],
            [
                'id'    => 81,
                'title' => 'income_delete',
            ],
            [
                'id'    => 82,
                'title' => 'income_access',
            ],
            [
                'id'    => 83,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 84,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 85,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 86,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 87,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 88,
                'title' => 'query_create',
            ],
            [
                'id'    => 89,
                'title' => 'query_edit',
            ],
            [
                'id'    => 90,
                'title' => 'query_show',
            ],
            [
                'id'    => 91,
                'title' => 'query_delete',
            ],
            [
                'id'    => 92,
                'title' => 'query_access',
            ],
            [
                'id'    => 93,
                'title' => 'course_create',
            ],
            [
                'id'    => 94,
                'title' => 'course_edit',
            ],
            [
                'id'    => 95,
                'title' => 'course_show',
            ],
            [
                'id'    => 96,
                'title' => 'course_delete',
            ],
            [
                'id'    => 97,
                'title' => 'course_access',
            ],
            [
                'id'    => 98,
                'title' => 'course_duration_create',
            ],
            [
                'id'    => 99,
                'title' => 'course_duration_edit',
            ],
            [
                'id'    => 100,
                'title' => 'course_duration_show',
            ],
            [
                'id'    => 101,
                'title' => 'course_duration_delete',
            ],
            [
                'id'    => 102,
                'title' => 'course_duration_access',
            ],
            [
                'id'    => 103,
                'title' => 'academic_access',
            ],
            [
                'id'    => 104,
                'title' => 'query_status_create',
            ],
            [
                'id'    => 105,
                'title' => 'query_status_edit',
            ],
            [
                'id'    => 106,
                'title' => 'query_status_show',
            ],
            [
                'id'    => 107,
                'title' => 'query_status_delete',
            ],
            [
                'id'    => 108,
                'title' => 'query_status_access',
            ],
            [
                'id'    => 109,
                'title' => 'query_management_access',
            ],
            [
                'id'    => 110,
                'title' => 'query_interaction_type_create',
            ],
            [
                'id'    => 111,
                'title' => 'query_interaction_type_edit',
            ],
            [
                'id'    => 112,
                'title' => 'query_interaction_type_show',
            ],
            [
                'id'    => 113,
                'title' => 'query_interaction_type_delete',
            ],
            [
                'id'    => 114,
                'title' => 'query_interaction_type_access',
            ],
            [
                'id'    => 115,
                'title' => 'batch_create',
            ],
            [
                'id'    => 116,
                'title' => 'batch_edit',
            ],
            [
                'id'    => 117,
                'title' => 'batch_show',
            ],
            [
                'id'    => 118,
                'title' => 'batch_delete',
            ],
            [
                'id'    => 119,
                'title' => 'batch_access',
            ],
            [
                'id'    => 120,
                'title' => 'students_management_access',
            ],
            [
                'id'    => 121,
                'title' => 'student_create',
            ],
            [
                'id'    => 122,
                'title' => 'student_edit',
            ],
            [
                'id'    => 123,
                'title' => 'student_show',
            ],
            [
                'id'    => 124,
                'title' => 'student_delete',
            ],
            [
                'id'    => 125,
                'title' => 'student_access',
            ],
            [
                'id'    => 126,
                'title' => 'batch_student_create',
            ],
            [
                'id'    => 127,
                'title' => 'batch_student_edit',
            ],
            [
                'id'    => 128,
                'title' => 'batch_student_show',
            ],
            [
                'id'    => 129,
                'title' => 'batch_student_delete',
            ],
            [
                'id'    => 130,
                'title' => 'batch_student_access',
            ],
            [
                'id'    => 131,
                'title' => 'student_status_create',
            ],
            [
                'id'    => 132,
                'title' => 'student_status_edit',
            ],
            [
                'id'    => 133,
                'title' => 'student_status_show',
            ],
            [
                'id'    => 134,
                'title' => 'student_status_delete',
            ],
            [
                'id'    => 135,
                'title' => 'student_status_access',
            ],
            [
                'id'    => 136,
                'title' => 'batch_attendance_create',
            ],
            [
                'id'    => 137,
                'title' => 'batch_attendance_edit',
            ],
            [
                'id'    => 138,
                'title' => 'batch_attendance_show',
            ],
            [
                'id'    => 139,
                'title' => 'batch_attendance_delete',
            ],
            [
                'id'    => 140,
                'title' => 'batch_attendance_access',
            ],
            [
                'id'    => 141,
                'title' => 'staff_managment_access',
            ],
            [
                'id'    => 142,
                'title' => 'employee_create',
            ],
            [
                'id'    => 143,
                'title' => 'employee_edit',
            ],
            [
                'id'    => 144,
                'title' => 'employee_show',
            ],
            [
                'id'    => 145,
                'title' => 'employee_delete',
            ],
            [
                'id'    => 146,
                'title' => 'employee_access',
            ],
            [
                'id'    => 147,
                'title' => 'staff_attendance_create',
            ],
            [
                'id'    => 148,
                'title' => 'staff_attendance_edit',
            ],
            [
                'id'    => 149,
                'title' => 'staff_attendance_show',
            ],
            [
                'id'    => 150,
                'title' => 'staff_attendance_delete',
            ],
            [
                'id'    => 151,
                'title' => 'staff_attendance_access',
            ],
            [
                'id'    => 152,
                'title' => 'student_task_create',
            ],
            [
                'id'    => 153,
                'title' => 'student_task_edit',
            ],
            [
                'id'    => 154,
                'title' => 'student_task_show',
            ],
            [
                'id'    => 155,
                'title' => 'student_task_delete',
            ],
            [
                'id'    => 156,
                'title' => 'student_task_access',
            ],
            [
                'id'    => 157,
                'title' => 'study_material_access',
            ],
            [
                'id'    => 158,
                'title' => 'course_material_create',
            ],
            [
                'id'    => 159,
                'title' => 'course_material_edit',
            ],
            [
                'id'    => 160,
                'title' => 'course_material_show',
            ],
            [
                'id'    => 161,
                'title' => 'course_material_delete',
            ],
            [
                'id'    => 162,
                'title' => 'course_material_access',
            ],
            [
                'id'    => 163,
                'title' => 'course_video_create',
            ],
            [
                'id'    => 164,
                'title' => 'course_video_edit',
            ],
            [
                'id'    => 165,
                'title' => 'course_video_show',
            ],
            [
                'id'    => 166,
                'title' => 'course_video_delete',
            ],
            [
                'id'    => 167,
                'title' => 'course_video_access',
            ],
            [
                'id'    => 168,
                'title' => 'examination_managment_access',
            ],
            [
                'id'    => 169,
                'title' => 'test_create',
            ],
            [
                'id'    => 170,
                'title' => 'test_edit',
            ],
            [
                'id'    => 171,
                'title' => 'test_show',
            ],
            [
                'id'    => 172,
                'title' => 'test_delete',
            ],
            [
                'id'    => 173,
                'title' => 'test_access',
            ],
            [
                'id'    => 174,
                'title' => 'question_create',
            ],
            [
                'id'    => 175,
                'title' => 'question_edit',
            ],
            [
                'id'    => 176,
                'title' => 'question_show',
            ],
            [
                'id'    => 177,
                'title' => 'question_delete',
            ],
            [
                'id'    => 178,
                'title' => 'question_access',
            ],
            [
                'id'    => 179,
                'title' => 'question_option_create',
            ],
            [
                'id'    => 180,
                'title' => 'question_option_edit',
            ],
            [
                'id'    => 181,
                'title' => 'question_option_show',
            ],
            [
                'id'    => 182,
                'title' => 'question_option_delete',
            ],
            [
                'id'    => 183,
                'title' => 'question_option_access',
            ],
            [
                'id'    => 184,
                'title' => 'notification_access',
            ],
            [
                'id'    => 185,
                'title' => 'recovery_create',
            ],
            [
                'id'    => 186,
                'title' => 'recovery_edit',
            ],
            [
                'id'    => 187,
                'title' => 'recovery_show',
            ],
            [
                'id'    => 188,
                'title' => 'recovery_delete',
            ],
            [
                'id'    => 189,
                'title' => 'recovery_access',
            ],
            [
                'id'    => 190,
                'title' => 'payment_type_create',
            ],
            [
                'id'    => 191,
                'title' => 'payment_type_edit',
            ],
            [
                'id'    => 192,
                'title' => 'payment_type_show',
            ],
            [
                'id'    => 193,
                'title' => 'payment_type_delete',
            ],
            [
                'id'    => 194,
                'title' => 'payment_type_access',
            ],
            [
                'id'    => 195,
                'title' => 'batch_notification_create',
            ],
            [
                'id'    => 196,
                'title' => 'batch_notification_edit',
            ],
            [
                'id'    => 197,
                'title' => 'batch_notification_show',
            ],
            [
                'id'    => 198,
                'title' => 'batch_notification_delete',
            ],
            [
                'id'    => 199,
                'title' => 'batch_notification_access',
            ],
            [
                'id'    => 200,
                'title' => 'setting_create',
            ],
            [
                'id'    => 201,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 202,
                'title' => 'setting_show',
            ],
            [
                'id'    => 203,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 204,
                'title' => 'setting_access',
            ],
            [
                'id'    => 205,
                'title' => 'staff_notification_create',
            ],
            [
                'id'    => 206,
                'title' => 'staff_notification_edit',
            ],
            [
                'id'    => 207,
                'title' => 'staff_notification_show',
            ],
            [
                'id'    => 208,
                'title' => 'staff_notification_delete',
            ],
            [
                'id'    => 209,
                'title' => 'staff_notification_access',
            ],
            [
                'id'    => 210,
                'title' => 'daily_lesson_planner_create',
            ],
            [
                'id'    => 211,
                'title' => 'daily_lesson_planner_edit',
            ],
            [
                'id'    => 212,
                'title' => 'daily_lesson_planner_show',
            ],
            [
                'id'    => 213,
                'title' => 'daily_lesson_planner_delete',
            ],
            [
                'id'    => 214,
                'title' => 'daily_lesson_planner_access',
            ],
            [
                'id'    => 215,
                'title' => 'test_result_create',
            ],
            [
                'id'    => 216,
                'title' => 'test_result_edit',
            ],
            [
                'id'    => 217,
                'title' => 'test_result_show',
            ],
            [
                'id'    => 218,
                'title' => 'test_result_delete',
            ],
            [
                'id'    => 219,
                'title' => 'test_result_access',
            ],
            [
                'id'    => 220,
                'title' => 'test_answer_create',
            ],
            [
                'id'    => 221,
                'title' => 'test_answer_edit',
            ],
            [
                'id'    => 222,
                'title' => 'test_answer_show',
            ],
            [
                'id'    => 223,
                'title' => 'test_answer_delete',
            ],
            [
                'id'    => 224,
                'title' => 'test_answer_access',
            ],
            [
                'id'    => 225,
                'title' => 'certificate_create',
            ],
            [
                'id'    => 226,
                'title' => 'certificate_edit',
            ],
            [
                'id'    => 227,
                'title' => 'certificate_show',
            ],
            [
                'id'    => 228,
                'title' => 'certificate_delete',
            ],
            [
                'id'    => 229,
                'title' => 'certificate_access',
            ],
            [
                'id'    => 230,
                'title' => 'sms_template_create',
            ],
            [
                'id'    => 231,
                'title' => 'sms_template_edit',
            ],
            [
                'id'    => 232,
                'title' => 'sms_template_show',
            ],
            [
                'id'    => 233,
                'title' => 'sms_template_delete',
            ],
            [
                'id'    => 234,
                'title' => 'sms_template_access',
            ],
            [
                'id'    => 235,
                'title' => 'email_template_create',
            ],
            [
                'id'    => 236,
                'title' => 'email_template_edit',
            ],
            [
                'id'    => 237,
                'title' => 'email_template_show',
            ],
            [
                'id'    => 238,
                'title' => 'email_template_delete',
            ],
            [
                'id'    => 239,
                'title' => 'email_template_access',
            ],
            [
                'id'    => 240,
                'title' => 'institution_calendar_create',
            ],
            [
                'id'    => 241,
                'title' => 'institution_calendar_edit',
            ],
            [
                'id'    => 242,
                'title' => 'institution_calendar_show',
            ],
            [
                'id'    => 243,
                'title' => 'institution_calendar_delete',
            ],
            [
                'id'    => 244,
                'title' => 'institution_calendar_access',
            ],
            [
                'id'    => 245,
                'title' => 'marketing_ad_create',
            ],
            [
                'id'    => 246,
                'title' => 'marketing_ad_edit',
            ],
            [
                'id'    => 247,
                'title' => 'marketing_ad_show',
            ],
            [
                'id'    => 248,
                'title' => 'marketing_ad_delete',
            ],
            [
                'id'    => 249,
                'title' => 'marketing_ad_access',
            ],
            [
                'id'    => 250,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
