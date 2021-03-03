<?php

namespace App\Http\Resources;

use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DonationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'topDonator' => Donation::orderBy('amount', 'desc')->select('amount', 'email')->first(),
            'lastMonthAmount' => Donation::whereMonth('created_at', Carbon::now()->month)->sum('amount'),
            'allTimeAmount' => Donation::count(),
            'data' => $this->collection,
        ];
    }
}
