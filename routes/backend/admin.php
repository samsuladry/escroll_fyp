<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RectorController;
use App\Http\Controllers\Backend\FacultyController;
use App\Http\Controllers\Backend\DeanController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\BachelorController;
use App\Http\Controllers\Backend\TemplateController;
use App\Http\Controllers\Backend\EscrollSetupController;
use App\Http\Controllers\Backend\ExcelTypoController;
use App\Http\Controllers\Backend\DigitalCertificateController;
use App\Http\Controllers\Backend\CsvController;
use App\Http\Controllers\Backend\EscrollController;
use App\Http\Controllers\Backend\UniversityController;
use App\Http\Controllers\Backend\BlockchainStudentController;
use App\Http\Controllers\Backend\MoeController;
use App\Http\Controllers\Backend\AcademicLevelController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/sign-pdf', [DashboardController::class, 'sign_pdf'])->name('sign-pdf');
Route::get('dashboard/test', [DashboardController::class, 'test']);
// Route::get('dashboard/test/activate', [FacultyController::class, 'sign_pdf']);

Route::get('academic', [AcademicLevelController::class, 'index'])->name('academic.index');
Route::post('academic', [AcademicLevelController::class, 'store'])->name('academic.store');
Route::get('academic/create', [AcademicLevelController::class, 'create'])->name('academic.create');
Route::post('academic/{academic_level}', [AcademicLevelController::class, 'update'])->name('academic.update');
Route::delete('academic/{academic_level}', [AcademicLevelController::class, 'destroy'])->name('academic.destroy');

Route::get('check', [ExcelTypoController::class, 'index'])->name('check.index');
Route::get('check/faculty/{faculty}', [ExcelTypoController::class, 'faculty'])->name('check.faculty');
Route::get('check/programme/{programme}', [ExcelTypoController::class, 'programme'])->name('check.programme');
Route::get('check/citizenship/{citizenship}', [ExcelTypoController::class, 'citizenship'])->name('check.citizenship');
Route::post('check/update/{id}', [ExcelTypoController::class, 'update'])->name('check.update');
Route::post('check/import/all', [ExcelTypoController::class, 'importAll'])->name('check.all.import');
Route::post('check/import/faculty/{faculty}', [ExcelTypoController::class, 'importFaculty'])->name('check.faculty.import');
Route::post('check/import/programme/{programme}', [ExcelTypoController::class, 'importProgramme'])->name('check.programme.import');
Route::post('check/import/citizenship/{citizenship}', [ExcelTypoController::class, 'importCitizenship'])->name('check.citizenship.import');

Route::get('rector', [RectorController::class, 'view_rector'])->name('view-rector');
Route::get('rector/add', [RectorController::class, 'add_rector'])->name('add-rector');
Route::post('rector/store', [RectorController::class, 'store_rector'])->name('store-rector');
Route::get('rector/{rector}/edit', [RectorController::class, 'edit_rector'])->name('edit-rector');
Route::put('rector/{rector}', [RectorController::class, 'update_rector'])->name('update-rector');
Route::post('rector/{rector}/activate', [RectorController::class, 'activate_rector'])->name('activate-rector');

Route::get('faculty', [FacultyController::class, 'view_faculty'])->name('view-faculty');
Route::get('faculty/add', [FacultyController::class, 'add_faculty'])->name('add-faculty');
Route::post('faculty/store', [FacultyController::class, 'store_faculty'])->name('store-faculty');
Route::get('faculty/{faculty}/edit', [FacultyController::class, 'edit_faculty'])->name('edit-faculty');
Route::put('faculty/{faculty}', [FacultyController::class, 'update_faculty'])->name('update-faculty');
Route::get('faculty/{faculty}/graduate', [FacultyController::class, 'view_faculty_graduate'])->name('view-faculty-graduate');
Route::post('faculty/{faculty}/graduate/activate', [FacultyController::class, 'activate_faculty_graduate'])->name('activate-faculty-graduate');

Route::get('faculty/{faculty}/dean', [DeanController::class, 'view_dean'])->name('view-dean');
Route::get('faculty/{faculty}/dean/add', [DeanController::class, 'add_dean'])->name('add-dean');
Route::post('faculty/{faculty}/dean/store', [DeanController::class, 'store_dean'])->name('store-dean');
Route::get('faculty/{faculty}/dean/{dean}/edit', [DeanController::class, 'edit_dean'])->name('edit-dean');
Route::put('faculty/{faculty}/dean/{dean}', [DeanController::class, 'update_dean'])->name('update-dean');
Route::post('faculty/{faculty}/dean/{dean}/activate', [DeanController::class, 'activate_dean'])->name('activate-dean');

Route::get('faculty/{faculty}/department', [DepartmentController::class, 'index'])->name('view-department');
Route::get('faculty/{faculty}/department/add', [DepartmentController::class, 'add_department'])->name('add-department');
Route::post('faculty/{faculty}/department/store', [DepartmentController::class, 'store_department'])->name('store-department');
Route::get('faculty/{faculty}/department/{department}/edit', [DepartmentController::class, 'edit_department'])->name('edit-department');
Route::put('faculty/{faculty}/department/{department}', [DepartmentController::class, 'update_department'])->name('update-department');
Route::get('faculty/{faculty}/department/{department}/graduate', [DepartmentController::class, 'view_department_graduate'])->name('view-department-graduate');


Route::get('faculty/{faculty}/department/{department}/bachelor', [BachelorController::class, 'view_bachelor'])->name('view-bachelor');
Route::get('faculty/{faculty}/department/{department}/bachelor/add', [BachelorController::class, 'add_bachelor'])->name('add-bachelor');
Route::post('faculty/{faculty}/department/{department}/bachelor/store', [BachelorController::class, 'store_bachelor'])->name('store-bachelor');
Route::get('faculty/{faculty}/department/{department}/bachelor/{bachelor}/edit', [BachelorController::class, 'edit_bachelor'])->name('edit-bachelor');
Route::put('faculty/{faculty}/department/{department}/bachelor/{bachelor}', [BachelorController::class, 'update_bachelor'])->name('update-bachelor');


Route::get('template', [TemplateController::class, 'view_template'])->name('view-template');
Route::get('template/add', [TemplateController::class, 'add_template'])->name('add-template');
Route::post('template/store', [TemplateController::class, 'store_template'])->name('store-template');
Route::put('template/{template}', [TemplateController::class, 'update_template'])->name('update-template');
Route::post('template/{template}/activate', [TemplateController::class, 'activate_template'])->name('activate-template');
Route::get('template/{template}/edit', [EscrollSetupController::class, 'edit'])->name('edit-escroll'); //change to escrollsetup
Route::put('template/{template}/escroll', [EscrollSetupController::class, 'update'])->name('update-escroll');
Route::get('template/{template}/escroll', [TemplateController::class, 'view_escroll'])->name('view-escroll');
Route::get('escroll/{template}/download', [TemplateController::class, 'download_escroll'])->name('download-escroll');

Route::get('escroll', [EscrollController::class, 'index'])->name('escroll.index');
Route::post('escroll/total-students', [EscrollController::class, 'getTotalStudents'])->name('escroll.total-students'); // 1st
Route::post('escroll/check-percentage', [EscrollController::class, 'check_percentage'])->name('escroll.check-percentage');
Route::post('escroll/generate', [EscrollController::class, 'generate'])->name('escroll.generate');
Route::post('escroll/download-zip', [EscrollController::class, 'download_zip'])->name('escroll.download-zip');
Route::post('import-csv/store', [CsvController::class, 'store_csv'])->name('store-csv');
Route::get('import-csv', [CsvController::class, 'import_csv'])->name('import-csv');

Route::get('gradute-student', [DashboardController::class, 'graduate_student'])->name('graduate-student');
Route::get('gradute-student/{student}/view-cert', [DashboardController::class, 'view_cert'])->name('view-cert');
Route::get('university', [UniversityController::class, 'university'])->name('university');
Route::get('university/{university}/list-college/{college}/graduate-student/{student}/view-cert-pdf', 
	[UniversityController::class, 'view_cert_pdf'])->name('view-cert-pdf');

// Route::get('digital_certificate', [DigitalCertificateController::class, 'digital_certificate']);
// Route::get('digital_certificate/add', [DigitalCertificateController::class, 'digital_certificate_add']);
// Route::post('digital_certificate/store', [DigitalCertificateController::class, 'digital_certificate_store']);



Route::get('blockchainstudent', [BlockchainStudentController::class, 'index'])->name('index');
Route::post('blockchainstudent/store', [BlockchainStudentController::class, 'store'])->name('store');
Route::get('student', [BlockchainStudentController::class, 'getStudents']);
Route::post('student', [BlockchainStudentController::class, 'setStudentImport']);

Route::get('moe', [MoeController::class, 'index'])->name('moe');
Route::get('moe/registration', [MoeController::class, 'registration'])->name('moe.registration');
Route::get('moe/blockExplorer', [MoeController::class, 'blockExplorer'])->name('moe.block.explorer');
Route::get('moe/dataSummary', [MoeController::class, 'dataSummary'])->name('moe.data.summary');


