<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    // Get all events, including trashed ones (soft deletes)
    public function getEvents()
    {
        return response()->json(Event::withTrashed()->get());
    }

    // Show a specific event by ID (including trashed ones)
    public function getEvent($id)
    {
        $event = Event::withTrashed()->find($id);

        if ($event) {
            return response()->json($event);
        }

        return response()->json(['message' => 'Event not found'], 404);
    }

    // Store a new event
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $event = Event::create($request->all());

        return response()->json($event, 201); // Return the created event with a 201 status
    }

    // Update an existing event
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $event->update($request->all());

        return response()->json($event);
    }

    // Soft delete an event
    public function destroy($id)
    {
        $event = Event::find($id);

        if ($event) {
            $event->delete();
            return response()->json(['message' => 'Event deleted successfully']);
        }

        return response()->json(['message' => 'Event not found'], 404);
    }

    // Get all trashed events
    public function getArchivedEvents()
    {
        $events = Event::onlyTrashed()->get();
        return response()->json($events);
    }

    // Restore a soft-deleted event
    public function restore($id)
    {
        $event = Event::onlyTrashed()->find($id);

        if ($event) {
            $event->restore();
            return response()->json(['message' => 'Event restored successfully']);
        }

        return response()->json(['message' => 'Event not found'], 404);
    }

    // Permanently delete a soft-deleted event
    public function forceDelete($id)
    {
        $event = Event::onlyTrashed()->find($id);

        if ($event) {
            $event->forceDelete();
            return response()->json(['message' => 'Event permanently deleted']);
        }

        return response()->json(['message' => 'Event not found'], 404);
    }
}
