<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserProfile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\AssetitemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\WorkorderController;
use App\Http\Controllers\RollmanageController;
use App\Http\Controllers\WooperationController;
use App\Http\Controllers\CategorytypeController;
use App\Http\Controllers\ManageobjectController;
use App\Http\Controllers\MeterReadingController;
use App\Http\Controllers\ObjectaccessController;
use App\Http\Controllers\ObjecttoroleController;
use App\Http\Controllers\CategorymodelController;
use App\Http\Controllers\AssetitemPoMstController;
use App\Http\Controllers\AssetDisposeMstController;
use App\Http\Controllers\ManagincommitteeController;
use App\Http\Controllers\MaintenanceschduleController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/list', [ProfileController::class, 'index'])->name('user-list');
    Route::get('/profiles', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
     //Roll Manage
    
     Route::get("/roll-list",[RollmanageController::class,'RollList'])->name('roll-list');
     Route::get("/roll-view",[RollmanageController::class,'RollPageView'])->name('roll-view');
     Route::post('/store-roll',[RollmanageController::class,'RollStore'])->name('roll_store');
     Route::get('/roll_edit/{id}',[RollmanageController::class,'RollEdit'])->name('roll_edit');
     Route::post('/roll-update',[RollmanageController::class,'RollUpate'])->name('roll_update');
     Route::get('roll-delete/{id}',[RollmanageController::class,'RollDelete']);
    
    
    //company
        
    Route::get("/company-list",[CompanyController::class,'CompanyList'])->name('company-list');
    Route::get("/company_View",[CompanyController::class,'CompanyPageView'])->name('company_View');
    Route::post('/store-company',[CompanyController::class,'CompanyStore'])->name('company_store');
    Route::get('/company_edit/{id}',[CompanyController::class,'CompanyEdit'])->name('company_edit');
    Route::post('/company-update',[CompanyController::class,'CompanyUpate'])->name('company_update');
    Route::get('company-delete/{id}',[CompanyController::class,'CompanyDelete']);
    
    
        
     //Object Manage
    
     Route::get("/object-list",[ManageobjectController::class,'ObjectList'])->name('object-list');
     Route::get("/object-view",[ManageobjectController::class,'ObjectView'])->name('object-view');
     Route::post('/store-manageobject',[ManageobjectController::class,'ObjectStore'])->name('object_store');
     Route::get('/object_edit/{id}',[ManageobjectController::class,'ObjectEdit'])->name('object_edit');
     Route::post('/manageobject-update',[ManageobjectController::class,'ObjectUpate'])->name('object_update');
     Route::get('manageobject-delete/{id}',[ManageobjectController::class,'ObjectDelete']);
    
    
    //Object Access
     
    Route::get("/objectAcess-view",[ObjectaccessController::class,'ObjectAccessView'])->name('objectAcess-view');
    Route::get("/systemadminobjectAcess-view",[ObjectaccessController::class,'SystemadminObjectAccessView'])->name('systemadminobjectAcess-view');
    Route::get("/objectAcessToCompany",[ObjectaccessController::class,'ObjectAcessToCompanyView'])->name('objectAcessToCompany');

    Route::post('/objectAccess_store',[ObjectaccessController::class,'ObjectAccessStore'])->name('objectAccess_store');
    Route::post('/systemadminobjectAccess_store',[ObjectaccessController::class,'SystemadminObjectAccessStore'])->name('systemadminobjectAccess_store');
    Route::post('/objectAccessToCompany_store',[ObjectaccessController::class,'ObjectAccessToCompanyStore'])->name('objectAccessToCompany_store');

    Route::get('/obectaccess_edit/{id}',[ObjectaccessController::class,'ObjectAccessEdit'])->name('obectaccess_edit');
        
    //Object Assign To Role
    Route::get("/object-role-view",[ObjecttoroleController::class,'ObjectToRoleView'])->name('object-role-view');
    Route::post('/objectToRole_store',[ObjecttoroleController::class,'ObjectToRoleStore'])->name('objectToRole_store');
    
    
    //Category
    
    Route::get("/category-list",[CategoryController::class,'CategoryList'])->name('category-list');
    Route::get("/CategoryPageView",[CategoryController::class,'CategoryPageView'])->name('CategoryPageView');
    Route::post('/store-category',[CategoryController::class,'CategoryStore'])->name('category_store');
    Route::get('/category_edit/{id}',[CategoryController::class,'CategoryEdit'])->name('category_edit');
    Route::post('/category-update',[CategoryController::class,'CategoryUpate'])->name('category_update');
    Route::get('category-delete/{id}',[CategoryController::class,'CategoryDelete']);
   

    //Sub-category
    Route::get("/sub-category-list",[CategorytypeController::class,'SubCategoryList'])->name('sub-category-list');
    Route::get("/sub-category-view",[CategorytypeController::class,'SubCategoryPageView'])->name('sub-category-view');
    Route::post('/store-sub-category',[CategorytypeController::class,'SubCategoryStore'])->name('store-sub-category');
    Route::get('/subcategory_edit/{id}',[CategorytypeController::class,'SubCategoryEdit'])->name('subcategory_edit');
    Route::post('/subcategory-update',[CategorytypeController::class,'SubCategoryUpate'])->name('subcategory-update');
    Route::get('subcategory-delete/{id}',[CategorytypeController::class,'SubCategoryDelete']);


    //Category Model
    Route::get("/category-model-list",[CategorymodelController::class,'CategoryModelList'])->name('category-model-list');
    Route::get("/category-model-view",[CategorymodelController::class,'CategoryModelPageView'])->name('category-model-view');
    Route::post('/store-category-model',[CategorymodelController::class,'CategoryModelStore'])->name('store-category-model');
    Route::get('/categorymodel_edit/{id}',[CategorymodelController::class,'CategoryModelEdit'])->name('categorymodel_edit');
    Route::post('/categorymodel-update',[CategorymodelController::class,'CategoryModelUpate'])->name('categorymodel-update');
    Route::get('categorymodel-delete/{id}',[CategorymodelController::class,'CategoryModelDelete']);

    //brand
        
    Route::get("/list-brand",[BrandController::class,'BrandList'])->name('brand-list');
    Route::get("/BrandPageView",[BrandController::class,'BrandPageView'])->name('BrandPageView');
    Route::post('/store-brand',[BrandController::class,'BrandStore'])->name('brand_store');
    Route::get('/brand-edit/{id}',[BrandController::class,'BrandEdit'])->name('brand_edit');
    Route::post('/brand-update',[BrandController::class,'BrandUpate'])->name('brand_update');
    Route::get('brand-delete/{id}',[BrandController::class,'BrandDelete']);

    //Asset 
        
    Route::get("/asset_view",[AssetitemController::class,'assetView'])->name('asset_view');
    Route::post('/asset-store',[AssetitemController::class,'asseyStore'])->name('asset-store');
    Route::get("/asset_list",[AssetitemController::class,'assetList'])->name('asset_list');
    Route::get('/asset-edit/{id}',[AssetitemController::class,'assetEdit'])->name('asset-edit');
    Route::post('/asset-update',[AssetitemController::class,'assetUpate'])->name('asset-update');
    Route::get('asset-delete/{id}',[AssetitemController::class,'assetDelete']);


    //Committee Members
        
    Route::get("/committee-list",[ManagincommitteeController::class,'CommitteeList'])->name('committee-list');
    Route::get("/CommitteeView",[ManagincommitteeController::class,'CommitteeView'])->name('CommitteeView');
    Route::post('/store-committee',[ManagincommitteeController::class,'CommitteeStore'])->name('committee_store');
    Route::get('/committee-edit/{id}',[ManagincommitteeController::class,'CommitteeEdit'])->name('committee_edit');
    Route::post('/committee-update',[ManagincommitteeController::class,'CommitteeUpate'])->name('committee_update');
    Route::get('committee-delete/{id}',[ManagincommitteeController::class,'CommitteeDelete']);


    //General Member
        
    Route::get("/member-list",[MemberController::class,'MemberList'])->name('member-list');
    Route::get("/member-view",[MemberController::class,'MemberView'])->name('member-view');
    Route::post('/store-member',[MemberController::class,'MemberStore'])->name('member-store');
    Route::get('/member-edit/{id}',[MemberController::class,'MemberEdit'])->name('member-edit');
    Route::post('/membere-update',[MemberController::class,'MemberUpate'])->name('member-update');
    Route::get('member-delete/{id}',[MemberController::class,'MemberDelete']);

    
    //User Profile
        
    Route::get("/user_profile",[UserProfile::class,'UserProfileList'])->name('user_profile'); 
    Route::get('/user-edit/{id}',[UserProfile::class,'UserProfileEdit'])->name('user-edit');
    Route::post('/userprofile-update',[UserProfile::class,'UserProfileUpate'])->name('userprofile-update');

    Route::get("/system_user_pofile",[UserProfile::class,'SystemUserProfileList'])->name('system_user_pofile');
    Route::get('/system-user-edit/{id}',[UserProfile::class,'SystemUserProfileEdit'])->name('system-user-edit');
    Route::post('/system-userprofile-update',[UserProfile::class,'SystemUserProfileUpate'])->name('system-userprofile-update');
    
    //Workshop

    Route::get("/workshop-list",[WorkshopController::class,'workshopList'])->name('workshop-list');
    Route::get("/workshop-view",[WorkshopController::class,'workshopView'])->name('workshop-view');
    Route::post('/workshop-store',[WorkshopController::class,'workshopStore'])->name('workshop-store');
    Route::get('/workshop-edit/{id}',[WorkshopController::class,'workshopEdit'])->name('workshop-edit');
    Route::post('/workshop-update',[WorkshopController::class,'workshopUpate'])->name('workshop-update');
    Route::get('workshop-delete/{id}',[WorkshopController::class,'workshopDelete']);

    //Supplier
    
    Route::get("/supplier-view",[SupplierController::class,'supplierView'])->name('supplier-view');
    Route::post('/supplier-store',[SupplierController::class,'supplierStore'])->name('supplier-store');
    Route::get("/supplier-list",[SupplierController::class,'supplierList'])->name('supplier-list');
    Route::get('/supplier-edit/{id}',[SupplierController::class,'supplierEdit'])->name('supplier-edit');
    Route::post('/supplier-update',[SupplierController::class,'supplierUpate'])->name('supplier-update');
    Route::get('supplier-delete/{id}',[SupplierController::class,'supplierDelete']);


    //MeterReading

    Route::get("/meter-view", [MeterReadingController::class, 'meterView'])->name('meter-view');
    Route::post('/meter-store', [MeterReadingController::class, 'meterStore'])->name('meter-store');
    Route::get("/meter-list", [MeterReadingController::class, 'meterList'])->name('meter-list');
    Route::get('/meter-edit/{id}', [MeterReadingController::class, 'meterEdit'])->name('meter-edit');
    Route::post('/meter-update', [MeterReadingController::class, 'meterUpate'])->name('meter-update');
    Route::get('/meter-delete/{id}', [MeterReadingController::class, 'meterDelete']);

    //Work Order,operation,material, work permit

    Route::get("/work_order", [WorkorderController::class, 'workorderView'])->name('work_order');
    Route::post('/workorder-store', [WorkorderController::class, 'store'])->name('workorder-store');
    Route::get("/work_order_list", [WorkorderController::class, 'workorderList'])->name('work_order_list');
   
    Route::get('/workorder-edit/{id}', [WorkorderController::class, 'workorderEdit'])->name('workorder-edit');
    Route::post('/workorder-update', [WorkorderController::class, 'workorderUpate'])->name('workorder-update');

    Route::get("/workOrderApprovalPending", [WorkorderController::class, 'workOrderApprovalPending'])->name('workOrderApprovalPending');
    Route::get('/workorder-maintenance/{id}', [WorkorderController::class, 'workorderMaintenance'])->name('workorder-maintenance');
    Route::post('/workorder-maintenance-store', [WorkorderController::class, 'workorderMaintenanceStore'])->name('workorder-maintenance-store');
    
    Route::get('/workorder-delete-creator/{id}', [WorkorderController::class, 'workorderDeleteCreator']);
    Route::get('/workorder-delete-approver/{id}', [WorkorderController::class, 'workorderDeleteApprover']);

    

    //Maintanence Schedule

    Route::get("/maintenanceschdule-view", [MaintenanceschduleController::class, 'maintenanceSchduleView'])->name('maintenanceschdule-view');
    Route::post('/maintenanceschdule-store', [MaintenanceschduleController::class, 'maintenanceSchduleStore'])->name('maintenanceschdule-store');
    //Route::get("/maintenanceschdule-list", [MaintenanceschduleController::class, 'maintenanceSchduleList'])->name('maintenanceSchdule-list');
    Route::get("/maintSchedule_list", [MaintenanceschduleController::class, 'maintscheduleList'])->name('maintSchedule_list');
    Route::get('/maintenanceschdule-edit/{id}', [MaintenanceschduleController::class, 'maintenanceSchduleEdit'])->name('maintenanceSchdule-edit');
    Route::post('/maintenanceschdule-update', [MaintenanceschduleController::class, 'maintenanceschduleUpate'])->name('maintenanceschdule-update');
    Route::get('/maintenanceschdule-delete/{id}', [MaintenanceschduleController::class, 'maintenanceschduleDelete']);

 
    //Operation

    Route::get("/operation-view", [OperationController::class, 'operationView'])->name('operation-view');
    Route::post('/operation-store', [OperationController::class, 'operationStore'])->name('operation-store');
    Route::get("/operation-list", [OperationController::class, 'operationList'])->name('operation-list');
    Route::get('/operation-edit/{id}', [OperationController::class, 'operationEdit'])->name('operation-edit');
    Route::post('/operation-update', [OperationController::class, 'operationUpdate'])->name('operation-update');
    Route::get('operation-delete/{id}', [OperationController::class, 'operationDelete']);


    //Asset Purchase Order
        
    Route::get("/assetPurchaseOrder-view",[AssetitemPoMstController::class,'assetPurchaseOrderView'])->name('assetPurchaseOrder-view');
    Route::post('/asset-purchase-order-store',[AssetitemPoMstController::class,'assetPurchaseOrderStore'])->name('assetPurchaseOrdermst-store');


    //Spare Parts
    
    Route::get("/sparepart-view",[SparepartController::class,'sparepartView'])->name('spareparts-view');
    Route::post('/sparepart-store',[SparepartController::class,'sparepartStore'])->name('sparepart-store');
    
    Route::get("/sparepart-list",[SparepartController::class,'sparepartList'])->name('sparepart-list');
    
    Route::get('/sparepart-edit/{id}',[SparepartController::class,'sparepartEdit'])->name('sparepart-edit');
    Route::post('/sparepart-update',[SparepartController::class,'sparepartUpate'])->name('sparepart-update');
    Route::get('sparepart-delete/{id}',[SparepartController::class,'sparepartDelete']);
    
    Route::get('/sparepart-report/{id}', [SparepartController::class, 'sparepartReport'])->name('sparepart-report');


    //Asset Dispose
        
    Route::get('/asset-dispose-view',[AssetDisposeMstController::class,'assetDisposeView'])->name('assetDispose-view');
    Route::post('/asset-dispose-store',[AssetDisposeMstController::class,'assetDisposeStore'])->name('assetDispose-store');
    
    Route::get("/asset-dispose-list",[AssetDisposeMstController::class,'assetDisposeList'])->name('assetDispose-list');
    Route::get("/asset-dispose-approved-list",[AssetDisposeMstController::class,'assetDisposeApprovedList'])->name('assetDisposeApproved-list');
    
    Route::get('/asset-dispose-edit/{id}',[AssetDisposeMstController::class,'assetDisposeEdit'])->name('assetDispose-edit');
    Route::post('/asset-dispose-update',[AssetDisposeMstController::class,'assetDisposeUpdate'])->name('assetDispose-update');
    Route::get('asset-dispose-delete/{id}',[AssetDisposeMstController::class,'assetDisposeDelete']);
    
    Route::get('/asset-dispose-report/{id}', [AssetDisposeMstController::class, 'assetDisposeReport'])->name('assetDispose-report');


});


require __DIR__.'/auth.php';
