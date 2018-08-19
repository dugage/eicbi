<?php

namespace Modules\Referrals\Http\Controllers;

use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ReferralsController extends Controller
{
    private $paginate = 10;

    function __construct()
    {
        $this->paginate = 10;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if( request()->ajax() ) {

            $referrals = Referral::with('user')->paginate($this->paginate);
            return response()->json($referrals);

        }else{

            return view('referrals::index');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('referrals::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('referrals::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('referrals::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
    /**
     * looking for data from param
     * @return Response
     */
    public function search($query)
    {
        $referral = Referral::with('user')
        ->whereHas('user', function ($q) use ($query) {
            $q->where('name', 'LIKE', '%'.$query.'%');
        })
        ->paginate($this->paginate);
        return response()->json($referral);
    }
}
