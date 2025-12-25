<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\{
    UserRepository,
    TestRepository,
    TestAttemptRepository,
    ParticipantRepository,
    CompanyRepository,
    CompanyAdminRepository,
    SuperAdminRepository,
    PublicUserRepository,
    SubscriptionPlanRepository,
    CompanySubscriptionRepository,
    TestCategoryRepository,
    CartRepository,
    OrderRepository,
    AuditLogRepository,
    MonitoringSnapshotRepository,
    ImportBatchRepository,
    ParticipantTestAssignmentRepository
};
use App\Models\{
    User,
    Test,
    TestAttempt,
    Participant,
    Company,
    CompanyAdmin,
    SuperAdmin,
    PublicUser,
    SubscriptionPlan,
    CompanySubscription,
    TestCategory,
    Cart,
    Order,
    AuditLog,
    MonitoringSnapshot,
    ImportBatch,
    ParticipantTestAssignment
};

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Base repositories
        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository(new User());
        });

        $this->app->singleton(TestRepository::class, function ($app) {
            return new TestRepository(new Test());
        });

        $this->app->singleton(TestAttemptRepository::class, function ($app) {
            return new TestAttemptRepository(new TestAttempt());
        });

        $this->app->singleton(ParticipantRepository::class, function ($app) {
            return new ParticipantRepository(new Participant());
        });

        $this->app->singleton(CompanyRepository::class, function ($app) {
            return new CompanyRepository(new Company());
        });

        $this->app->singleton(CompanyAdminRepository::class, function ($app) {
            return new CompanyAdminRepository(new CompanyAdmin());
        });

        $this->app->singleton(SuperAdminRepository::class, function ($app) {
            return new SuperAdminRepository(new SuperAdmin());
        });

        $this->app->singleton(PublicUserRepository::class, function ($app) {
            return new PublicUserRepository(new PublicUser());
        });

        $this->app->singleton(SubscriptionPlanRepository::class, function ($app) {
            return new SubscriptionPlanRepository(new SubscriptionPlan());
        });

        $this->app->singleton(CompanySubscriptionRepository::class, function ($app) {
            return new CompanySubscriptionRepository(new CompanySubscription());
        });

        $this->app->singleton(TestCategoryRepository::class, function ($app) {
            return new TestCategoryRepository(new TestCategory());
        });

        $this->app->singleton(CartRepository::class, function ($app) {
            return new CartRepository(new Cart());
        });

        $this->app->singleton(OrderRepository::class, function ($app) {
            return new OrderRepository(new Order());
        });

        $this->app->singleton(AuditLogRepository::class, function ($app) {
            return new AuditLogRepository(new AuditLog());
        });

        $this->app->singleton(MonitoringSnapshotRepository::class, function ($app) {
            return new MonitoringSnapshotRepository(new MonitoringSnapshot());
        });

        $this->app->singleton(ImportBatchRepository::class, function ($app) {
            return new ImportBatchRepository(new ImportBatch());
        });

        $this->app->singleton(ParticipantTestAssignmentRepository::class, function ($app) {
            return new ParticipantTestAssignmentRepository(new ParticipantTestAssignment());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
