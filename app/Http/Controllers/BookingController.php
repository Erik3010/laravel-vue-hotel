<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use App\User;
use App\BookingDetails;
use App\HotelRoom;
use App\Guest;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();
        
        // insert to Bookings table
        // $user_id = User::where('api_token', $request->token)->first()->id;

        // $bookingData = [
        //     'user_id' => $user_id,
        //     'price' => $request->bookingData['room_price'],
        //     'payment_method' => $request->payment['payment_method'],
        //     'card_number' => $request->payment['card_number'],
        //     'name_on_card' => $request->payment['name_on_card'],
        //     'ccv_code' => $request->payment['ccv_code']
        // ];

        // $bookingCreated = Booking::create($bookingData);

        // insert to BookingDetails table
        // $bookingId = $bookingCreated->id;

        // $bookingDetails = [
        //     'booking_id' => $bookingId,
        //     'hotel_id' => $request->bookingData['hotel_id'],
        //     'check_in' => $request->search_data['check_in_pure'],
        //     'check_out' => $request->search_data['check_out_pure'],
        //     'num_rooms' => $request->search_data['room'],
        //     'room_id' => $request->bookingData['room_id']
        // ];

        // $detailsCreated = BookingDetails::create($bookingDetails);

        // update room status, eheck in, check out
        // $room_id = $request->bookingData['room_id'];

        // $room = HotelRoom::findOrFail($room_id);
        
        // $room->update([
        //     'status' => 1,
        //     'check_in' => $request->search_data['check_in_pure'],
        //     'check_out' => $request->search_data['check_out_pure']
        // ]);

        // insert guest to database
        // $guests = $request->guest;
        // $guestTitle = $guests['title'];
        // $guestFirstName = $guests['first_name'];
        // $guestLastName = $guests['last_name']; 

        // $count = count($guestTitle);

        // $guestData = [];
        // for($i=0;$i<$count;$i++) {
        //     Guest::create([
        //         'title' => $guestTitle[$i],
        //         'first_name' => $guestFirstName[$i],
        //         'last_name' => $guestLastName[$i],
        //         'booking_id' => $bookingId
        //     ]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
