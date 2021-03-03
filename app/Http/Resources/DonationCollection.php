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
            'topDonator' => Donation::orderBy('amount', 'desc')->select('amount', 'name')->first(),
            'dayAmount' => Donation::whereDay('created_at', Carbon::now()->day)->sum('amount'),
            'monthAmount' => Donation::whereMonth('created_at', Carbon::now()->month)->sum('amount'),
            'chart' => Donation::select('created_at', 'amount')->get()->groupBy(function ($row) {
                return Carbon::parse($row->created_at)->format('d.m.Y');
            })->map(function ($row) {
                return $row->sum('amount');
            }),
            'data' => $this->collection,
        ];
    }
}
