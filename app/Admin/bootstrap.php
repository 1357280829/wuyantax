<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use Encore\Admin\Admin;
use Encore\Admin\Form;
use App\Admin\Extensions\WangEditor;
use Encore\Admin\Grid;

Form::forget(['map', 'editor']);

Form::extend('editor', WangEditor::class);

Form::init(function (Form $form) {
    $form->disableViewCheck();
    $form->tools(function (Form\Tools $tools) {
        $tools->disableView();
    });
});

Grid::init(function (Grid $grid) {
    $grid->disableColumnSelector();
    $grid->actions(function (Grid\Displayers\Actions $actions) {
        $actions->disableView();
    });
});

//  修改 footer
$footerName = config('admin.footer-name');
$script = <<<EOT

setTimeout(()=>{
    var tag = document.getElementsByClassName('main-footer')[0];
    tag.innerHTML = "<strong>{$footerName}</strong>";
},0);

EOT;

Admin::script($script);