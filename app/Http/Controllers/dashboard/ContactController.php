<?php

namespace App\Http\Controllers;

use App\Helpers\CustomUrl;
use App\Contact;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['auth', 'rol.admin']);
    }
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(2);
        // select * from contacts

        return view('dashboard.contact.index',[
            'contacts' => $contacts
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //$contact = Contact::findOrFail($id);

        return view('dashboard.contact.show', ["contact" => $contact]);

    }


    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('status', 'Contact eliminado con éxito');

    }
}
