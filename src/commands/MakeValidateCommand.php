<?php

namespace SunTao\commands;

use Illuminate\Console\Command;

class MakeValidateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *a
     * @var string
     */
    protected $signature = 'make:validate.stub {validate_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成验证器';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $validate_name = $this->argument('validate_name');
        $dir = config('validate.dir');
        if (! file_exists($dir)) {
            if (!mkdir($dir)) {
                $this->error('create fail : validate dir ' . $dir);
                return;
            }
        }
        $temp_dir = __DIR__ . '/stub/validate.stub';
        if (file_exists($dir . '/' . $validate_name . '.php')) {
            $this->error('validator already exists!');
            return;
        }
        $handle = fopen($dir . '/' . $validate_name . '.php', "w");
        $temp = fopen($temp_dir, 'r');
        $temp_str = fread($temp, filesize($temp_dir));
        fclose($temp);
        fwrite($handle, vsprintf($temp_str, [config('validate.namespace'), $validate_name]));
        fclose($handle);
        $this->info("Validate created successfully.");
    }
}
