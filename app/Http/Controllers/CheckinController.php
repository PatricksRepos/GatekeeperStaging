<?php

  namespace App\Http\Controllers;

  use App\Http\Resources\TicketResource;
  use App\Models\Checkin;
  use App\Http\Requests\StoreCheckinRequest;
  use App\Http\Requests\UpdateCheckinRequest;
  use App\Models\Event;
  use App\Models\Ticket;
  use Illuminate\Http\JsonResponse;
  use Illuminate\Support\Facades\Auth;
  use Ramsey\Uuid\Uuid;

  class CheckinController extends Controller
  {
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCheckinRequest $request, string $event_uuid): JsonResponse
    {
      $args = $request->validated();

      $event = Event::where('uuid', $event_uuid)
        ->firstOrFail();

      $ticket = Ticket::where('event_id', $event->id)
        ->where('ticket_nonce', Uuid::fromString($args['ticket_code'])->getBytes())
        ->where('asset_id', $args['asset_id'])
        ->withCount(['checkins', 'checkouts'])
        ->firstOrFail();

      if ($ticket->checkins_count !== $ticket->checkouts_count) {
        // Ticket is already checked in, returning 400 error as per expectations.
        return response()->json([
          'message' => 'Ticket has already been checked in!'
        ], 400); // changed from 401 to 400 as per the typical error code for bad requests
      }

      // Safe to insert the check-in record
      $checkin = new Checkin();
      $checkin->ticket()->associate($ticket);
      $checkin->user()->associate(Auth::user());
      $checkin->save();

      // Return the checkin data in the response
      return response()->json($checkin, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Checkin $checkin)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCheckinRequest $request, Checkin $checkin)
    {
      //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkin $checkin)
    {
      //
    }
  }
