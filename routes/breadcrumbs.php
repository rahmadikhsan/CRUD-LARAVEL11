<?php

// routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Food;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('user.dashboard'));
});

// Food
Breadcrumbs::for('food', function (BreadcrumbTrail $trail) {
    $trail->push('Food', route('foods.index'));
});

// Food > [Category]
Breadcrumbs::for('detailfood', function (BreadcrumbTrail $trail, Food $food) {
    $trail->parent('food');
    $trail->push($food->name, route('foods.edit', $food));
});
