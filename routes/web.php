<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\AdminCommentController;
use App\Http\Controllers\Backend\AgentMessageController;
use App\Http\Controllers\Backend\AgentPropertyController;
use App\Http\Controllers\Backend\amenitieController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\TypeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [IndexController::class, 'Index'])->name('index');


// User Middleware
Route::middleware(['auth', 'verified'])->group(function () {

    //User Dashboard
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');

    //User Logout
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    //User Profile
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');

    //Admin Password
    Route::get('/user/password', [UserController::class, 'UserPassword'])->name('user.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
});



require __DIR__ . '/auth.php';

//Admin Login
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);

// Admin Middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {

    //Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    //Admin Logout
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    //Admin Profile
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');

    //Admin Password
    Route::get('/admin/password', [AdminController::class, 'AdminPassword'])->name('admin.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});

//AgentLogin
Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);

// Agent Register
Route::post('/agent/register', [AgentController::class, 'AgentRegister'])->name('agent.register');

// Agent Middleware
Route::middleware(['auth', 'roles:agent'])->group(function () {

    //Agent Dashboard
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');

    //Agent Logout
    Route::get('/agent/logout', [AgentController::class, 'AgentLogout'])->name('agent.logout');

    //Admin Profile
    Route::get('/agent/profile', [AgentController::class, 'AgentProfile'])->name('agent.profile');
    Route::post('/agent/profile/update', [AgentController::class, 'AgentProfileUpdate'])->name('agent.profile.update');

    //Agent Password
    Route::get('/agent/password', [AgentController::class, 'AgentPassword'])->name('agent.password');
    Route::post('/agent/password/update', [AgentController::class, 'AgentPasswordUpdate'])->name('agent.password.update');
});


// Admin Middleware All Route
Route::middleware(['auth', 'roles:admin'])->group(function () {

    // Admin Manage Section
    Route::controller(AdminController::class)->group(function () {

        Route::get('/all/admin', 'AllAdmin')->name('all.admin')->middleware('permission:all.admin');

        Route::get('/add/admin', 'AddAdmin')->name('add.admin')->middleware('permission:add.admin');

        Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
        Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');
    });

    // Role & Permission
    Route::controller(RoleController::class)->group(function () {

        // Permission 
        Route::get('/all/permission', 'AllPermission')->name('all.permission')->middleware('permission:all.permission');

        Route::get('/add/permission', 'AddPermission')->name('add.permission')->middleware('permission:add.permission');

        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');

        // Excel File
        Route::get('/export', 'Export')->name('export');
        Route::get('/import', 'Import')->name('import');
        Route::post('/store/import', 'StoreImport')->name('store.import');

        //Role
        Route::get('/all/role', 'AllRole')->name('all.role')->middleware('permission:all.role');

        Route::get('/add/role', 'AddRole')->name('add.role')->middleware('permission:add.role');

        Route::post('/store/role', 'StoreRole')->name('store.role');
        Route::get('/edit/role/{id}', 'EditRole')->name('edit.role');
        Route::post('/update/role', 'UpdateRole')->name('update.role');
        Route::get('/delete/role/{id}', 'DeleteRole')->name('delete.role');

        // Roles & Permission
        Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('/store/roles/permission', 'StoreRolesPermission')->name('store.roles.permission');

        Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
        Route::post('/admin/update/roles/{id}', 'AdminUpdateRoles')->name('admin.update.roles');
        Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');
    });

    // SiteSetting
    Route::controller(SiteSettingController::class)->group(function () {

        Route::get('/all/site', 'AllSite')->name('all.site')->middleware('permission:all.site');

        Route::get('/add/site', 'AddSite')->name('add.site')->middleware('permission:add.site');

        Route::post('/store/site', 'StoreSite')->name('store.site');
        Route::get('/edit/site/{id}', 'EditSite')->name('edit.site');
        Route::post('/update/site', 'UpdateSite')->name('update.site');
    });

    // Comment Section
    Route::controller(AdminCommentController::class)->group(function () {

        Route::get('/all/comment', 'AllComment')->name('all.comment')->middleware('permission:all.comment');

        Route::get('/view/comment/{id}', 'ViewComment')->name('view.comment');
        Route::post('/reply/comment', 'ReplyComment')->name('reply.comment');
    });

    // Blog Post Section
    Route::controller(BlogController::class)->group(function () {

        Route::get('/all/post', 'AllPost')->name('all.post')->middleware('permission:all.post');
        Route::get('/add/post', 'AddPost')->name('add.post')->middleware('permission:add.post');
        Route::post('/store/post', 'StorePost')->name('store.post');
        Route::get('/edit/post/{id}', 'EditPost')->name('edit.post');
        Route::post('/update/post', 'UpdatePost')->name('update.post');
        Route::get('/delete/post/{id}', 'DeletePost')->name('delete.post');
    });

    // Blog Category Section
    Route::controller(BlogController::class)->group(function () {

        Route::get('/all/category', 'AllCategory')->name('all.category')->middleware('permission:all.category');

        Route::get('/add/category', 'AddCategory')->name('add.category')->middleware('permission:add.category');

        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });


    // Agent Section
    Route::controller(AdminController::class)->group(function () {

        Route::get('/all/agent', 'AllAgent')->name('all.agent')->middleware('permission:all.agent');;
        Route::get('/delete/agent', 'DeleteAgent')->name('delete.agent');

        // Active Or Inactive
        Route::get('/inactive/agent/{id}', 'InactiveAgent')->name('inactive.agent');
        Route::get('/active/agent/{id}', 'ActiveAgent')->name('active.agent');
    });

    // Property Section
    Route::controller(PropertyController::class)->group(function () {

        Route::get('/all/property', 'AllProperty')->name('all.property')->middleware('permission:all.property');

        Route::get('/add/property', 'AddProperty')->name('add.property')->middleware('permission:add.property');

        Route::post('/store/property', 'StoreProperty')->name('store.property');
        Route::get('/edit/property/{id}', 'EditProperty')->name('edit.property');
        Route::post('/update/property', 'UpdateProperty')->name('update.property');
        Route::get('/delete/property/{id}', 'DeleteProperty')->name('delete.property');

        // 
        Route::post('/update/multiimg', 'UpdateMultiImage')->name('update.multiimg');
        Route::post('/store/new/multiimage', 'StoreMultiImage')->name('store.new.multiimage');
        Route::get('/delete/multiimg/{id}', 'DeleteMultiimg')->name('delete.multiimg');

        // Active Or Inactive
        Route::get('/inactive/property/{id}', 'InactiveProperty')->name('inactive.property');
        Route::get('/active/property/{id}', 'ActiveProperty')->name('active.property');
    });

    // Testimonial Section
    Route::controller(TestimonialController::class)->group(function () {

        Route::get('/all/testimonial', 'AllTestimonial')->name('all.testimonial')->middleware('permission:all.testimonial');

        Route::get('/add/testimonial', 'AddTestimonial')->name('add.testimonial')->middleware('permission:add.testimonial');


        Route::post('/store/testimonial', 'StoreTestimonial')->name('store.testimonial');
        Route::get('/edit/testimonial/{id}', 'EditTestimonial')->name('edit.testimonial');
        Route::post('/update/testimonial', 'UpdateTestimonial')->name('update.testimonial');
        Route::get('/delete/testimonial/{id}', 'DeleteTestimonial')->name('delete.testimonial');
    });

    // State Section
    Route::controller(StateController::class)->group(function () {

        Route::get('/all/state', 'AllState')->name('all.state')->middleware('permission:all.state');

        Route::get('/add/state', 'AddState')->name('add.state')->middleware('permission:add.state');

        Route::post('/store/state', 'StoreState')->name('store.state');
        Route::get('/edit/state/{id}', 'EditState')->name('edit.state');
        Route::post('/update/state', 'UpdateState')->name('update.state');
        Route::get('/delete/state/{id}', 'DeleteState')->name('delete.state');
    });


    // Amenitie Section
    Route::controller(amenitieController::class)->group(function () {

        Route::get('/all/amenitie', 'AllAmenitie')->name('all.amenitie')->middleware('permission:all.amenitie');

        Route::get('/add/amenitie', 'AddAmenitie')->name('add.amenitie')->middleware('permission:add.amenitie');

        Route::post('/store/amenitie', 'StoreAmenitie')->name('store.amenitie');
        Route::get('/edit/amenitie/{id}', 'EditAmenitie')->name('edit.amenitie');
        Route::post('/update/amenitie', 'UpdateAmenitie')->name('update.amenitie');
        Route::get('/delete/amenitie/{id}', 'DeleteAmenitie')->name('delete.amenitie');
    });


    // Type Section
    Route::controller(TypeController::class)->group(function () {

        Route::get('/all/type', 'AllType')->name('all.type')->middleware('permission:all.type');
        Route::get('/add/type', 'AddType')->name('add.type')->middleware('permission:add.type');
        Route::post('/store/type', 'StoreType')->name('store.type');
        Route::get('/edit/type/{id}', 'EditType')->name('edit.type');
        Route::post('/update/type', 'UpdateType')->name('update.type');
        Route::get('/delete/type/{id}', 'DeleteType')->name('delete.type');
    });
});


// Agent Middleware All Route
Route::middleware(['auth', 'roles:agent'])->group(function () {

    // Agent Property 
    Route::controller(AgentPropertyController::class)->group(function () {

        Route::get('/all/agent/property', 'AllAgentProperty')->name('all.agent.property');
        Route::get('/add/agent/property', 'AddAgentProperty')->name('add.agent.property');
        Route::post('/store/agent/property', 'StoreAgentProperty')->name('store.agent.property');
        Route::get('/edit/agent/property/{id}', 'EditAgentProperty')->name('edit.agent.property');
        Route::post('/update/agent/property', 'UpdateAgentProperty')->name('update.agent.property');
        Route::get('/delete/agent/property/{id}', 'DeleteAgentProperty')->name('delete.agent.property');


        // Multi Image
        Route::post('/store/agent/multiimage', 'StoreAgentMultiImage')->name('store.agent.multiimage');
        Route::post('/update/agent/multiimage', 'UpdateAgentMultiImage')->name('update.agent.multiimage');
        Route::get('/delete/agent/multiimage/{id}', 'DeleteAgentMultiImage')->name('delete.agent.multiimg');
    });

    // Agent Message Details
    Route::controller(AgentMessageController::class)->group(function () {

        Route::get('/agent/message/details', 'AgentMessageDetails')->name('agent.message.details');

        Route::get('/agent/message/full/{id}', 'AgentMessageFull')->name('agent.message.full');

        Route::get('/message/delete/{id}', 'MessageDelete')->name('message.delete');
    });
});

///////////////  Frontend All Route  /////////////////////////

// Type All
Route::get('/type/all', [IndexController::class, 'TypeAll'])->name('type.all');
Route::get('/type/wise/property/{id}', [IndexController::class, 'TypeWiseProperty'])->name('type.wise.property');

// Agent Details
Route::get('/agent/details/{id}', [IndexController::class, 'AgentDetails'])->name('agent.details');

//Agent Property Message
Route::post('/agent/property/message', [IndexController::class, 'AgentPropertyMessage'])->name('agent.property.message');

// State Property Details
Route::get('/state/property/details/{id}', [IndexController::class, 'StatePropertyDetails'])->name('state.property.details');

// Property Details
Route::get('property/details/{id}/{slug}', [IndexController::class, 'PropertyDetatils']);
Route::get('/frontend/all/property', [IndexController::class, 'FrontendAllProperty'])->name('frontend.all.property');

//Property Message
Route::post('/property/message', [IndexController::class, 'PropertyMessage'])->name('property.message');


// All Blog
Route::get('/all/blog', [IndexController::class, 'AllBlog'])->name('all.blog');

// Blog Details
Route::get('/blog/details/{id}', [IndexController::class, 'BlogDetatils'])->name('blog.details');

// Cat Wise Post
Route::get('/category/wise/post/{id}', [IndexController::class, 'CategoryWisePost'])->name('cat.wise.post');

// Store Comment
Route::post('/store/comment', [IndexController::class, 'StoreComment'])->name('store.comment');
