<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class PrivacyController extends BaseController
{
    /**
     * Get privacy page.
     *
     * @return
     */
    public function showPage() {
        return view('privacy.privacy');
    }
}
