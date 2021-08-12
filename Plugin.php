<?php namespace Dimti\ListExtend;

use Backend;
use Dimti\ListExtend\Classes\Registration\BootExtensions;
use Dimti\ListExtend\Classes\Registration\ExtendListColumns;
use System\Classes\PluginBase;

/**
 * listextend Plugin Information File
 */
class Plugin extends PluginBase
{
    use BootExtensions;
    use ExtendListColumns;

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'switchcircle',
            'description' => 'No description provided yet...',
            'author'      => 'dimti',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        $this->registerExtensions();
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Dimti\Switchcircle\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'dimti.switchcircle.some_permission' => [
                'tab' => 'switchcircle',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'switchcircle' => [
                'label'       => 'switchcircle',
                'url'         => Backend::url('dimti/switchcircle/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['dimti.switchcircle.*'],
                'order'       => 500,
            ],
        ];
    }
}
