<?php

namespace App\Enums;

enum MonitoringTriggerType: string
{
    // 'manual',
    // 'timer',
    // 'suspicious_activity',
    // 'tab_change',
    // 'copy_attempt',
    // 'right_click',
    // 'devtool_open',
    // 'fullscreen_exit',
    // 'face_not_detected',
    // 'multiple_faces'

    case MANUAL = 'manual';
    case TIMER = 'timer';
    case SUSPICIOUS_ACTIVITY = 'suspicious_activity';
    case TAB_CHANGE = 'tab_change';
    case COPY_ATTEMPT = 'copy_attempt';
    case RIGHT_CLICK = 'right_click';
    case DEVTOOL_OPEN = 'devtool_open';
    case FULLSCREEN_EXIT = 'fullscreen_exit';
    case FACE_NOT_DETECTED = 'face_not_detected';
    case MULTIPLE_FACES = 'multiple_faces';
}
