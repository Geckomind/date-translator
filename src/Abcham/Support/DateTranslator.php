<?php namespace Abcham\Support;
use DateTime;
use InvalidArgumentException;

/**
 * Clase auxiliar para el manejo y "traducción de fechas" en diferentes formatos
 * Class DateTranslator
 * @package Abcham\Support
 */
class DateTranslator
{
    /**
     * Objeto DateTime
     * @var DateTime
     */
    protected $date;

    /**
     * Recibe la fecha especificada en el formato especificado, valida el formato y almacena
     * el objeto DateTime de la fecha para operaciones posteriores
     * @param string $date
     * @param string $format
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function setDate($date, $format = 'Y-m-d H:i:s')
    {
        $this->date = $this->date = DateTime::createFromFormat($format, $date);
        if( $this->date !== false){
            return true;
        }
        throw new InvalidArgumentException("Formato de fecha inválido, se espera [$format]");
    }

    /**
     * Regresa el día [dd]
     * @return string
     */
    public function getDay()
    {
        return $this->getDateFormat('d');
    }

    /**
     * Regresa el mes [mm]
     * @return string
     */
    public function getMonth()
    {
        return $this->getDateFormat('m');
    }

    /**
     * Regresa el año [YYYY]
     * @return string
     */
    public function getYear()
    {
        return $this->getDateFormat('Y');
    }

    /**
     * Regresa la hora [00-24]
     * @return string
     */
    public function getHour()
    {
        return $this->getDateFormat('H');
    }

    /**
     * Regrsa la parte de los minutos [00-59] de la fecha
     * @return string
     */
    public function getMinutes()
    {
        return $this->getDateFormat('i');
    }

    /**
     * Regrsa la parte de los segundos [00-59] de la fecha
     * @return string
     */
    public function getSeconds()
    {
        return $this->getDateFormat('s');
    }

    /**
     * Regresa la parte del Meridiano [AM/PM] de la fecha
     * @return string
     */
    public function getMeridian()
    {
        return $this->getDateFormat('A');
    }

    /**
     * Regresa la fecha en el formato especificado
     * @param string $format
     * @return string
     */
    public function getDateFormat($format)
    {
        return $this->date->format($format);
    }
}