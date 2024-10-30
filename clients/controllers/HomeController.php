<?php 

class HomeController extends BaseController
{
    protected function loadModels() {}

    public function index() {
        $this->viewApp->requestView('index');
    }
}