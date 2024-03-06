<?php


use App\Models\User as AppUser;

use App\Http\Livewire\Admin\User;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Admin\Tutor;

use App\Http\Livewire\Common\Team;
use App\Http\Livewire\LeadGodMode;
use App\Http\Livewire\Website\Faq;

use App\Http\Livewire\Auth\Profile;
use App\Http\Livewire\Common\Leave;

use App\Http\Livewire\ImportModule;
use App\Http\Livewire\Website\Home;
use App\Http\Livewire\Admin\Content;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Website\About;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Livewire\Courses\Course;


// use App\Http\Livewire\Admin\ContentCategory;


use App\Http\Livewire\Front\Leadform;
use App\Http\Livewire\Website\Career;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Sales\Dashboard;
use App\Http\Livewire\Student\Classes;
// use App\Http\Livewire\Admin\ContentCategory;
use App\Http\Livewire\Website\Courses;
use App\Http\Livewire\Website\Payment;

use App\Http\Livewire\Admin\Department;
use App\Http\Livewire\Admin\Leadcreate;

use App\Http\Livewire\Admin\OurClients;
use App\Http\Livewire\Courses\Payments;
use App\Http\Livewire\Training\Reports;
use App\Http\Livewire\Website\Services;
use App\Http\Controllers\ExamController;





use App\Http\Controllers\TestController;


use App\Http\Controllers\PaytmController;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\InappNotifications;
use App\Http\Livewire\Sales\Juniorreport;


use App\Http\Livewire\Admin\QuestionPaper;


use App\Http\Livewire\Admin\SlotComponent;
use App\Http\Livewire\Auth\Changepassword;

use App\Http\Livewire\Auth\ForgotPassword;


// use App\Http\Livewire\ImportModule;
// use App\Http\Livewire\Courses\Payments;
// use App\Http\Livewire\Ceo\Dashboard as CeoDashboard;

use App\Http\Livewire\Sales\Seniorreport; 
use App\Http\Livewire\Website\PaymentView;
use App\Http\Livewire\Website\Scholarship;


use App\Http\Livewire\Admin\EmployeesSlots;



/**
 * 
 * ===========================================================
 * **************** Common routes start here *****************
 * ===========================================================
 * 
 */

use App\Http\Livewire\Admin\Userassignment;
use App\Http\Livewire\Common\ClassSchedule;
use App\Http\Livewire\Common\JoinPRMeeting;
use App\Http\Livewire\Common\LeaveApproval;

use App\Notifications\NewUserRegisteration;
use App\Http\Livewire\Admin\ExamInstruction;
use App\Http\Livewire\Sales\Juniordashboard;
use App\Http\Livewire\Sales\JuniorLeadsList;
use App\Http\Controllers\DemoClassController;
use App\Http\Livewire\Admin\Faq as AdminFaqs;

use App\Http\Livewire\Auth\ChangePasswordNew;
use App\Http\Livewire\Common\CreatePRMeeting;


/**
 * 
 * ===========================================================
 * **************** Admin routes start here *****************
 * ===========================================================
 * 
 */
use App\Http\Livewire\Sales\Juniorcreatelead;

use App\Http\Livewire\Sales\Seniorcreatelead;
use App\Http\Livewire\Training\CreateClasses;
use App\Http\Livewire\Common\CourseManagement;
use App\Http\Livewire\Content\ContentCategory;
use App\Http\Livewire\Courses\Discountmanager;
use App\Http\Livewire\Student\ScholarshipUser;
use App\Http\Livewire\Training\AssigntoJunior;
use App\Http\Livewire\Training\JuniorClasses; 




/**
 * 
 * ===========================================================
 * *************** Sales/ Marketing routes start here ********
 * ===========================================================
 * 
 */

// BDM TL routes 
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ScholarshipController;

// BDE Junior routes 
use App\Http\Livewire\Admin\ContentSubcategory;

// BDE Intern routes 
use App\Http\Livewire\Training\SeniorDashboard;

// BDE TL routes 
use App\Http\Controllers\PaytmPaymentController;
use App\Http\Livewire\Admin\EmployeesOfTheMonth;

/**
 * 
 * ===========================================================
 * *************** Student routes start here ****************
 * ===========================================================
 * 
 */
use App\Http\Livewire\Website\UnderConstruction;
use App\Http\Livewire\Common\TrainerAvailability;
use App\Http\Livewire\Sales\Juniorreportatglance;
use App\Http\Livewire\Sales\BdeJunior\Performance;
use App\Http\Livewire\Admin\SubDepartmentComponent;




/**
 * 
 * ===========================================================
 * *************** Tranner routes start here ****************
 * ===========================================================
 * 
 */

//  demo manager routes 
use App\Http\Livewire\Sales\Reports as SalesReport;

// qa manager routes 
use App\Http\Livewire\Ceo\Dashboard as CeoDashboard; 
use App\Http\Livewire\Training\Classes as AppClasses;

// demo trainer routes 
use App\Http\Livewire\Training\Content as AppContent;

// class triner routes 
use App\Http\Livewire\Admin\Dashboard as AdminDashboard;






// mixed routes 
use App\Http\Livewire\Student\Reports as StudentReports;
use App\Http\Livewire\Student\Dashboard as StudentDashboard;
use App\Http\Livewire\Training\QAManager\StudentPerformance;
use App\Http\Livewire\Accounts\Dashboard as AccountDashboard;
use App\Http\Livewire\Courses\Coursetype as CoursesTypeComponent;
use App\Http\Livewire\Training\QAManager\Dashboard as QADashboard;
use App\Http\Livewire\Sales\BdeTeamLead\Dashboard as BdeTLDashboard;
use App\Http\Livewire\Sales\BdmTeamLead\Dashboard as BdmTLDashboard;
use App\Http\Livewire\Student\QuestionPaper as StudentQuestionPaper;
use App\Http\Livewire\Training\DemoManager\Dashboard as DMDashboard;
use App\Http\Livewire\Training\DemoTrainer\Dashboard as DTDashboard;
use App\Http\Livewire\Training\ClassTrainer\Dashboard as CTDashboard;
use App\Http\Livewire\Sales\BdeIntern\Dashboard as BdeInternDashboard;
use App\Http\Livewire\Sales\BdeJunior\Dashboard as BdeJuniorDashboard;
use App\Http\Livewire\Training\QAManager\Performance as QAPerformance;
use App\Http\Livewire\Content\Juniordashboard as ContentJuniordashboard;
use App\Http\Livewire\Content\Seniordashboard as ContentSeniordashboard;
use App\Http\Livewire\Sales\BdeTeamLead\Performance as BdeTLPerformance;
use App\Http\Livewire\Sales\BdmTeamLead\Performance as BdmTLPerformance;
use App\Http\Livewire\Student\ExamInstruction as StudentExamInstruction;
use App\Http\Livewire\Sales\BdeIntern\Performance as BDEInterPerfromance;
use App\Http\Livewire\Training\JuniorDashboard as TrainingJuniorDashboard;
use App\Http\Livewire\Training\DemoManager\Performance as DemoManagerPerformance;
use App\Http\Livewire\Training\DemoTrainer\Performance as DemoTrainerPerformance;
use App\Http\Livewire\Training\ClassTrainer\Performance as ClassTrainerPerfromance;

Route::get('/testnotification1',function(){
 // dd('call');
  //  $usermessage="Dear RAHUL MODI ";
  //  $title="ss";
 //   AppUser::findorFail(1)->notify(new NewUserRegisteration($title,$usermessage,1));
  $user = AppUser::find(234); $user->password = Hash::make('admin123'); $user->save(); 

})->name('testnotification1');

Route::get('/check',function(){
dd("call");
 $user = AppUser::find(1); $user->password = Hash::make('admin123'); $user->save(); 
})->name('check');


// website routes 
Route::get('/',Home::class)->name('home');
Route::get('/about',About::class)->name('about');
Route::get('/career',Career::class)->name('career');
Route::get('/organization',UnderConstruction::class)->name('organization');
// Route::get('/services',Services::class)->name('services');
Route::get('/course',Courses::class)->name('course');
Route::get('/faq',Faq::class)->name('faq');
Route::get('/demo-class', [DemoClassController::class, 'index'])->name('demoClass');
Route::post('/book-demo', [DemoClassController::class, 'store'])->name('bookDemo');
Route::get('/whatsapp',  [DemoClassController::class, 'whatsappTest']);
Route::get('/orad-little-champ-competition', Scholarship::class)->name('scholarship');
Route::post('/scholarship', [ScholarshipController::class, 'store'])->name('storeScholarship');

Route::get('/exam-instruction', [ExamController::class, 'index'])->name('exam-instructions');
Route::get('/exam', [ExamController::class, 'exam'])->name('exam');

Route::get('/services', UnderConstruction::class)->name('services');

Route::get('/login',Login::class)->name('login');
Route::get('/register',Register::class)->name('register');
Route::get('/forgotpassword',ForgotPassword::class)->name('forgotpassword');
Route::get('/resetpassword/{encryptedUserid}',ResetPassword::class)->name('resetpassword');


/**
 * 
 * ===========================================================
 * **************** Payment routes start here *****************
 * ===========================================================
 * 
 */
Route::get('/payments/{courseid}', Payment::class)->name('payment');
Route::post('paytm-payment',[PaytmPaymentController::Class, 'paytmPayment'])->name('paytm.payment');
Route::post('paytm-callback',[PaytmPaymentController::Class, 'paytmCallback'])->name('paytm.callback');
// Route::get('course-payment/{id}',[PaytmController::class,'paymentview'])->name('course-payment');
// Route::post('course-payment/{id}',[PaytmController::class,'initalpayment'])->name('paymentinitialize');
Route::get('/short-url/{link}',[PaytmPaymentController::class,'shorturl'])->name('shorturl');
Route::get('/billing/{id}',[PaytmPaymentController::class,'billing'])->name('billing');
/**
 * ***************************************************************************
 * =========================PAYMENT ROUTES END HERE ===========================
 * ****************************************************************************
 */


Route::get('/logout',function(){
    Auth::logout();
    return redirect()->route('login');
})->name('logout');



// Route::get('/paymentinitialize',[PaytmController::class,]);

Route::prefix('ceo')->name('ceo.')->middleware(['auth'])->group(function(){
    Route::get('/dashboard',CeoDashboard::class)->name('dashboard');
});



/**
 * 
 * ===========================================================
 * **************** Common routes start here *****************
 * ===========================================================
 * 
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/profile',Profile::class)->name('profile');
    Route::get('/change-password',ChangePasswordNew::class)->name('change-password');
    Route::get('/leaves',Leave::class)->name('leave');
    Route::get('/leave-approve',LeaveApproval::class)->middleware('senior')->name('leave-approve');
    Route::get('/create-meeting',CreatePRMeeting::class)->middleware('senior')->name('createmeeting');
    Route::get('/team', Team::class)->middleware('senior')->name('team');
    Route::get('/join-meeting',JoinPRMeeting::class)->middleware('junior')->name('joinmeeting');


    // only for trainer panel 
    Route::get('/trainer-availablity', TrainerAvailability::class)->middleware('trainer')->name('availablity');
    Route::get('/class-schedule', ClassSchedule::class)->name('classSchedule');
    
    // only for QA & class trainer 
    Route::get('/course-management', CourseManagement::class)->middleware('classpanel')->name('coursemanagement');
    
});

/**
 * ***************************************************************************
 * =========================COMMON ROUTES END HERE ===========================
 * ****************************************************************************
 */

 /**
 * 
 * ===========================================================
 * **************** ADMIN ROUTES START HERE ******************
 * ===========================================================
 * 
 */
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
    Route::get('/dashboard',AdminDashboard::class)->name('dashboard');
    Route::get('/usermanagement',User::class)->name('usermanagement');
    Route::get('/department', Department::class)->name('departments');
    Route::get('/subdepartment', SubDepartmentComponent::class)->name('subdepartments');
    // Route::get('/slot', SlotComponent::class)->name('slot');
    Route::get('/userassginment',Userassignment::class)->name('userassginment');
    Route::get('/slots',EmployeesSlots::class)->name('slotmanagement');
    
    Route::get('/contentsubcategory', ContentSubcategory::class)->name('contentsubcategory');
    Route::get('/content', Content::class)->name('content');
    Route::get('/course',Course::class)->name('course');
    Route::get('/coursetype',CoursesTypeComponent::class)->name('coursetype');
    Route::get('/discountmanager',Discountmanager::class)->name('discountmanager');
    Route::get('/leadcreate',Leadcreate::class)->name('leadcreate');
    Route::get('/faq',AdminFaqs::class)->name('adminFaqs');
    Route::get('/employee-of-month',EmployeesOfTheMonth::class)->name('empOfMonth');
    Route::get('/tutor',Tutor::class)->name('meetOurTutor');
    Route::get('/our-clients',OurClients::class)->name('ourClients');


    
    // examination routes 
    Route::get('/instruction',ExamInstruction::class)->name('instruction');
    Route::get('/exam-paper',QuestionPaper::class)->name('paper');

});

/**
 * ***************************************************************************
 * ========================= ADMIN ROUTES END HERE ===========================
 * ****************************************************************************
 */


 /**
 * 
 * ===========================================================
 * **************** MARKETING ROUTES START HERE **************
 * ===========================================================
 * 
 */
// bdm team lead routes 
Route::prefix('bdm_teamLead')->name('bdm_teamLead.')->middleware(['auth','bdm_teamlead'])->group(function ()
{
    Route::get('/dashboard', BdmTLDashboard::class)->name('dashboard');
    Route::get('/performance', BdmTLPerformance::class)->name('performance');
});

// bde Junior routes 
Route::prefix('bde_junior')->name('bde_junior.')->middleware('bde')->group(function ()
{
    Route::get('/dashboard', BdeJuniorDashboard::class)->name('dashboard');
    Route::get('/performance', Performance::class)->name('performance');
});

// bde intern routes 
Route::prefix('bde_intern')->name('bde_intern.')->middleware('bde_intern')->group(function ()
{
    Route::get('/dashboard', BdeInternDashboard::class)->name('dashboard');
    Route::get('/performance', BDEInterPerfromance::class)->name('performance');
});

// bde team lead routes 
Route::prefix('bde_teamLead')->name('bde_teamLead.')->middleware('bde_teamlead')->group(function ()
{
    Route::get('/dashboard', BdeTLDashboard::class)->name('dashboard');
    Route::get('/performance', BdeTLPerformance::class)->name('performance');
    
});
/**
 * ***************************************************************************
 * ========================= MARKETING ROUTES END HERE =======================
 * ****************************************************************************
 */


  /**
 * 
 * ===========================================================
 * **************** TRAINER ROUTES START HERE ****************
 * ===========================================================
 * 
 */

// demo_manager routes 
Route::prefix('demo_manager')->name('demo_manager.')->middleware('demo_manager')->group(function ()
{
    Route::get('/dashboard', DMDashboard::class)->name('dashboard');
    Route::get('/performance', DemoManagerPerformance::class)->name('performance');
});

// qa_manager routes 
Route::prefix('qa_manager')->name('qa_manager.')->middleware('quality_analiyst')->group(function ()
{
    Route::get('/dashboard', QADashboard::class)->name('dashboard');
    Route::get('/student-performance', StudentPerformance::class)->name('studentperformance');
    Route::get('/performance', QAPerformance::class)->name('performance');
    
});

// demo_trainer routes 
Route::prefix('demo_trainer')->name('demo_trainer.')->middleware('demo_trainer')->group(function ()
{
    Route::get('/dashboard', DTDashboard::class)->name('dashboard');
    Route::get('/performance', DemoTrainerPerformance::class)->name('performance');
});

// class_trainer routes 
Route::prefix('class_trainer')->name('class_trainer.')->middleware('class_trainer')->group(function ()
{
    Route::get('/dashboard', CTDashboard::class)->name('dashboard');
    Route::get('/performance', ClassTrainerPerfromance::class)->name('performance');
});

/**
 * ***************************************************************************
 * ========================= TRAINER ROUTES END HERE =========================
 * ****************************************************************************
 */


// Route::prefix('sales')->name('sales.')->middleware(['auth'])->group(function(){
//     Route::get('/seniorsalesteam', SeniorSalesTeam::class)->name('seniorsalesteam');
//     Route::get('/juniorcreatelead',Juniorcreatelead::class)->name('createleadjunior');
//     Route::get('/seniorcreatelead',Seniorcreatelead::class)->name('createleadsenior');
//     Route::get('/juniorleadslist/{id}', JuniorLeadsList::class)->name('juniorleadslist');
//     Route::get('/juniordashboard',Juniordashboard::class)->name('juniordashboard');
//     Route::get('/juniorreport/{id?}',Juniorreport::class)->name('juniorreport');
//     Route::get('/seniorreport',Seniorreport::class)->name('seniorreport');
//     Route::get('/reports',SalesReport::class)->name('reports');
//     Route::get('/juniorreportatglance/{id}',Juniorreportatglance::class)->name('juniorreportatglance');
    
// });


// Route::prefix('training')->name('training.')->middleware(['auth'])->group(function(){
//     Route::get('/seniordashboard', SeniorDashboard::class)->name('seniordashboard');
//     Route::get('/juniordashboard', TrainingJuniorDashboard::class)->name('juniordashboard');
//     Route::get('/assigntojunior/{id}/{leadid}', AssigntoJunior::class)->name('assigntojunior');
//     Route::get('/choosecontent',AppContent::class)->name('choosecontent');
//     Route::get('/createclass/{id}',CreateClasses::class)->name('createclass');
//     Route::get('/juniorclasses',AppClasses::class)->name('juniorclasses');
//     Route::get('/juniorclassreport/{id}',JuniorClasses::class)->name('juniorclassreport');
//     Route::get('/reports',Reports::class)->name('reports');
//     // Route::get('/reports',Reports::class)->name('reports');
//     // Route::get('/createclass/{id}',CreateClasses::class)->name('createclass');
//     // Route::get('/juniorclasses',AppClasses::class)->name('juniorclasses');
//     // Route::get('/juniorclassreport/{id}',JuniorClasses::class)->name('juniorclassreport');
// });

// student panel 
Route::prefix('student')->name('student.')->middleware(['auth','lead'])->group(function(){
    Route::get('/dashboard',StudentDashboard::class)->name('dashboard');
    Route::get('/certificate/{id}/{demoid}',[CertificateController::class,'index'])->name('certificate');
    Route::get('/studentclasses',Classes::class)->name('studentclasses');
    Route::get('/reports',StudentReports::class)->name('reports');
});

// scholarship user 
Route::prefix('scholarship')->name('scholarship.')->middleware(['auth','scholarship'])->group(function(){
    Route::get('/dashboard',ScholarshipUser::class)->name('dashboard');
    Route::get('/exam-instructions', StudentExamInstruction::class)->name('exam-instructions');
    Route::get('/exam/{instruction_id}', StudentQuestionPaper::class)->name('exam');
});

Route::prefix('content')->name('content.')->middleware(['auth'])->group(function(){
    Route::get('/seniordashboard',ContentSeniordashboard::class)->name('seniordashboard');
    Route::get('/juniordashboard',ContentJuniordashboard::class)->name('juniordashboard');
    Route::get('/contentcategory', ContentCategory::class)->name('contentcategory');
});

Route::prefix('accounts')->name('accounts.')->middleware(['auth'])->group(function(){
    Route::get('dashboard',AccountDashboard::class)->name('accountdashboard');
});


// Route::get('/',Leadform::class)->name('frontform');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');


Route::get('/checkmail',function(){
    Mail::to('rajeev@neologicx.com')->send(new GeneratePassword('rahul.modi@neologicx.com','9024829041', '/'));
});

Route::get('/createmeeting',[TestController::class,'test']);
Route::get('/onmeeting',[TestController::class,'test1']);



Route::get('/notifications',InappNotifications::class)->middleware('auth')->name('notificationpage');

Route::get('/testsms',[TestController::class,'sendsms']);

Route::get('/testpaytm',[TestController::class,'paytmtest']);


Route::get('/exportseniorsales',[TestController::class,'seniorexport'])->name('seniorexport');

// Route::get('/importmodule',[TestController::class,'sendtemplate']);
// Route::post('/importmodule',[TestController::class,'submittemplate']);
Route::get('/importmodule',ImportModule::class);
Route::view('/old-testpay', 'old-testpay');




Route::view('/commontable','includes.leadtable');



Route::get('/leadgodmode',LeadGodMode::class);

Route::get('/localpayment',[PaytmController::class,'callbacklocal']);

Route::get('checknotification',function ()
{
    event(new App\Events\PushNotificationEvent(auth()->user()->id, "testing notification"));
    // $result = new \App\Events\PushNotificationEvent(auth()->user()->id, 'testing notification');
    return 'done';
})->middleware('auth');
