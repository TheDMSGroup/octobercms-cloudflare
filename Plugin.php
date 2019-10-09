<?php namespace HeathDutton\Cloudflare;

use System\Classes\PluginBase;

/**
 * https Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Cloudflare',
            'description' => 'Puts October in HTTPS protocol correctly when behind the cloudflare reverse proxy.',
            'author'      => 'TheDMSGrp',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        /*
         * Event listen to disable Cloudflare's cache on backend.
         *
         */
        Event::listen('system.assets.modifyAttributes', function($attributes)
        {
            if (isset($attributes['cache']) && $attributes['cache'] == 'false') {
                $attributes['data-cfasync'] = 'false';
                unset($attributes['cache']);
            }
        });
    }

}
