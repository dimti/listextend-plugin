<?php namespace Dimti\ListExtend\Classes\Registration;

use Backend\Classes\Controller;
use Dimti\ListExtend\Behaviors\SwitchcircleController;

trait BootExtensions
{
    protected function registerExtensions()
    {
        $this->extendBackendController();
    }

    private function extendBackendController()
    {
        Controller::extend(function (Controller $controller) {
            if (post('type') == 'switchcircle' && !$controller->isClassExtendedWith(SwitchcircleController::class)) {
                $controller->extendClassWith(SwitchcircleController::class);
            }
        });
    }
}
