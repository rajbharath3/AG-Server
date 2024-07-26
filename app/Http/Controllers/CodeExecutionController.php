<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CodeExecutionController extends Controller
{
    use ValidatesRequests;
    
    public function runCode(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string',
            'language' => 'required|string',
        ]);

        $code = $request->input('code');
        $language = $request->input('language');

        $output = $this->executeCode($code, $language);

        return response()->json(['output' => $output]);
    }

    protected function executeCode($code, $language)
    {
        $filename = time();
        $filepath = "/tmp/{$filename}";

        switch ($language) {
            case 'c_cpp':
                $filepath .= ".cpp";
                file_put_contents($filepath, $code);
                $process = new Process(["g++", $filepath, "-o", "/tmp/{$filename}.out"]);
                $process->run();

                if (!$process->isSuccessful()) {
                    return $process->getErrorOutput();
                }

                $process = new Process(["/tmp/{$filename}.out"]);
                break;

            case 'java':
                $filepath .= ".java";
                file_put_contents($filepath, $code);
                $process = new Process(["javac", $filepath]);
                $process->run();

                if (!$process->isSuccessful()) {
                    return $process->getErrorOutput();
                }

                $process = new Process(["java", "-cp", "/tmp", $filename]);
                break;

            case 'python':
                $filepath .= ".py";
                file_put_contents($filepath, $code);
                $process = new Process(["python3", $filepath]);
                break;

            case 'javascript':
                $filepath .= ".js";
                file_put_contents($filepath, $code);
                $process = new Process(["node", $filepath]);
                break;

            default:
                return "Unsupported language";
        }

        $process->run();

        if (!$process->isSuccessful()) {
            return $process->getErrorOutput();
        }

        return $process->getOutput();
    }
}
