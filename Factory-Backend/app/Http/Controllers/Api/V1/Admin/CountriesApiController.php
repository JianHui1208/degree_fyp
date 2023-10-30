<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Exception;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;

/**
 * @title Country Control
 */
class CountriesApiController extends Controller
{
    /**
     * @title Get country
     * @description Token Verify.
     * @author 开发者
     * @url /countries
     * @method GET
     * 
     * @return status:true
     * @return MSG:Success
     * 
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('country_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::select('id', 'name')->where([
            'is_active' => 1,
        ])->get();

        return response()->json(['status' => TRUE, 'countries' => $countries]);
    }

    /**
     * @title Get country and mobile code
     * @description Token Verify.
     * @author 开发者
     * @url /countries/get_mobile_code
     * @method GET
     * 
     * @return status:true
     * @return MSG:Success
     * 
     */
    public function get_mobile_code()
    {

        try {

            $countries = Country::select('id', 'name', 'mobile_code')->where([
                'is_active' => 1
            ])->get();
        } catch (Exception $e) {
            return response()->json(['status' => false, 'MSG' => 'Something Error !']);
        }

        return response()->json(['status' => true, 'MSG' => 'Success', 'data' => $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
