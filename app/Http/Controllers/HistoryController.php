<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\History;

use GeoSot\EnvEditor\EnvEditor;


class HistoryController extends Controller
{



    public function store(Request $request)
    {


        History::firstOrCreate([
            'user_id'=>auth()->id(),
            'amount'=>$request->NewAmount,
        ], [
            'user_id'=>auth()->id(),
            'amount'=>$request->NewAmount,
        ]);

    }

}
