<?php 

class DashboardController extends BaseController
{
    protected function loadModels() {}

    public function dashboard() {
        $this->viewApp->requestView('dashboard');
    }
}