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
        $ticketings = Ticketing::all();
        return view('ticketings.index', compact('ticketings'));
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
            'pesan' => 'required|max:255|min:10',
        ]);
        $newTicketing['user_id'] = auth()->id();

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
            'pesan' => 'required|max:255|min:10',
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

        $request->validate(['id' => 'required']);

        if ($request->get('id') == $ticketing->id && $ticketing->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('ticketings.index', $routeParam);
        }

        return back();
    }
}
