<?php

namespace App\Http\Controllers;

use App\Models\RegistrationButton;
use Illuminate\Http\Request;

class RegistrationButtonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all registration button statuses
        $registrationButtons = RegistrationButton::all();
        return response()->json($registrationButtons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $registrationButton = RegistrationButton::create([
            'status' => $request->status,
        ]);

        return response()->json($registrationButton, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\RegistrationButton $registrationButton
     * @return \Illuminate\Http\Response
     */
    public function show(RegistrationButton $registrationButton)
    {
        return response()->json($registrationButton);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\RegistrationButton $registrationButton
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistrationButton $registrationButton)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $registrationButton->status = $request->status;
        $registrationButton->save();

        return response()->json($registrationButton);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\RegistrationButton $registrationButton
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistrationButton $registrationButton)
    {
        $registrationButton->delete();
        return response()->json(null, 204);
    }
}
