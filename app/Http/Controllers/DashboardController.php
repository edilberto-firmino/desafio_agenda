<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return Inertia::render('Dashboard', ['contacts' => $contacts]);
    }

    public function create()
    {
        return Inertia::render('Contacts/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:contacts',
            'phone' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:2048', 
        ]);

        $requestData = $request->all();
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public');
            $requestData['foto'] = $fotoPath;
        }

        Contact::create($requestData);

        return redirect()->route('dashboard');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return Inertia::render('Contacts/Show', ['contact' => $contact]);
    }

    public function edit(Contact $contact)
    {
        return Inertia::render('Contacts/Edit', ['contact' => $contact]);
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:contacts,email,' . $contact->id,
            'phone' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:2048', 
        ]);

        $requestData = $request->all();
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public');
            $requestData['foto'] = $fotoPath;
        }

        $contact->update($requestData);

        return redirect()->route('dashboard');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('dashboard');
    }
}