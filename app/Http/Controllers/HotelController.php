<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotelDetail = Hotel::where('hotels.id', $id)
                        ->join('hotel_rooms', 'hotels.id', '=', 'hotel_rooms.hotel_id')
                        ->orderBy('hotel_rooms.price', 'asc')
                        ->first();

        // return $hotelDetail;
        $hotel = Hotel::join('hotel_rooms', 'hotels.id', '=', 'hotel_rooms.hotel_id')
                    ->where([
                        'hotels.id' => $id,
                        'hotel_rooms.status' => 0
                    ])
                    ->get();

        // return $hotel;
        return response()->json([
            'message' => 'Success', 
            'data' => $hotel,
            'hotel_detail' => $hotelDetail
        ], 200);
    }

    public function show2($hotelId, $roomId) {
        $hotel = Hotel::find($hotelId);

        $room = $hotel->HotelRoom()->where('id', $roomId)->first();

        $data = [
            'hotel_id' => $hotel->id,
            'hotel_name' => $hotel->name,
            'location' => $hotel->location,
            'rating' => $hotel->rating,
            'hotel_capacity' => $hotel->capacity,
            'room_id' => $room->id,
            'room_hotel_id' => $room->hotel_id,
            'room_type' => $room->type,
            'room_status' => $room->status,
            'room_price' => $room->price
        ];

        // foreach($rooms as $room) {
        //     $data[] = [
        //         'hotel_id' => $hotel->id,
        //         'hotel_name' => $hotel->name,
        //         'location' => $hotel->location,
        //         'rating' => $hotel->rating,
        //         'hotel_capacity' => $hotel->capacity,
        //         'room_id' => $room->id,
        //         'room_hotel_id' => $room->hotel_id,
        //         'room_type' => $room->type,
        //         'room_status' => $room->status
        //     ];
        // }

        return response()->json(['message' => 'Success', 'data' => $data],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        //
    }
}
