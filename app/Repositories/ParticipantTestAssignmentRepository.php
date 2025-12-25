<?php

namespace App\Repositories;

use App\Models\ParticipantTestAssignment;
use Illuminate\Database\Eloquent\Collection;

class ParticipantTestAssignmentRepository extends BaseRepository
{
    public function __construct(ParticipantTestAssignment $assignment)
    {
        parent::__construct($assignment);
    }

    /**
     * Get assignments for participant
     */
    public function getAssignmentsForParticipant(int $participantId): Collection
    {
        return $this->model->where('participant_id', $participantId)
            ->with(['test', 'attempts' => function($query) {
                $query->latest()->take(1);
            }])
            ->orderBy('test_order')
            ->get();
    }

    /**
     * Get available assignments for participant
     */
    public function getAvailableAssignmentsForParticipant(int $participantId): Collection
    {
        return $this->model->where('participant_id', $participantId)
            ->where('status', 'available')
            ->with('test')
            ->orderBy('test_order')
            ->get();
    }

    /**
     * Update assignment status
     */
    public function updateStatus(ParticipantTestAssignment $assignment, string $status): bool
    {
        return $assignment->update(['status' => $status]);
    }

    /**
     * Get next assignment for participant
     */
    public function getNextAssignment(int $participantId): ?ParticipantTestAssignment
    {
        return $this->model->where('participant_id', $participantId)
            ->where('status', 'available')
            ->orderBy('test_order')
            ->first();
    }

    /**
     * Check if participant can access assignment
     */
    public function canAccessAssignment(ParticipantTestAssignment $assignment): bool
    {
        return $assignment->status === 'available' &&
               $assignment->available_from <= now() &&
               ($assignment->available_until === null || $assignment->available_until >= now());
    }
}
