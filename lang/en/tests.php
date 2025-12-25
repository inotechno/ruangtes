<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Tests Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for test management and taking.
    |
    */

    'title' => 'Tests',
    'create_test' => 'Create Test',
    'edit_test' => 'Edit Test',
    'view_test' => 'View Test',
    'delete_test' => 'Delete Test',
    'test_details' => 'Test Details',
    'test_settings' => 'Test Settings',
    'test_results' => 'Test Results',

    // Test properties
    'name' => 'Test Name',
    'code' => 'Test Code',
    'description' => 'Description',
    'short_description' => 'Short Description',
    'category' => 'Category',
    'type' => 'Type',
    'price' => 'Price',
    'duration' => 'Duration',
    'questions' => 'Questions',
    'passing_score' => 'Passing Score',
    'max_attempts' => 'Max Attempts',
    'instructions' => 'Instructions',

    // Test types
    'types' => [
        'public' => 'Public',
        'company' => 'Company',
        'all' => 'All Users',
    ],

    // Test statuses
    'status' => [
        'draft' => 'Draft',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'archived' => 'Archived',
    ],

    // Test taking
    'start_test' => 'Start Test',
    'resume_test' => 'Resume Test',
    'submit_test' => 'Submit Test',
    'test_completed' => 'Test Completed',
    'test_expired' => 'Test Expired',
    'time_remaining' => 'Time Remaining',
    'questions_remaining' => 'Questions Remaining',

    // Test validation
    'test_not_found' => 'Test not found',
    'test_not_available' => 'Test is not available',
    'test_expired' => 'Test has expired',
    'max_attempts_reached' => 'Maximum attempts reached',
    'profile_required' => 'Profile completion required',
    'payment_required' => 'Payment required',

    // Test results
    'score' => 'Score',
    'percentage' => 'Percentage',
    'percentile' => 'Percentile',
    'interpretation' => 'Interpretation',
    'recommendations' => 'Recommendations',
    'certificate' => 'Certificate',
    'download_certificate' => 'Download Certificate',
    'view_results' => 'View Results',
    'share_results' => 'Share Results',

    // Test categories
    'categories' => 'Categories',
    'create_category' => 'Create Category',
    'edit_category' => 'Edit Category',
    'category_name' => 'Category Name',
    'category_description' => 'Category Description',

    // Test management
    'publish_test' => 'Publish Test',
    'unpublish_test' => 'Unpublish Test',
    'duplicate_test' => 'Duplicate Test',
    'preview_test' => 'Preview Test',
    'test_statistics' => 'Test Statistics',
    'total_attempts' => 'Total Attempts',
    'average_score' => 'Average Score',
    'completion_rate' => 'Completion Rate',

    // Test taking interface
    'question' => 'Question',
    'previous_question' => 'Previous Question',
    'next_question' => 'Next Question',
    'mark_for_review' => 'Mark for Review',
    'clear_answer' => 'Clear Answer',
    'time_up' => 'Time is up!',
    'auto_submit_warning' => 'Test will be auto-submitted in :seconds seconds',

    // Test security
    'security_warning' => 'Security Warning',
    'tab_change_detected' => 'Tab change detected',
    'copy_paste_detected' => 'Copy/paste detected',
    'right_click_detected' => 'Right click detected',
    'fullscreen_required' => 'Fullscreen mode required',
    'camera_required' => 'Camera access required',
    'microphone_required' => 'Microphone access required',

    // Test handlers
    'handlers' => [
        'disc' => 'DISC Personality Test',
        'iq' => 'IQ Test',
        'mbti' => 'MBTI Personality Test',
        'tpa' => 'TPA Test',
        'custom' => 'Custom Test',
    ],

    // Test configuration
    'randomize_questions' => 'Randomize Questions',
    'show_results_immediately' => 'Show Results Immediately',
    'allow_retake' => 'Allow Retake',
    'require_fullscreen' => 'Require Fullscreen',
    'enable_camera' => 'Enable Camera Monitoring',
    'enable_screen_capture' => 'Enable Screen Capture',

    // Test analytics
    'analytics' => 'Analytics',
    'performance_metrics' => 'Performance Metrics',
    'user_engagement' => 'User Engagement',
    'completion_trends' => 'Completion Trends',
    'popular_tests' => 'Popular Tests',

    // Bulk operations
    'bulk_actions' => 'Bulk Actions',
    'bulk_publish' => 'Bulk Publish',
    'bulk_unpublish' => 'Bulk Unpublish',
    'bulk_delete' => 'Bulk Delete',
    'bulk_export' => 'Bulk Export',

    // Test import/export
    'import_tests' => 'Import Tests',
    'export_tests' => 'Export Tests',
    'import_success' => 'Tests imported successfully',
    'import_failed' => 'Tests import failed',
    'export_success' => 'Tests exported successfully',

    // Test notifications
    'test_published' => 'Test published successfully',
    'test_unpublished' => 'Test unpublished successfully',
    'test_created' => 'Test created successfully',
    'test_updated' => 'Test updated successfully',
    'test_deleted' => 'Test deleted successfully',

    // Test taking flow
    'welcome_message' => 'Welcome to the test',
    'read_instructions' => 'Please read the instructions carefully',
    'begin_test' => 'Begin Test',
    'test_paused' => 'Test paused',
    'test_resumed' => 'Test resumed',
    'test_submitted' => 'Test submitted successfully',
    'test_timeout' => 'Test timed out',
];
