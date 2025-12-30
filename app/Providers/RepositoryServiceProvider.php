<?php

namespace App\Providers;

use App\Models\AuditLog;
use App\Models\Cart;
use App\Models\Company;
use App\Models\CompanyAdmin;
use App\Models\CompanySubscription;
use App\Models\ImportBatch;
use App\Models\Menu;
use App\Models\MonitoringSnapshot;
use App\Models\Order;
use App\Models\Participant;
use App\Models\ParticipantTestAssignment;
use App\Models\PublicUser;
use App\Models\SubscriptionPlan;
use App\Models\SuperAdmin;
use App\Models\Test;
use App\Models\TestAttempt;
use App\Models\TestCategory;
use App\Models\User;
use App\Repositories\AuditLogRepository;
use App\Repositories\CartRepository;
use App\Repositories\CompanyAdminRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\CompanySubscriptionRepository;
use App\Repositories\ImportBatchRepository;
use App\Repositories\MenuItemRepository;
use App\Repositories\MenuRepository;
use App\Repositories\MonitoringSnapshotRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ParticipantRepository;
use App\Repositories\ParticipantTestAssignmentRepository;
use App\Repositories\PublicUserRepository;
use App\Repositories\RoleMenuPermissionRepository;
use App\Repositories\SubscriptionPlanRepository;
use App\Repositories\SuperAdminRepository;
use App\Repositories\TestAttemptRepository;
use App\Repositories\TestCategoryRepository;
use App\Repositories\TestRepository;
use App\Repositories\UserRepository;
use App\Services\MenuService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Base repositories
        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository(new User);
        });

        $this->app->singleton(TestRepository::class, function ($app) {
            return new TestRepository(new Test);
        });

        $this->app->singleton(TestAttemptRepository::class, function ($app) {
            return new TestAttemptRepository(new TestAttempt);
        });

        $this->app->singleton(ParticipantRepository::class, function ($app) {
            return new ParticipantRepository(new Participant);
        });

        $this->app->singleton(CompanyRepository::class, function ($app) {
            return new CompanyRepository(new Company);
        });

        $this->app->singleton(CompanyAdminRepository::class, function ($app) {
            return new CompanyAdminRepository(new CompanyAdmin);
        });

        $this->app->singleton(SuperAdminRepository::class, function ($app) {
            return new SuperAdminRepository(new SuperAdmin);
        });

        $this->app->singleton(PublicUserRepository::class, function ($app) {
            return new PublicUserRepository(new PublicUser);
        });

        $this->app->singleton(SubscriptionPlanRepository::class, function ($app) {
            return new SubscriptionPlanRepository(new SubscriptionPlan);
        });

        $this->app->singleton(CompanySubscriptionRepository::class, function ($app) {
            return new CompanySubscriptionRepository(new CompanySubscription);
        });

        $this->app->singleton(TestCategoryRepository::class, function ($app) {
            return new TestCategoryRepository(new TestCategory);
        });

        $this->app->singleton(CartRepository::class, function ($app) {
            return new CartRepository(new Cart);
        });

        $this->app->singleton(OrderRepository::class, function ($app) {
            return new OrderRepository(new Order);
        });

        $this->app->singleton(AuditLogRepository::class, function ($app) {
            return new AuditLogRepository(new AuditLog);
        });

        $this->app->singleton(MonitoringSnapshotRepository::class, function ($app) {
            return new MonitoringSnapshotRepository(new MonitoringSnapshot);
        });

        $this->app->singleton(ImportBatchRepository::class, function ($app) {
            return new ImportBatchRepository(new ImportBatch);
        });

        $this->app->singleton(ParticipantTestAssignmentRepository::class, function ($app) {
            return new ParticipantTestAssignmentRepository(new ParticipantTestAssignment);
        });

        $this->app->singleton(MenuRepository::class, function ($app) {
            return new MenuRepository(new Menu);
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
