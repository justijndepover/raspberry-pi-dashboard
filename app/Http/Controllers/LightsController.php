<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Symfony\Component\Process\Process;
// use Symfony\Component\Process\Exception\ProcessFailedException;

class LightsController extends Controller
{
    public function on()
    {
        $process = new Process('python ' . storage_path('scripts/lights/on.py'));
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();
        dd($output);
    }

    public function off()
    {
        $process = new Process('python ' . storage_path('scripts/lights/off.py'));
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = $process->getOutput();
        dd($output);
    }

    public function check()
    {
        dd('check');
        // $process = new Process('python /path/to/script.py');
        // $process->run();
        //
        // if (!$process->isSuccessful()) {
        //     // handle error
        // }
        //
        // $output = $process->getOutput();
    }
}
