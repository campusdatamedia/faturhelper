<?php

namespace Ajifatur\FaturHelper\Http\Controllers\API;

use Illuminate\Http\Request;
use Ajifatur\FaturHelper\Models\Visitor;

class VisitorController extends \App\Http\Controllers\Controller
{
    const DATASET = [
        'labels' => [],
        'colors' => [],
        'data' => [],
        'total' => 0
    ];

    /**
     * Get visitor label and data.
     * 
     * @param  string $field
     * @param  string $category
     * @return array
     */
    function getVisitorLabelAndData($field, $category)
    {
        $dataset = [
            'labels' => [],
            'data' => []
        ];
        $array = [];

        // Get visitors
        $visitors = Visitor::has('user')->get();

        // Loop visitors
        foreach($visitors as $visitor) {
            // Decode the visitor content
            $decode = json_decode($visitor->{$field}, true);

            // Push to array
            if(is_array($decode))
                array_push($array, $decode[$category]);
        }

        // Loop array
        foreach(array_count_values($array) as $key=>$value) {
            // Push to dataset
            array_push($dataset['labels'], $key);
            array_push($dataset['data'], $value);
        }

        return $dataset;
    }

    /**
     * Get visitor device type.
     * 
     * @return \Illuminate\Http\Response
     */
    public function deviceType()
    {
        // Set dataset
        $dataset = self::DATASET;
        $dataset['labels'] = $this->getVisitorLabelAndData('device', 'type')['labels'];
        $dataset['data'] = $this->getVisitorLabelAndData('device', 'type')['data'];
        $dataset['total'] = array_sum($dataset['data']);

        // Response
        return response()->json([
            'message' => 'Success.',
            'data' => $dataset
        ], 200);
    }

    /**
     * Get visitor device family.
     * 
     * @return \Illuminate\Http\Response
     */
    public function deviceFamily()
    {
        // Set dataset
        $dataset = self::DATASET;
        $dataset['labels'] = $this->getVisitorLabelAndData('device', 'family')['labels'];
        $dataset['data'] = $this->getVisitorLabelAndData('device', 'family')['data'];
        $dataset['total'] = array_sum($dataset['data']);

        // Response
        return response()->json([
            'message' => 'Success.',
            'data' => $dataset
        ], 200);
    }

    /**
     * Get visitor browser.
     * 
     * @return \Illuminate\Http\Response
     */
    public function browser()
    {
        // Set dataset
        $dataset = self::DATASET;
        $dataset['labels'] = $this->getVisitorLabelAndData('browser', 'family')['labels'];
        $dataset['data'] = $this->getVisitorLabelAndData('browser', 'family')['data'];
        $dataset['total'] = array_sum($dataset['data']);

        // Response
        return response()->json([
            'message' => 'Success.',
            'data' => $dataset
        ], 200);
    }

    /**
     * Get visitor platform.
     * 
     * @return \Illuminate\Http\Response
     */
    public function platform()
    {
        // Set dataset
        $dataset = self::DATASET;
        $dataset['labels'] = $this->getVisitorLabelAndData('platform', 'family')['labels'];
        $dataset['data'] = $this->getVisitorLabelAndData('platform', 'family')['data'];
        $dataset['total'] = array_sum($dataset['data']);

        // Response
        return response()->json([
            'message' => 'Success.',
            'data' => $dataset
        ], 200);
    }
}
