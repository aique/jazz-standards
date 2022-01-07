<?php

namespace App\DataFixtures;

use App\Entity\JazzStandard;

/**
 * Obtiene las entidades a partir de la guía rápida.
 *
 * Se utiliza para la carga inicial de datos.
 */
class QuickReferenceReader
{
    /**
     * Número de campos que contiene cada línea de la guía.
     */
    const NUM_REF_FIELDS = 3;

    /**
     * @var string
     */
    private $path;

    /**
     * @var resource
     */
    private $inputStream;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function next(): ?JazzStandard
    {
        if ($this->inputStream === null) {
            $this->inputStream = fopen($this->path, 'r');

            if ($this->inputStream === false) {
                throw new \Exception("Quick reference not found in path $this->path");
            }
        }

        $line = fgets($this->inputStream);

        if ($line === false) {
            fclose($this->inputStream);
            return null;
        }

        $data = explode(';', $line);

        if ($data === false || count($data) != self::NUM_REF_FIELDS) {
            return null;
        }

        return new JazzStandard(
            $data[0], $data[1], $data[2]
        );
    }
}