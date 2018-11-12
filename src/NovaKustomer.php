<?php

namespace Mydnic\NovaKustomer;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaKustomer extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-kustomer', __DIR__.'/../dist/js/tool.js');
        Nova::style('nova-kustomer', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('nova-kustomer::navigation');
    }
}
