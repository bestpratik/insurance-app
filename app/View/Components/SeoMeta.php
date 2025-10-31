<?php

namespace App\View\Components;

use App\Models\Seo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class SeoMeta extends Component
{
    /**
     * Create a new component instance.
     */

    public $seo;

    public function __construct()
    {
        // Get the current slug dynamically
        $slug = trim(Request::path(), '/');

        // For homepage
        if ($slug === '' || $slug === '/') {
            $slug = '/';
        }

        // Try to find SEO record
        $this->seo = Seo::where('page_slug', $slug)->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.seo-meta');
    }
}
