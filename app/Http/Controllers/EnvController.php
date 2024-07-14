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

use GeoSot\EnvEditor\EnvEditor;


class EnvController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request, EnvEditor $editor)
    {

          $envValues = $editor->getEnvFileContent($fileName='../../.env');



        return Inertia::render('EnvEditor/Index', [
            'envValues' => $envValues,
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }



    public function create(Request $request, )
    {

        return Inertia::render('EnvEditor/Edit', [
             'envKey' =>null,
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }


    /**
     * Display the user's profile form.
     */
    public function store(Request $request, EnvEditor $editor)
    {

        if( !$editor->keyExists($request->key) && $request->value ){

            $editor->addKey($request->key, $request->value,   $options = []);

        } else {

            abort(404);
        }

        return Redirect::route('env-editor.index');
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, EnvEditor $editor)
    {


        if(! $editor->keyExists($request->key)){

            abort(404);
        }

        return Inertia::render('EnvEditor/Edit', [
             'envKey' => $request->key,
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, EnvEditor $editor) #: RedirectResponse
    {

        if($request->value &&  $request->key){

            $editor->editKey($request->key,$request->value);
        }

        return Redirect::route('env-editor.index');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request,  EnvEditor $editor): RedirectResponse
    {


        if(! $editor->keyExists($request->key)){

            abort(404);
        }

        $editor->deleteKey($request->key);

        return Redirect::route('env-editor.index');

    }
}
