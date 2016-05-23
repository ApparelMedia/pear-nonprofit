<?php namespace App\Transformers;

use App\Nonprofit;
use League\Fractal\TransformerAbstract;

class NonprofitTransformer extends TransformerAbstract
{
    public function transform(Nonprofit $org)
    {
        $codes = explode(',', $org->deductibility_status_code);

        return [
            'id' => $org->id,
            'ein' => $org->ein,
            'name' => $org->name,
            'city' => $org->city,
            'state' => $org->state,
            'country' => $org->country,
            'deductibility_status_code' => $codes,
            'created_at' => $org->created_at ? $org->created_at->format('c') : null,
            'updated_at' => $org->updated_at ? $org->updated_at->format('c') : null,
        ];
    }
}