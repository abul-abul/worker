<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class TermsController extends BaseController
{
    /**
     * Get terms page.
     *
     * @return
     */
    public function showPage() {
        return view('terms.terms');
    }
}
