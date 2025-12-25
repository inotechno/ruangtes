<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Participants Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for participant management.
    |
    */

    'title' => 'Participants',
    'create_participant' => 'Create Participant',
    'edit_participant' => 'Edit Participant',
    'view_participant' => 'View Participant',
    'delete_participant' => 'Delete Participant',
    'participant_details' => 'Participant Details',
    'participant_profile' => 'Participant Profile',
    'participant_progress' => 'Participant Progress',

    // Participant properties
    'name' => 'Name',
    'email' => 'Email',
    'phone' => 'Phone',
    'employee_id' => 'Employee ID',
    'department' => 'Department',
    'position' => 'Position',
    'unique_code' => 'Unique Code',
    'date_of_birth' => 'Date of Birth',
    'gender' => 'Gender',
    'education' => 'Education',
    'profile_completed' => 'Profile Completed',
    'test_period' => 'Test Period',
    'status' => 'Status',

    // Participant statuses
    'statuses' => [
        'pending' => 'Pending',
        'active' => 'Active',
        'testing' => 'Testing',
        'completed' => 'Completed',
        'banned' => 'Banned',
        'expired' => 'Expired',
    ],

    // Participant management
    'invite_participants' => 'Invite Participants',
    'bulk_import' => 'Bulk Import',
    'send_invitations' => 'Send Invitations',
    'resend_invitation' => 'Resend Invitation',
    'view_progress' => 'View Progress',
    'assign_tests' => 'Assign Tests',
    'remove_assignments' => 'Remove Assignments',

    // Participant profile
    'complete_profile' => 'Complete Profile',
    'profile_completion_required' => 'Profile completion is required to start tests',
    'save_profile' => 'Save Profile',
    'profile_saved' => 'Profile saved successfully',

    // Test assignments
    'test_assignments' => 'Test Assignments',
    'assigned_tests' => 'Assigned Tests',
    'available_tests' => 'Available Tests',
    'completed_tests' => 'Completed Tests',
    'pending_tests' => 'Pending Tests',
    'in_progress_tests' => 'In Progress Tests',
    'test_order' => 'Test Order',
    'assignment_status' => 'Assignment Status',

    // Assignment statuses
    'assignment_statuses' => [
        'pending' => 'Pending',
        'available' => 'Available',
        'started' => 'Started',
        'completed' => 'Completed',
    ],

    // Access management
    'access_token' => 'Access Token',
    'generate_token' => 'Generate Token',
    'invalidate_token' => 'Invalidate Token',
    'token_generated' => 'Access token generated successfully',
    'token_invalidated' => 'Access token invalidated',
    'access_link' => 'Access Link',
    'direct_access' => 'Direct Access',

    // Participant validation
    'participant_not_found' => 'Participant not found',
    'invalid_access_token' => 'Invalid access token',
    'expired_access_token' => 'Access token has expired',
    'profile_incomplete' => 'Participant profile is incomplete',
    'no_assigned_tests' => 'No tests assigned to this participant',
    'test_not_available' => 'Test is not available for this participant',

    // Bulk operations
    'bulk_create' => 'Bulk Create',
    'bulk_update' => 'Bulk Update',
    'bulk_delete' => 'Bulk Delete',
    'bulk_invite' => 'Bulk Invite',
    'bulk_assign' => 'Bulk Assign',

    // Import/Export
    'import_participants' => 'Import Participants',
    'export_participants' => 'Export Participants',
    'import_template' => 'Download Import Template',
    'import_success' => 'Participants imported successfully',
    'import_failed' => 'Import failed',
    'export_success' => 'Participants exported successfully',

    // Statistics
    'total_participants' => 'Total Participants',
    'active_participants' => 'Active Participants',
    'completed_participants' => 'Completed Participants',
    'profile_completion_rate' => 'Profile Completion Rate',
    'test_completion_rate' => 'Test Completion Rate',

    // Participant actions
    'ban_participant' => 'Ban Participant',
    'unban_participant' => 'Unban Participant',
    'reset_progress' => 'Reset Progress',
    'extend_access' => 'Extend Access',
    'participant_banned' => 'Participant banned successfully',
    'participant_unbanned' => 'Participant unbanned successfully',

    // Notifications
    'invitation_sent' => 'Invitation sent successfully',
    'invitation_failed' => 'Failed to send invitation',
    'invitations_sent' => ':count invitations sent',
    'participant_created' => 'Participant created successfully',
    'participant_updated' => 'Participant updated successfully',
    'participant_deleted' => 'Participant deleted successfully',

    // Participant dashboard (for participants)
    'my_tests' => 'My Tests',
    'available_tests' => 'Available Tests',
    'test_progress' => 'Test Progress',
    'completion_percentage' => 'Completion Percentage',
    'time_remaining' => 'Time Remaining',
    'deadline' => 'Deadline',
    'start_date' => 'Start Date',
    'end_date' => 'End Date',

    // Security
    'access_logged' => 'Access attempt logged',
    'suspicious_activity' => 'Suspicious activity detected',
    'multiple_login_attempts' => 'Multiple login attempts detected',

    // Reports
    'participant_reports' => 'Participant Reports',
    'individual_report' => 'Individual Report',
    'group_report' => 'Group Report',
    'progress_report' => 'Progress Report',
    'completion_report' => 'Completion Report',

    // Search & Filter
    'search_participants' => 'Search Participants',
    'filter_by_status' => 'Filter by Status',
    'filter_by_department' => 'Filter by Department',
    'filter_by_completion' => 'Filter by Completion',
    'advanced_filters' => 'Advanced Filters',
];
