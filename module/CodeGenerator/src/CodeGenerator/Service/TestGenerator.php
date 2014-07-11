<?php
namespace CodeGenerator\Service;

use CodeGenerator\Service\AbstractGenerator;

class TestGenerator extends AbstractGenerator
{
    public function testGetClass()
    {
        return $this->getFilePath();
    }
}

