<?php

namespace App\Http\Controllers;

use App\Http\Requests\IPRequest;
use App\Models\IP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lookupHistory = IP::latest()->paginate(50);
        return view('pages.ip.index', compact('lookupHistory','ipAddress'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IPRequest $request)
    {
        // Get ip information from ipapi
        $endpoint = 'https://ipapi.co/'.$request->ip.'/json/';
        $response = Http::get($endpoint);
        $ipAddress = $response->collect();

        // Check for error
        if(isset($ipAddress['error'])){
            // Return error
            return redirect()->back()->with('error',$ipAddress['reason']);
        }
        // Check if ip address already exists in database
        $ipAddressDatabase = IP::where('ip',$request->ip)->first();
        if($ipAddressDatabase){
            $ipAddressDatabase->update([
                'city' => $ipAddress['city'],
                'region' => $ipAddress['region'],
                'region_code' => $ipAddress['region_code'],
                'country' => $ipAddress['country'],
                'country_name' => $ipAddress['country_name'],
                'country_code' => $ipAddress['country_code'],
                'country_code_iso3' => $ipAddress['country_code_iso3'],
                'continent_code' => $ipAddress['continent_code'],
                'org' => $ipAddress['org'],
                'updated_at' => now(),
            ]);
            $ipAddress = $ipAddressDatabase;
        }
        else {
            // Save ip information to database for future lookups
            $ipAddress = IP::create([
                'ip' => $ipAddress['ip'],
                'version' => $ipAddress['version'],
                'city' => $ipAddress['city'],
                'region' => $ipAddress['region'],
                'region_code' => $ipAddress['region_code'],
                'country' => $ipAddress['country'],
                'country_name' => $ipAddress['country_name'],
                'country_code' => $ipAddress['country_code'],
                'country_code_iso3' => $ipAddress['country_code_iso3'],
                'continent_code' => $ipAddress['continent_code'],
                'org' => $ipAddress['org'],
            ]);
        }
        // Return ip address information
        return redirect()->route('ip.show', ['ipAddress'=>$ipAddress->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param IP $ipAddress
     * @return \Illuminate\Http\Response
     */
    public function show(IP $ipAddress)
    {
        $lookupHistory = IP::latest()->paginate(50);
        return view('pages.ip.index', compact('lookupHistory','ipAddress'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IP  $iP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IP $ipAddress)
    {
        if($ipAddress->status == 'Allowed'){
            $ipAddress->status = 0;
        } else {
            $ipAddress->status = 1;
        }
        $ipAddress->save();
        return response()
            ->json(['status' => $ipAddress->status]);
    }
}
