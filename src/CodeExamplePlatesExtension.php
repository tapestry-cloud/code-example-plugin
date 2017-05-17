<?php namespace TapestryCloud;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class CodeExamplePlatesExtension implements ExtensionInterface
{
    /**
     * @var string
     */
    private $codeExamplesPath;

    /**
     * CodeExamplePlatesExtension constructor.
     * @param string $codeExamplesPath
     */
    public function __construct($codeExamplesPath)
    {
        $this->codeExamplesPath = $codeExamplesPath;
    }

    /**
     * @param Engine $engine
     */
    public function register(Engine $engine)
    {
        $engine->registerFunction('codeExample', [$this, 'codeExample']);
    }

    /**
     * @param string $file
     * @return string
     * @throws \Exception
     */
    public function codeExample($file)
    {
        $this->codeExamplesPath = __DIR__ . '/../source/_code-examples/' . $file;
        if (! file_exists($this->codeExamplesPath)) {
            throw new \Exception('File ['. $this->codeExamplesPath .'] does not exist.');
        }

        return htmlentities(file_get_contents($this->codeExamplesPath));
    }
}