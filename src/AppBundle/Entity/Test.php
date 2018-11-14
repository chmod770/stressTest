<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TestRepository")
 */
class Test
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=255)
     */
    private $adress;

    /**
     * @var string
     *
     * @ORM\Column(name="ab", type="text")
     */
    private $ab;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="DocumentLength", type="integer")
     */
    private $documentLength;

    /**
     * @var int
     *
     * @ORM\Column(name="Timetakenfortests", type="integer")
     */
    private $timetakenfortests;

    /**
     * @var int
     *
     * @ORM\Column(name="Completerequests", type="integer")
     */
    private $completerequests;

    /**
     * @var int
     *
     * @ORM\Column(name="Failedrequests", type="integer")
     */
    private $failedrequests;

    /**
     * @var int
     *
     * @ORM\Column(name="Totaltransferred", type="integer")
     */
    private $totaltransferred;

    /**
     * @var int
     *
     * @ORM\Column(name="HTMLtransferred", type="integer")
     */
    private $hTMLtransferred;

    /**
     * @var int
     *
     * @ORM\Column(name="Non2xxresponses", type="integer")
     */
    private $non2xxresponses;

    /**
     * @var float
     *
     * @ORM\Column(name="Requestspersecond", type="float")
     */
    private $requestspersecond;

    /**
     * @var float
     *
     * @ORM\Column(name="Transferrate", type="float")
     */
    private $transferrate;

    /**
     * @var int
     *
     * @ORM\Column(name="connectMin", type="integer")
     */
    private $connectMin;

    /**
     * @var int
     *
     * @ORM\Column(name="connectAvg", type="integer")
     */
    private $connectAvg;

    /**
     * @var int
     *
     * @ORM\Column(name="connectMax", type="integer")
     */
    private $connectMax;

    /**
     * @var int
     *
     * @ORM\Column(name="processingMin", type="integer")
     */
    private $processingMin;

    /**
     * @var int
     *
     * @ORM\Column(name="processingAvg", type="integer")
     */
    private $processingAvg;

    /**
     * @var int
     *
     * @ORM\Column(name="processingMax", type="integer")
     */
    private $processingMax;

    /**
     * @var int
     *
     * @ORM\Column(name="totalMin", type="integer")
     */
    private $totalMin;

    /**
     * @var int
     *
     * @ORM\Column(name="totalAvg", type="integer")
     */
    private $totalAvg;

    /**
     * @var int
     *
     * @ORM\Column(name="totalMax", type="integer")
     */
    private $totalMax;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Test
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set ab
     *
     * @param string $ab
     *
     * @return Test
     */
    public function setAb($ab)
    {
        $this->ab = $ab;

        return $this;
    }

    /**
     * Get ab
     *
     * @return string
     */
    public function getAb()
    {
        return $this->ab;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Test
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set documentLength
     *
     * @param integer $documentLength
     *
     * @return Test
     */
    public function setDocumentLength($documentLength)
    {
        $this->documentLength = $documentLength;

        return $this;
    }

    /**
     * Get documentLength
     *
     * @return int
     */
    public function getDocumentLength()
    {
        return $this->documentLength;
    }

    /**
     * Set timetakenfortests
     *
     * @param integer $timetakenfortests
     *
     * @return Test
     */
    public function setTimetakenfortests($timetakenfortests)
    {
        $this->timetakenfortests = $timetakenfortests;

        return $this;
    }

    /**
     * Get timetakenfortests
     *
     * @return int
     */
    public function getTimetakenfortests()
    {
        return $this->timetakenfortests;
    }

    /**
     * Set completerequests
     *
     * @param integer $completerequests
     *
     * @return Test
     */
    public function setCompleterequests($completerequests)
    {
        $this->completerequests = $completerequests;

        return $this;
    }

    /**
     * Get completerequests
     *
     * @return int
     */
    public function getCompleterequests()
    {
        return $this->completerequests;
    }

    /**
     * Set failedrequests
     *
     * @param integer $failedrequests
     *
     * @return Test
     */
    public function setFailedrequests($failedrequests)
    {
        $this->failedrequests = $failedrequests;

        return $this;
    }

    /**
     * Get failedrequests
     *
     * @return int
     */
    public function getFailedrequests()
    {
        return $this->failedrequests;
    }

    /**
     * Set totaltransferred
     *
     * @param integer $totaltransferred
     *
     * @return Test
     */
    public function setTotaltransferred($totaltransferred)
    {
        $this->totaltransferred = $totaltransferred;

        return $this;
    }

    /**
     * Get totaltransferred
     *
     * @return int
     */
    public function getTotaltransferred()
    {
        return $this->totaltransferred;
    }

    /**
     * Set hTMLtransferred
     *
     * @param integer $hTMLtransferred
     *
     * @return Test
     */
    public function setHTMLtransferred($hTMLtransferred)
    {
        $this->hTMLtransferred = $hTMLtransferred;

        return $this;
    }

    /**
     * Get hTMLtransferred
     *
     * @return int
     */
    public function getHTMLtransferred()
    {
        return $this->hTMLtransferred;
    }

    /**
     * Set non2xxresponses
     *
     * @param integer $non2xxresponses
     *
     * @return Test
     */
    public function setNon2xxresponses($non2xxresponses)
    {
        $this->non2xxresponses = $non2xxresponses;

        return $this;
    }

    /**
     * Get non2xxresponses
     *
     * @return int
     */
    public function getNon2xxresponses()
    {
        return $this->non2xxresponses;
    }

    /**
     * Set requestspersecond
     *
     * @param float $requestspersecond
     *
     * @return Test
     */
    public function setRequestspersecond($requestspersecond)
    {
        $this->requestspersecond = $requestspersecond;

        return $this;
    }

    /**
     * Get requestspersecond
     *
     * @return float
     */
    public function getRequestspersecond()
    {
        return $this->requestspersecond;
    }

    /**
     * Set transferrate
     *
     * @param float $transferrate
     *
     * @return Test
     */
    public function setTransferrate($transferrate)
    {
        $this->transferrate = $transferrate;

        return $this;
    }

    /**
     * Get transferrate
     *
     * @return float
     */
    public function getTransferrate()
    {
        return $this->transferrate;
    }

    /**
     * Set connectMin
     *
     * @param integer $connectMin
     *
     * @return Test
     */
    public function setConnectMin($connectMin)
    {
        $this->connectMin = $connectMin;

        return $this;
    }

    /**
     * Get connectMin
     *
     * @return int
     */
    public function getConnectMin()
    {
        return $this->connectMin;
    }


    /**
     * Set connectAvg
     *
     * @param integer $connectAvg
     *
     * @return Test
     */
    public function setConnectAvg($connectAvg)
    {
        $this->connectAvg = $connectAvg;

        return $this;
    }

    /**
     * Get connectAvg
     *
     * @return int
     */
    public function getConnectAvg()
    {
        return $this->connectAvg;
    }


    /**
     * Set connectMax
     *
     * @param integer $connectMax
     *
     * @return Test
     */
    public function setConnectMax($connectMax)
    {
        $this->connectMax = $connectMax;

        return $this;
    }

    /**
     * Get connectMax
     *
     * @return int
     */
    public function getConnectMax()
    {
        return $this->connectMax;
    }


    /**
     * Set processingMin
     *
     * @param integer $processingMin
     *
     * @return Test
     */
    public function setProcessingMin($processingMin)
    {
        $this->processingMin = $processingMin;

        return $this;
    }

    /**
     * Get processingMin
     *
     * @return int
     */
    public function getProcessingMin()
    {
        return $this->processingMin;
    }


    /**
     * Set processingAvg
     *
     * @param integer $processingAvg
     *
     * @return Test
     */
    public function setProcessingAvg($processingAvg)
    {
        $this->processingAvg = $processingAvg;

        return $this;
    }

    /**
     * Get processingAvg
     *
     * @return int
     */
    public function getProcessingAvg()
    {
        return $this->processingAvg;
    }


    /**
     * Set processingMax
     *
     * @param integer $processingMax
     *
     * @return Test
     */
    public function setProcessingMax($processingMax)
    {
        $this->processingMax = $processingMax;

        return $this;
    }

    /**
     * Get processingMax
     *
     * @return int
     */
    public function getProcessingMax()
    {
        return $this->processingMax;
    }


    /**
     * Set totalMin
     *
     * @param integer $totalMin
     *
     * @return Test
     */
    public function setTotalMin($totalMin)
    {
        $this->totalMin = $totalMin;

        return $this;
    }

    /**
     * Get totalMin
     *
     * @return int
     */
    public function getTotalMin()
    {
        return $this->totalMin;
    }


    /**
     * Set totalAvg
     *
     * @param integer $totalAvg
     *
     * @return Test
     */
    public function setTotalAvg($totalAvg)
    {
        $this->totalAvg = $totalAvg;

        return $this;
    }

    /**
     * Get totalAvg
     *
     * @return int
     */
    public function getTotalAvg()
    {
        return $this->totalAvg;
    }


    /**
     * Set totalMax
     *
     * @param integer $totalMax
     *
     * @return Test
     */
    public function setTotalMax($totalMax)
    {
        $this->totalMax = $totalMax;

        return $this;
    }

    /**
     * Get totalMax
     *
     * @return int
     */
    public function getTotalMax()
    {
        return $this->totalMax;
    }

}

