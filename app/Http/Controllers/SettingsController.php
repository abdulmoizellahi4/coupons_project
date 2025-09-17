<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    /**
     * Display settings page
     */
    public function index()
    {
        $brandingSettings = Setting::group('branding')->get();
        $contactSettings = Setting::group('contact')->get();
        $socialSettings = Setting::group('social')->get();
        $generalSettings = Setting::group('general')->get();
        
        return view('admin.settings.index', compact('brandingSettings', 'contactSettings', 'socialSettings', 'generalSettings'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024'
        ]);

        // Handle file uploads and removals
        if ($request->hasFile('site_logo')) {
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $logoPath);
        } elseif ($request->has('remove_site_logo')) {
            Setting::set('site_logo', '');
        }

        if ($request->hasFile('site_favicon')) {
            $faviconPath = $request->file('site_favicon')->store('settings', 'public');
            Setting::set('site_favicon', $faviconPath);
        } elseif ($request->has('remove_site_favicon')) {
            Setting::set('site_favicon', '');
        }

        // Update other settings
        foreach ($request->settings as $key => $value) {
            // Skip logo and favicon as they're handled above
            if (!in_array($key, ['site_logo', 'site_favicon'])) {
                Setting::set($key, $value);
            }
        }

        return back()->with('success', 'Settings updated successfully!');
    }

    /**
     * Generate dynamic CSS for color variables
     */
    public function generateColorCss()
    {
        $brandingSettings = \App\Helpers\SettingsHelper::getBranding();
        
        $css = ":root {\n";
        $css .= "    --primary-color: {$brandingSettings['primary_color']};\n";
        $css .= "    --secondary-color: {$brandingSettings['secondary_color']};\n";
        $css .= "    --background-primary-color: {$brandingSettings['background_primary_color']};\n";
        $css .= "    --background-secondary-color: {$brandingSettings['background_secondary_color']};\n";
        $css .= "    --text-color: {$brandingSettings['text_color']};\n";
        $css .= "}\n\n";
        
        // Add utility classes
        $css .= ".primary-color { color: var(--primary-color) !important; }\n";
        $css .= ".secondary-color { color: var(--secondary-color) !important; }\n";
        $css .= ".bg-primary-color { background-color: var(--background-primary-color) !important; }\n";
        $css .= ".bg-secondary-color { background-color: var(--background-secondary-color) !important; }\n";
        $css .= ".text-color { color: var(--text-color) !important; }\n";
        
        return response($css)
            ->header('Content-Type', 'text/css')
            ->header('Cache-Control', 'public, max-age=3600');
    }

    /**
     * Reset settings to default
     */
    public function reset()
    {
        // Delete all current settings
        Setting::truncate();
        
        // Run seeder to restore defaults
        $this->seedDefaultSettings();

        return back()->with('success', 'Settings reset to default values!');
    }

    /**
     * Seed default settings
     */
    private function seedDefaultSettings()
    {
        $defaultSettings = [
            // Branding Settings
            ['key' => 'site_name', 'value' => 'Big Saving Hub', 'type' => 'text', 'group' => 'branding', 'label' => 'Site Name', 'description' => 'The name of your website', 'sort_order' => 1],
            ['key' => 'site_tagline', 'value' => 'Save More, Shop Smart', 'type' => 'text', 'group' => 'branding', 'label' => 'Site Tagline', 'description' => 'A short tagline for your website', 'sort_order' => 2],
            ['key' => 'site_logo', 'value' => '', 'type' => 'image', 'group' => 'branding', 'label' => 'Site Logo', 'description' => 'Upload your site logo', 'sort_order' => 3],
            ['key' => 'site_favicon', 'value' => '', 'type' => 'image', 'group' => 'branding', 'label' => 'Site Favicon', 'description' => 'Upload your site favicon', 'sort_order' => 4],
            ['key' => 'primary_color', 'value' => '#FF0000', 'type' => 'text', 'group' => 'branding', 'label' => 'Primary Color', 'description' => 'Main color for your brand', 'sort_order' => 5],
            ['key' => 'secondary_color', 'value' => '#000000', 'type' => 'text', 'group' => 'branding', 'label' => 'Secondary Color', 'description' => 'Secondary color for your brand', 'sort_order' => 6],
            ['key' => 'background_primary_color', 'value' => '#FFFFFF', 'type' => 'text', 'group' => 'branding', 'label' => 'Background Primary Color', 'description' => 'Main background color', 'sort_order' => 7],
            ['key' => 'background_secondary_color', 'value' => '#F8F9FA', 'type' => 'text', 'group' => 'branding', 'label' => 'Background Secondary Color', 'description' => 'Secondary background color', 'sort_order' => 8],
            ['key' => 'text_color', 'value' => '#333333', 'type' => 'text', 'group' => 'branding', 'label' => 'Text Color', 'description' => 'Main text color', 'sort_order' => 9],

            // Contact Settings
            ['key' => 'contact_email', 'value' => 'support@bighsavinghub.com', 'type' => 'email', 'group' => 'contact', 'label' => 'Contact Email', 'description' => 'Main contact email address', 'sort_order' => 1],
            ['key' => 'contact_phone', 'value' => '+44 20 7946 0958', 'type' => 'phone', 'group' => 'contact', 'label' => 'Contact Phone', 'description' => 'Main contact phone number', 'sort_order' => 2],
            ['key' => 'contact_address', 'value' => '123 Business Street, London, UK SW1A 1AA', 'type' => 'textarea', 'group' => 'contact', 'label' => 'Contact Address', 'description' => 'Physical address of your business', 'sort_order' => 3],
            ['key' => 'business_hours', 'value' => 'Mon-Fri: 9AM-6PM GMT', 'type' => 'text', 'group' => 'contact', 'label' => 'Business Hours', 'description' => 'Your business operating hours', 'sort_order' => 4],
            ['key' => 'support_email', 'value' => 'support@bighsavinghub.com', 'type' => 'email', 'group' => 'contact', 'label' => 'Support Email', 'description' => 'Customer support email', 'sort_order' => 5],
            ['key' => 'partnership_email', 'value' => 'partnerships@bighsavinghub.com', 'type' => 'email', 'group' => 'contact', 'label' => 'Partnership Email', 'description' => 'Partnership inquiries email', 'sort_order' => 6],

            // Social Media Settings
            ['key' => 'facebook_url', 'value' => '', 'type' => 'url', 'group' => 'social', 'label' => 'Facebook URL', 'description' => 'Your Facebook page URL', 'sort_order' => 1],
            ['key' => 'twitter_url', 'value' => '', 'type' => 'url', 'group' => 'social', 'label' => 'Twitter URL', 'description' => 'Your Twitter profile URL', 'sort_order' => 2],
            ['key' => 'instagram_url', 'value' => '', 'type' => 'url', 'group' => 'social', 'label' => 'Instagram URL', 'description' => 'Your Instagram profile URL', 'sort_order' => 3],
            ['key' => 'linkedin_url', 'value' => '', 'type' => 'url', 'group' => 'social', 'label' => 'LinkedIn URL', 'description' => 'Your LinkedIn profile URL', 'sort_order' => 4],
            ['key' => 'youtube_url', 'value' => '', 'type' => 'url', 'group' => 'social', 'label' => 'YouTube URL', 'description' => 'Your YouTube channel URL', 'sort_order' => 5],
            ['key' => 'tiktok_url', 'value' => '', 'type' => 'url', 'group' => 'social', 'label' => 'TikTok URL', 'description' => 'Your TikTok profile URL', 'sort_order' => 6],

            // General Settings
            ['key' => 'site_description', 'value' => 'Find the best discount codes and deals for your favorite stores. Save money on every purchase with Big Saving Hub.', 'type' => 'textarea', 'group' => 'general', 'label' => 'Site Description', 'description' => 'SEO description for your website', 'sort_order' => 1],
            ['key' => 'site_keywords', 'value' => 'discount codes, coupons, deals, savings, shopping', 'type' => 'text', 'group' => 'general', 'label' => 'Site Keywords', 'description' => 'SEO keywords for your website', 'sort_order' => 2],
            ['key' => 'timezone', 'value' => 'Europe/London', 'type' => 'text', 'group' => 'general', 'label' => 'Timezone', 'description' => 'Default timezone for your website', 'sort_order' => 3],
            ['key' => 'currency', 'value' => 'GBP', 'type' => 'text', 'group' => 'general', 'label' => 'Currency', 'description' => 'Default currency for your website', 'sort_order' => 4],
            ['key' => 'items_per_page', 'value' => '20', 'type' => 'text', 'group' => 'general', 'label' => 'Items Per Page', 'description' => 'Number of items to show per page', 'sort_order' => 5],
        ];

        foreach ($defaultSettings as $setting) {
            Setting::create($setting);
        }
    }
}
