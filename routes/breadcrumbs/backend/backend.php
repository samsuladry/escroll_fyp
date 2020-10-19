<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

Breadcrumbs::for('admin.import-csv', function ($trail) {
    $trail->push(__('Import csv'), route('admin.import-csv'));
});

Breadcrumbs::for('admin.graduate-student', function ($trail) {
    $trail->push(__('Graduate student'), route('admin.graduate-student'));
});

Breadcrumbs::for('admin.university', function ($trail) {
    $trail->push(__('University'), route('admin.university'));
});

Breadcrumbs::for('admin.university-profile', function ($trail) {
    $trail->push(__('University Profile'), route('admin.university-profile'));
});

Breadcrumbs::for('admin.all-college', function ($trail) {
    $trail->push(__('All College'), route('admin.all-college'));
});

Breadcrumbs::for('admin.qr-code', function ($trail) {
    $trail->push(__('Qr Code'), route('admin.qr-code'));
});

Breadcrumbs::for('admin.generate-qr-code', function ($trail) {
    $trail->push(__('Generate Qr Code'), route('admin.generate-qr-code'));
});

Breadcrumbs::for('admin.list-college', function ($trail, $university) {
	$trail->parent('admin.university');
    $trail->push(__('List College'), route('admin.list-college',$university->id));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';

