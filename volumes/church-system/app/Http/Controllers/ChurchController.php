<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChurchResource;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Church;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Can;

class ChurchController extends Controller
{
    /**
     * Display the index page for the ChurchController.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        
        $churches = ChurchResource::collection(Church::with(['users' => function ($query) {
            $query->wherePivot('role', 'Pastor-Presidente');
        }])->paginate(5));

        return inertia('Churchs/Index', [
            'churchs' => $churches
        ]);
    }

    /**
     * Display the create page for the ChurchController.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        

        return inertia('Churchs/Create',[
            'user' => Auth::user(),
        ]);
    }

    /**
     * Display the edit page for the ChurchController.
     *
     * @return \Inertia\Response
     */
    public function edit(): Response
    {
        return inertia('Churchs/Edit');
    }
}
