<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PickUp;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class DeliveryController extends Controller
{
    function showPickupPoints()
    {
        $points = PickUp::all();
        return view('backend.pickupPoints.allPickupPoints', compact('points'));
    }
    function deletePoint($id)
    {
        $point  = PickUp::find($id);
        $point->delete();
        return back();
    }

    function addPoints()
    {
        return view('backend.pickupPoints.addPoints');
    }

    function storePoint(Request $request)
    {
        PickUp::create($request->all());
        return redirect(route('pickup.all'));
    }
}
