<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateClass extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:class {name} {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = $this->option('path');
        $path = $path ?  str_replace(' ', '/', ucwords(str_replace('/', ' ', $path))) : 'app';
        //first letter of class name must be uppercase
        $name = ucfirst($name);
        //replace / with \ in path
        $namespace = str_replace('/', '\\', $path);
        //replace all first letters of path with uppercase
        $namespace = str_replace(' ', '\\', ucwords(str_replace('\\', ' ', $namespace)));
        //get base path
        $path = base_path($path);
        //create directory if not exists
     
       
           
       
        
        if (file_exists($path)) {
            $this->error('Class ' . $name . ' already exists.');
            return Command::FAILURE;
        }else{
            mkdir($path, 0777, true);
        }
        //generate method name
        $methods =[
            'index',
            'create',
            'store',
            'show',
            'edit',
            'update',
            'destroy',
        ];
       
        //generate method
        $methods = array_map(function ($method) {
            return 'public function '. $method . '()' . PHP_EOL . '{' . PHP_EOL . PHP_EOL .'}' . PHP_EOL . PHP_EOL;
        }, $methods);

        $method = implode('', $methods);

        //create file if not exists
       $path = $path . '/' . $name . '.php';
        $content = '<?php' . PHP_EOL . PHP_EOL . 'namespace '.$namespace.';' . PHP_EOL . PHP_EOL . 'class ' . $name .
            PHP_EOL . '{' . PHP_EOL . PHP_EOL .$method .PHP_EOL.'}' . PHP_EOL;
        file_put_contents($path, $content);
        $this->info('Class ' . $name . ' created successfully.');

        return Command::SUCCESS;
    }
}
