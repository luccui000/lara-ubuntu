<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class CPUUsageController extends ApiController
{
    public function index()
    {
        if (is_readable("/proc/stat"))
        {
            $stats = @file_get_contents("/proc/stat");
            if($stats !== false) {
                $stats = preg_replace("/[[:blank:]]+/", " ", $stats);
                $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
                $stats = explode("\n", $stats);

                foreach ($stats as $statLine) {
                    $statLineData = explode(" ", trim($statLine));
                    if((count($statLineData) >= 5) && ($statLineData[0] == "cpu")) {
                        $cpuTime = $statLineData[1] + $statLineData[2] + $statLineData[3] + $statLineData[4];
                        $load = 100 - ($statLineData[4] * 100 / $cpuTime);
                        return response()->json([
                            'label' => 'Usage',
                            'data' => $load
                        ]);
                    }
                }
            }

        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
