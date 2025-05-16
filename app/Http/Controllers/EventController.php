<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Libraries\RequestLibrary;



class EventController extends Controller
{
    
    public function getEventsJson()
    {
        return response()->json(Event::all());
    }
    
    public function index()
    {
        $events = Event::withTrashed()->get();
        return view('events.index', compact('events'));
        $posts = (new RequestLibrary)->getData('posts', 'post');

    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Événement ajouté avec succès!');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Événement mis à jour!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Événement supprimé!');
    }
    public function archive()
    {
        $events = event::onlyTrashed()->get();
        return view('events.archive', compact('events'));
    }

   

    public function restore($id)
    {
        $event = Event::onlyTrashed()->find($id);
        if ($event) {
            $event->restore();
            return redirect()->route('events.index')->with('success', 'Événement restauré!');
        }
        return redirect()->route('events.index')->with('error', 'Événement non trouvé!');
    }

    public function forceDelete($id)
    {
        $event = Event::onlyTrashed()->find($id);
        if ($event) {
            $event->forceDelete();
            return redirect()->route('events.index')->with('success', 'Événement supprimé définitivement!');
        }
        return redirect()->route('events.index')->with('error', 'Événement non trouvé!');
    }
}
