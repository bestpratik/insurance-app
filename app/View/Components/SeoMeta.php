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
    public $model;   // ✅ ADD THIS

    public function __construct($seo = null, $model = null)
    {
        $this->model = $model;   // ✅ ADD THIS

        if ($seo) {
            $this->seo = $seo;
            return;
        }

        if ($model) {
            $this->seo = Seo::where('ref_id', $model->id)
                ->where('page_type', strtolower(class_basename($model)))
                ->first();
            return;
        }

        $slug = trim(Request::path(), '/');

        if ($slug === '' || $slug === '/') {
            $slug = '/';
        }

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
