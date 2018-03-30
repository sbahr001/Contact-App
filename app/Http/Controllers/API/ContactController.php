<?php

namespace App\Http\Controllers\API;

use App\Contact;
use App\Http\Resources\ContactResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ContactResource::collection(
            Contact::where('user_id', Auth::id())->paginate()
        );
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
        $validator = Validator::make($request->input(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'sometimes|array',
            'photo' => 'sometimes|url',
            'addresses' => 'sometimes|array'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }

        $contact = new Contact($request->input());
        $contact->user = Auth::user();
        if (!$contact->save()) {
            return $this->errorResponse('Unable to save contact.');
        }

        return new ContactResource($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return new ContactResource($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
        $validator = Validator::make($request->input(), [
            'first_name' => 'sometimes|filled',
            'last_name' => 'sometimes|filled',
            'email' => 'sometimes|array',
            'photo' => 'sometimes|url',
            'addresses' => 'sometimes|array'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }

        $updated = $contact->update($request->input());

        if (!$updated) {
            return $this->errorResponse(['Unable to update contact.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
        if ($contact->delete()) {
            return $this->errorResponse(['Unable to delete contact']);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
