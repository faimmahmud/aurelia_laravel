<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [

            // Branding
            [
                'group' => 'branding',
                'key' => 'branding.site_name',
                'value' => 'Aurelia Travel',
                'type' => 'text',
            ],
            [
                'group' => 'branding',
                'key' => 'branding.tagline',
                'value' => 'Luxury Travel & Tourism',
                'type' => 'text',
            ],
            [
                'group' => 'branding',
                'key' => 'branding.logo',
                'value' => '',
                'type' => 'image',
            ],
            [
                'group' => 'branding',
                'key' => 'branding.dark_logo',
                'value' => '',
                'type' => 'image',
            ],
            [
                'group' => 'branding',
                'key' => 'branding.favicon',
                'value' => '',
                'type' => 'image',
            ],

            // Contact
            [
                'group' => 'contact',
                'key' => 'contact.email',
                'value' => 'info@aureliatravel.com',
                'type' => 'email',
            ],
            [
                'group' => 'contact',
                'key' => 'contact.phone',
                'value' => '',
                'type' => 'text',
            ],
            [
                'group' => 'contact',
                'key' => 'contact.whatsapp',
                'value' => '',
                'type' => 'text',
            ],

            // Social
            [
                'group' => 'social',
                'key' => 'social.facebook',
                'value' => '',
                'type' => 'url',
            ],
            [
                'group' => 'social',
                'key' => 'social.instagram',
                'value' => '',
                'type' => 'url',
            ],
            [
                'group' => 'social',
                'key' => 'social.linkedin',
                'value' => '',
                'type' => 'url',
            ],
            [
                'group' => 'social',
                'key' => 'social.youtube',
                'value' => '',
                'type' => 'url',
            ],

            // Policies
            [
                'group' => 'policy',
                'key' => 'policy.about',
                'value' => '',
                'type' => 'html',
            ],
            [
                'group' => 'policy',
                'key' => 'policy.terms',
                'value' => '',
                'type' => 'html',
            ],
            [
                'group' => 'policy',
                'key' => 'policy.privacy',
                'value' => '',
                'type' => 'html',
            ],

            // Footer
            [
                'group' => 'footer',
                'key' => 'footer.copyright',
                'value' => '© Aurelia Travel. All Rights Reserved.',
                'type' => 'text',
            ],
        ];

        foreach ($settings as $setting) {

            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'group' => $setting['group'],
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                    'autoload' => true,
                ]
            );
        }
    }
}
