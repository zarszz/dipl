<?php

namespace App\Http\Controllers;

use App\Models\Ticketing;
use Illuminate\Http\Request;

class TicketingController extends Controller
{
    /**
     * Display a listing of the ticketing.
     *
     * @return DataTables
     */
    public function index()
    {
        $ticketings = auth()->user() ? Ticketing::all() : Ticketing::where('user_id', auth()->user()->id);
        return datatables()
            ->of($ticketings)
            ->addColumn('Actions', function ($data) {
                return '<a type="button" href="/dashboard/ticketing/' . $data->id . '/edit" class="btn btn-primary btn-sm">Update</a>' .
                    ' <button type="button" class="btn btn-danger btn-sm" id="deleteTicket" value="' . $data->id . '">Delete</button>';
            })
            ->addColumn('Status', function ($data) {
                $btnClass = auth()->user()->isAdmin() ? "btn btn-sm" : "btn btn-sm disabled";
                switch ($data->status) {
                    case 'pending':
                        return ' <button type="button" class="' . $btnClass . ' btn btn-warning" id="prosesTicket" value="' . $data->id . '">Pending</button>';
                        break;
                    case 'on_progress':
                        return ' <button type="button" class="' . $btnClass . ' btn btn-primary" id="prosesTicket" value="' . $data->id . '">On Progress</button>';
                        break;
                    default:
                        return ' <button type="button" class="' . $btnClass . ' btn btn-success" id="prosesTicket" value="' . $data->id . '">Finished</button>';
                        break;
                }
            })
            ->rawColumns(['Actions', 'Status'])
            ->make(true);
    }

    /**
     * Open create ticketing form
     *
     * @return View
     */
    public function create()
    {
        return view('ticketing.create');
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

        return redirect()->route('dashboard.ticketing');
    }

    /**
     * Open ticketing form
     *
     * @param  Integer  $id
     * @return View
     */
    public function edit($id)
    {
        $ticket = Ticketing::findOrFail($id);
        $this->authorize('update', $ticket);
        return view('ticketing.edit', ['ticket' => $ticket]);
    }

    /**
     * Update status the specified ticketing in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticketing  $ticketing
     * @return \Illuminate\Routing\Redirector
     */
    public function updateStatus(Request $request, $id)
    {
        $ticketing = Ticketing::findOrFail($id);
        $this->authorize('update', $ticketing);
        $request = $request->all();

        $ticketing->status = $request['status'];

        $ticketing->save();
        return response(['message' => 'success'], 200);
    }

        /**
     * Update the specified ticketing in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticketing  $ticketing
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $ticketing = Ticketing::findOrFail($id);
        $this->authorize('update', $ticketing);

        $ticketingData = $request->validate([
            'pesan' => 'required|max:255|min:10',
        ]);
        $ticketing->update($ticketingData);
        return redirect(route('dashboard.ticketing'));
    }

    /**
     * Remove the specified ticketing from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticketing  $ticketing
     * @return \Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        $ticket = Ticketing::findOrFail($id);
        $this->authorize('delete', $ticket);
        return $ticket->delete();
    }
}
