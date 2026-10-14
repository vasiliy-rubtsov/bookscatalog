<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('photo')) {
            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/clients'), $photoName);
            $validated['photo'] = $photoName;
        }

        Client::create($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Клиент успешно создан.');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('photo')) {
            // Удаляем старую фотографию
            if ($client->photo && File::exists(public_path('uploads/clients/' . $client->photo))) {
                File::delete(public_path('uploads/clients/' . $client->photo));
            }

            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/clients'), $photoName);
            $validated['photo'] = $photoName;
        }

        $client->update($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Клиент успешно обновлён.');
    }

    public function destroy(Client $client)
    {
        if ($client->photo && File::exists(public_path('uploads/clients/' . $client->photo))) {
            File::delete(public_path('uploads/clients/' . $client->photo));
        }

        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Клиент успешно удалён.');
    }
}
