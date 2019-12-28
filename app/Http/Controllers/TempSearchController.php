<?php

namespace App\Http\Controllers;

use App\TempSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;

use App\Hotel;
use App\User;
use App\HotelRoom;

use App\Http\Resources\HotelResource;

class TempSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = $request->token;
        // return response()->json(['message' => 'success', 'token' => $request->token], 200);
        
        $userId = User::where('api_token', $token)->first()->id;

        // menampilkan data sesuai dengan token
        // menampilkan data untuk di response ke front end
        $data = TempSearch::where('user_id', $userId)->latest()->first();

        $hotel = Hotel::where([
            'location' => $data->location,
            'hotel_rooms.status' => 0,
            'hotel_rooms.room_capacity' => $data->capacity
        ])->join('hotel_rooms', 'hotels.id', '=', 'hotel_rooms.hotel_id')
        ->groupBy('hotels.name')
        ->paginate(5);

        return response()->json(['message' => 'Success', 'data' => $hotel], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $request->token;
        $userId = User::where('api_token', $token)->first()->id;
        // return $userId;

        $capacity = $request->person / $request->room;
        $capacity = ceil($capacity);
        if($capacity==1){
            $capacity = 2;
        }else if ($capacity >= 4){
            $capacity = $capacity / 2;
        }
        
        $checkIn = $request->checkIn;
        $checkIn = date('Y-m-d', strtotime($checkIn));

        $checkOut = $request->checkOut;
        $checkOut = date('Y-m-d', strtotime($checkOut));

        $search = TempSearch::create([
            'user_id' => $userId,
            'location' => $request->city,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'capacity' => $capacity,
            'guest' => $request->person,
            'room' => $request->room
        ]);

        return response()->json(['message' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TempSearch  $tempSearch
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        $user = User::where('api_token', $token)->first();

        $search = $user->search()->latest()->first();

        // checkIn convert
        $checkIn = strtotime($search->check_in);
        $checkInFormat = date('D, d M Y', $checkIn);

        // checkOut convert
        $checkOut = strtotime($search->check_out);
        $checkOutFormat = date('D, d M Y', $checkOut);

        // $nights = $checkOut - $checkIn;
        $nights = $checkOut - $checkIn;
        $nights = floor($nights/60/60/24);

        $data = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'search_id' => $search->id,
            'user_id' => $search->user_id,
            'search_location' => $search->location,
            'check_in_pure' => $search->check_in,
            'check_out_pure' => $search->check_out,
            'search_checkIn' => $checkInFormat,
            'search_checkOut' => $checkOutFormat,
            'search_capacity' => $search->capacity,
            'search_time' => $search->created_at,
            'nights' => $nights,
            'guest' =>  $search->guest,
            'room' =>  $search->room
        ];

        return response()->json([
            'message' => 'Success',
            'data' => $data
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TempSearch  $tempSearch
     * @return \Illuminate\Http\Response
     */
    public function edit(TempSearch $tempSearch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TempSearch  $tempSearch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TempSearch $tempSearch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TempSearch  $tempSearch
     * @return \Illuminate\Http\Response
     */
    public function destroy(TempSearch $tempSearch)
    {
        //
    }
}
