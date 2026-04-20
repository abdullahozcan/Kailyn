<?php

namespace Core\Tulpar;

class Functions
{
    private $argv;
    private $command;

    public function __construct($argv)
    {
        $this->argv = $argv;
        $this->command = $this->argv[1] ?? null;
    }

    public function run()
    {
        if ($this->command === null) {
            return "command false";
        }

        if($this->command === 'fly') {
            return $this->fly();
        }

        if(explode(':', $this->command)[0] === 'make') {
            $type = explode(':', $this->command)[1];
            $name = $this->argv[2] ?? null;
            if($name === null) {
                return "Lütfen bir dosya ismi giriniz!";
            }
            return $this->make($type, $name);
        }
        return "false";
    }

    public function fly()
    {
        $host = '127.0.0.1';
        $port = '8000';
        $docRoot = __DIR__ .'/../../public';

        echo "\033[35mPHP yerleşik sunucusu başlatılıyor: http://$host:$port\033[0m\n";
        exec("php -S $host:$port -t $docRoot");
    }

    public function choice($question, array $choices, $default = null)
    {
        echo "$question\n";
        
        foreach ($choices as $key => $value) {
            echo "[$key] $value\n";
        }
    
        echo "Seçiminizi girin (Varsayılan: $default): ";
        $input = trim(fgets(STDIN));
    
        return $input !== '' ? ($choices[$input] ?? $default) : $default;
    }

    public function make($type, $name)
    {
        $type = ucfirst($type);
        if (method_exists($this, $type)) {
            return $this->{$this->command}();
        }
        
        $name = ucfirst($name);

        $path = __DIR__ . "/../../app/".$type."s/$name.php";

        if (file_exists($path)) {
            return "$type $name zaten var!";
        }

        $content = "<?php\n\nnamespace $type;\n\nclass $name\n{\n    //\n}\n";

        file_put_contents($path, $content);

        return "$type $name oluşturuldu!";
    }

}
