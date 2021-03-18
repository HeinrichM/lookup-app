<?php

namespace App\Http\Controllers;

use App\Http\Requests\CellNumberRequest;
use App\Models\Cellnumber;
use Illuminate\Http\Request;

class CellNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Cellnumber $cellNumber = null)
    {
//        $lookupHistory = Cellnumber::latest()->paginate(50);
        return view('pages.cellnumber.index', compact( 'cellNumber'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CellNumberRequest $request)
    {
        // Check if the cell number already exists in the database
        $cellNumber = Cellnumber::where('cell_number',$request->number)->first();
        if($cellNumber){
            // Return cell number information
            return redirect()->route('cellnumber.index',['cellNumber'=>$cellNumber]);
        }


        // Array if all cell provider prefixes
        $providers = [
            'MTN' => ['2783', '2773', '2763'],
            'Vodacom' => ['2782', '2772', '2762'],
            'Telkom' => ['2781', '2771', '2761'],
            'CellC' => ['2784', '2774'],
        ];

        foreach($providers as $name => $prefixes){
            $number = substr($request->number, 0, 4); // Take the first 4 digits if cell number
            // Check if its a match for any cell provider prefixes
            if (in_array($number,$prefixes)){
                // Save to database for future
                $cellNumber = CellNumber::create([
                    'cell_number' => $request->number,
                    'original_network' => $name,
                    'current_network' => $name,
                ]);
                // Return cell number information
                return redirect()->route('cellnumber.index',['cellNumber'=>$cellNumber]);
            }
        }
        // Return no match found
        return redirect()->route('cellnumber.index')->with('error','Cell number did not match any provider.');
    }
}
