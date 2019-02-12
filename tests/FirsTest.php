<?php

use PHPUnit\Framework\TestCase;

class FirsTest extends TestCase
{
    public function testIfTitleIsTheSame()
    {
        $title = "teste";

        $this->assertEquals('teste', $title, 'Titulo está errado');
    }
}