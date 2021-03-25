<?php

namespace App\Http\Controllers;

use App\Models\Ticketing;
use Illuminate\Http\Request;

class TicketingController extends Controller
{
    /**
     * Display a listing of the ticketing.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $editableTicketing = null;
        $ticketingQuery = Ticketing::query();
        $ticketingQuery->where('title', 'like', '%'.$request->get('q').'%');
        $ticketingQuery->orderBy('title');
        $ticketings = $ticketingQuery->paginate(25);

        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $editableTicketing = Ticketing::find(request('id'));
        }

        return view('ticketings.index', compact('ticketings', 'editableTicketing'));
    }

    /**
     * Store a newly created ticketing in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Ticketing);

        $newTicketing = $request->validate([
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newTicketing['creator_id'] = auth()->id();

        Ticketing::create($newTicketing);

        return redirect()->route('ticketings.index');
    }

    /**
     * Update the specified ticketing in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticketing  $ticketing
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Ticketing $ticketing)
    {
        $this->authorize('update', $ticketing);

        $ticketingData = $request->validate([
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $ticketing->update($ticketingData);

        $routeParam = request()->only('page', 'q');

        return redirect()->route('ticketings.index', $routeParam);
    }

    /**
     * Remove the specified ticketing from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticketing  $ticketing
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Ticketing $ticketing)
    {
        $this->authorize('delete', $ticketing);

        $request->validate(['ticketing_id' => 'required']);

        if ($request->get('ticketing_id') == $ticketing->id && $ticketing->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('ticketings.index', $routeParam);
        }

        return back();
    }
}
