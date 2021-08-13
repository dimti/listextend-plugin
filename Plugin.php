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
            'name'        => 'listextend',
            'description' => 'Additional backend list columns',
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
            'dimti.listextend.some_permission' => [
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
            'listextend' => [
                'label'       => 'listextend',
                'url'         => Backend::url('dimti/listextend/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['dimti.listextend.*'],
                'order'       => 500,
            ],
        ];
    }
}
