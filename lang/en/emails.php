<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Email Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for email content and subjects.
    |
    */

    'verification' => [
        'subject' => 'Verify Your Email Address - RuangTes',
        'greeting' => 'Hello :name!',
        'line_1' => 'Please click the button below to verify your email address.',
        'action' => 'Verify Email Address',
        'line_2' => 'If you did not create an account, no further action is required.',
        'line_3' => 'This verification link will expire in :count minutes.',
        'salutation' => 'Regards,',
        'subcopy' => 'If you\'re having trouble clicking the ":actionText" button, copy and paste the URL below into your web browser:',
    ],

    'password_reset' => [
        'subject' => 'Reset Your Password - RuangTes',
        'greeting' => 'Hello :name!',
        'line_1' => 'You are receiving this email because we received a password reset request for your account.',
        'action' => 'Reset Password',
        'line_2' => 'This password reset link will expire in :count minutes.',
        'line_3' => 'If you did not request a password reset, no further action is required.',
        'salutation' => 'Regards,',
        'subcopy' => 'If you\'re having trouble clicking the ":actionText" button, copy and paste the URL below into your web browser:',
    ],

    'welcome' => [
        'subject' => 'Welcome to RuangTes!',
        'greeting' => 'Welcome to RuangTes, :name!',
        'line_1' => 'Thank you for joining RuangTes. Your account has been successfully verified and activated.',
        'line_2' => 'You can now access all features of our platform including taking tests, managing assessments, and viewing your results.',
        'get_started' => 'Get Started',
        'features' => [
            'title' => 'What you can do:',
            'take_tests' => 'Take various psychological and skill tests',
            'view_results' => 'View detailed test results and interpretations',
            'manage_profile' => 'Manage your profile and test history',
            'get_certificates' => 'Download certificates upon test completion',
        ],
        'support' => [
            'title' => 'Need Help?',
            'line_1' => 'If you have any questions or need assistance, don\'t hesitate to contact our support team.',
            'contact' => 'Contact Support',
        ],
        'salutation' => 'Best regards,',
        'team' => 'The RuangTes Team',
    ],

    'company_verification' => [
        'subject' => 'Company Verification Required - RuangTes',
        'greeting' => 'Hello :name!',
        'line_1' => 'Your company registration has been received and is pending verification.',
        'line_2' => 'We will review your application and get back to you within 1-2 business days.',
        'line_3' => 'Once verified, you will have access to the company dashboard where you can:',
        'features' => [
            'manage_employees' => 'Manage employee accounts and access',
            'create_tests' => 'Create and manage custom tests',
            'view_reports' => 'View detailed reports and analytics',
            'invite_participants' => 'Invite participants to take tests',
        ],
        'salutation' => 'Regards,',
    ],

    'company_approved' => [
        'subject' => 'Company Account Approved - RuangTes',
        'greeting' => 'Congratulations :name!',
        'line_1' => 'Your company account has been approved and is now active.',
        'line_2' => 'You can now access your company dashboard and start using all features.',
        'action' => 'Access Dashboard',
        'next_steps' => [
            'title' => 'Next Steps:',
            'step_1' => 'Log in to your company dashboard',
            'step_2' => 'Complete your company profile',
            'step_3' => 'Invite team members and administrators',
            'step_4' => 'Create your first test or assessment',
        ],
        'salutation' => 'Welcome aboard,',
    ],

    'participant_invitation' => [
        'subject' => 'You\'ve Been Invited to Take a Test - RuangTes',
        'greeting' => 'Hello :name!',
        'line_1' => ':company_name has invited you to participate in an assessment.',
        'line_2' => 'Please click the button below to access your test dashboard.',
        'action' => 'Access Test Dashboard',
        'test_details' => [
            'title' => 'Test Details:',
            'name' => 'Test Name: :test_name',
            'deadline' => 'Deadline: :deadline',
            'duration' => 'Duration: :duration minutes',
        ],
        'instructions' => [
            'title' => 'Instructions:',
            'line_1' => 'Make sure you have a stable internet connection',
            'line_2' => 'Find a quiet place to take the test',
            'line_3' => 'You may need to enable camera and microphone access',
            'line_4' => 'Complete the test within the given time limit',
        ],
        'salutation' => 'Best regards,',
    ],

    'test_completed' => [
        'subject' => 'Test Completed Successfully - RuangTes',
        'greeting' => 'Congratulations :name!',
        'line_1' => 'You have successfully completed the test ":test_name".',
        'line_2' => 'Your results are now available for review.',
        'action' => 'View Results',
        'results_summary' => [
            'title' => 'Results Summary:',
            'score' => 'Score: :score/:total (:percentage%)',
            'completion_time' => 'Completion Time: :time',
            'status' => 'Status: :status',
        ],
        'next_steps' => 'You can now view detailed results, download your certificate (if available), and see interpretations of your test results.',
        'salutation' => 'Well done,',
    ],

    'test_reminder' => [
        'subject' => 'Test Reminder - RuangTes',
        'greeting' => 'Hello :name!',
        'line_1' => 'This is a friendly reminder that you have a test due soon.',
        'line_2' => 'Please make sure to complete your test before the deadline.',
        'action' => 'Take Test Now',
        'test_details' => [
            'name' => 'Test: :test_name',
            'deadline' => 'Deadline: :deadline',
            'time_remaining' => 'Time Remaining: :time',
        ],
        'salutation' => 'Regards,',
    ],

    'account_suspended' => [
        'subject' => 'Account Suspended - RuangTes',
        'greeting' => 'Hello :name!',
        'line_1' => 'Your account has been temporarily suspended.',
        'line_2' => 'Reason: :reason',
        'line_3' => 'If you believe this is an error, please contact our support team.',
        'action' => 'Contact Support',
        'salutation' => 'Regards,',
    ],

    'account_reactivated' => [
        'subject' => 'Account Reactivated - RuangTes',
        'greeting' => 'Hello :name!',
        'line_1' => 'Your account has been reactivated and you can now access all features.',
        'line_2' => 'If you have any questions, please don\'t hesitate to contact us.',
        'action' => 'Access Dashboard',
        'salutation' => 'Welcome back,',
    ],
];
