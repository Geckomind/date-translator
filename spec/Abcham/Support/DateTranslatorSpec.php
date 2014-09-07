<?php namespace spec\Abcham\Support;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class DateTranslatorSpec
 * @package spec\Abcham\Support
 */
class DateTranslatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Abcham\Support\DateTranslator');
    }

    public function it_accepts_any_valid_php_datetime_string_format()
    {
        $fecha1 = '2014-08-12 12:00:00';
        //Formato default
        $formato1 = 'Y-m-d H:i:s';

        $fecha2 = '12/08/2014 1:24 PM';
        $formato2 = 'd/m/Y H:i A';

        $fecha3 = '2014-08-12';
        $formato3 = 'Y-m-d';

        $this->setDate($fecha1)->shouldReturn(true);
        $this->setDate($fecha2, $formato2)->shouldReturn(true);
        $this->setDate($fecha3, $formato3)->shouldReturn(true);
    }

    public function it_validates_the_datetime_format()
    {
        $fechaIncorrecta = '10/04/2014';
        $this->shouldThrow('InvalidArgumentException')
            ->duringSetDate($fechaIncorrecta);
    }

    public function it_gets_the_day_of_the_date()
    {
        $fecha = '12/08/2014 2:24 PM';
        $formato = 'd/m/Y H:i A';
        $this->setDate($fecha, $formato);
        $this->getDay()->shouldReturn('12');
    }

    public function it_gets_the_month_of_the_date()
    {
        $fecha = '12/08/2014 2:24 PM';
        $formato = 'd/m/Y H:i A';
        $this->setDate($fecha, $formato);
        $this->getMonth()->shouldReturn('08');
    }

    public function it_gets_the_year_of_the_date()
    {
        $fecha = '12/08/2014 2:24 PM';
        $formato = 'd/m/Y H:i A';
        $this->setDate($fecha, $formato);
        $this->getYear()->shouldReturn('2014');
    }

    public function it_gets_hour_of_the_date()
    {
        $fecha = '12/08/2014 2:24 PM';
        $formato = 'd/m/Y H:i A';
        $this->setDate($fecha, $formato);
        $this->getHour()->shouldReturn('14');
    }

    public function it_gets_minutes_of_the_date()
    {
        $fecha = '12/08/2014 1:35 AM';
        $formato = 'd/m/Y H:i A';
        $this->setDate($fecha, $formato);
        $this->getMinutes()->shouldReturn('35');
    }

    public function it_gets_seconds_of_the_date()
    {
        $fecha = '12/08/2014 1:35 AM';
        $formato = 'd/m/Y H:i A';
        $this->setDate($fecha, $formato);
        $this->getSeconds()->shouldReturn('00');
    }

    public function it_gets_ante_meridiem()
    {
        $fecha = '12/08/2014 1:35 AM';
        $formato = 'd/m/Y H:i A';
        $this->setDate($fecha, $formato);
        $this->getMeridian()->shouldReturn('AM');
    }

    public function it_gets_post_meridiem()
    {
        $fecha = '12/08/2014 1:35 PM';
        $formato = 'd/m/Y H:i A';
        $this->setDate($fecha, $formato);
        $this->getMeridian()->shouldReturn('PM');
    }

    public function it_returns_the_date_in_any_format_specified()
    {
        $fecha = '12/08/2014 1:35 PM';
        $formato = 'd/m/Y g:i A';
        $this->setDate($fecha, $formato);
        $formatoEsperado = 'Y-m-d H:i:s';
        $this->getDateFormat($formatoEsperado)->shouldReturn('2014-08-12 13:35:00');

        $fecha = '2014-08-12 13:35:00';
        $formato = 'Y-m-d H:i:s';
        $this->setDate($fecha, $formato);
        $formatoEsperado = 'd/m/Y g:i A';
        $this->getDateFormat($formatoEsperado)->shouldReturn('12/08/2014 1:35 PM');
    }

    public function it_is_tolerable_to_data_requested_and_non_existent()
    {
        $fecha = '2014-09-02';
        $formato = 'Y-m-d';
        $this->setDate($fecha, $formato);
        $horaDelServidorEsperada = date('H');
        $this->getHour()->shouldReturn($horaDelServidorEsperada);
    }
}
