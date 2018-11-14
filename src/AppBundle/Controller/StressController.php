<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Stress;
use AppBundle\Entity\Test;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StressController extends Controller
{

    /**
     * @Route("", name="homepage")
     */
    public function indexAction()
    {
        header("Location: app_dev.php/stress");
        die();
    }
    /**
     * @Route("/stress", name="stress_list")
     */
    public function listAction()
    {
        $pages = $this->getDoctrine()
            ->getRepository('AppBundle:Stress')
            ->findAll();

        return $this->render('stress/index.html.twig',array(
            'pages' => $pages
        ));
    }
    /**
     * @Route("/edit", name="stress_edit")
     */

    public function editAction(Request $request)
    {

        return $this->render('stress/edit.html.twig');
    }
    /**
     * @Route("/create", name="stress_create")
     */

    public function createAction(Request $request)
    {
        $page = new Stress;

        $form = $this->createFormBuilder($page)
            ->add('name', TextType::class,array('attr' => array('class' => 'form-control','style' =>'margin-bottom:15px')))
            ->add('adress', TextType::class,array('attr' => array('class' => 'form-control','style' =>'margin-bottom:15px')))
            ->add('save', SubmitType::class,array('label'=>'Dodaj Stronę','attr' => array('class' => 'btn btn-primary','style' =>'margin-bottom:15px')))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $name = $form['name']->getData();
            $adress= $form['adress']->getData();

            $page->setName($name);
            $page->setAdress($adress);

            $em = $this->getDoctrine()->getManager();

            $em->persist($page);
            $em->flush();

            $this->addFlash(
                'notice',
                'Strona Dodana'
            );

            return $this->redirectToRoute('stress_list');
        }
        return $this->render('stress/create.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/details/{adress}", name="stress_details")
     */
    public function detailsAction($adress)
    {


        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT t
             FROM AppBundle:Test t
            WHERE t.adress = :adress
            ORDER BY t.id DESC'
        )->setParameter('adress', $adress);

        $tests_result=$query
            ->getResult();

        return $this->render('stress/details.html.twig',array(
            'tests' => $tests_result
        ));

    }

    /**
     * @Route("/delete/{id}", name="stress_delete")
     */
    public function deleteAction($id)
    {

        $page = $this->getDoctrine()
            ->getRepository('AppBundle:Stress')
            ->find($id);
        $adress= $page->getAdress();


        $em = $this->getDoctrine()->getManager();
        $tests = $em->getRepository('AppBundle:Test')->findBy(array('adress' => $adress));

        foreach ($tests as $test)
        {
            $em->remove($test);
            $em->flush();
        }

        $page = $em->getRepository('AppBundle:Stress')->find($id);

        $em->remove($page);
        $em->flush();



        $this->addFlash(
            'notice',
            'Strona Usunięta'
        );

        return $this->redirectToRoute('stress_list');
    }

    /**
     * @Route("/test/{adress}", name="stress_test")
     */
    public function testAction($adress)
    {
        //komenda w shellu którą używamy narzędzia ab parametr -n(liczba tetów) -c(ile testów na zapytanie) -w(parametr wskazujący na to, żebyśmy otrzymali zwrotkę w postaci tabeli HTML)
        $output = shell_exec('\xampp\apache\bin\ab.exe -n 10 -c 2 -w http://'.$adress.'/');
        $output = str_replace("<p>", '', $output);
        $output = str_replace("This is ApacheBench, Version 2.3 <i>&lt;\$Revision: 1757674 \$&gt;</i><br>", '', $output);
        $output = str_replace("Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/<br>", '', $output);
        $output = str_replace("Licensed to The Apache Software Foundation, http://www.apache.org/<br>", '', $output);
        $output = str_replace("</p>", '', $output);
        $output = str_replace("..done", '', $output);


        $das=trim($output);
        // trim usuwa białę znaki
        $das =str_replace("<table >",' ',$das);
        $das =str_replace("</table>",' ',$das);
        $das=str_replace("colspan=2 ",'',$das);
        $das=str_replace("bgcolor=white",'',$das);
        $das=str_replace("colspan=4",'',$das);
        $das=str_replace("</th><td >",'',$das);
        $das=str_replace("<tr ><th >",'|',$das);
        $das=str_replace("</td></tr>",'',$das);
        $das=str_replace("</td><td",'',$das);
        $das1=explode('|',$das);
        //funkcją str_replace odcinamy od zwrotki z apache bench to czego nie chcemy
        $ilosc = count($das1);
        echo $ilosc."<br>";

        //odzeilenie zmiennych związanych z czasem
        $timeVariables=array();
        for($i=0;$i<4;$i++)
            $timeVariables[$i]=$das1[$ilosc-4+$i];

        //usunięcie ich z głównego stringa
        for($i = $ilosc-4;$i<$ilosc;$i++)
            unset($das1[$i]);


        //zmienne do dodania do bazy
        //za pomocą funkcji explode oddzielenie wartości
        $DocumentLength=explode( " ",explode(":",$das1[5])[1] )[0];
        $Timetakenfortests=explode( " ",explode(":",$das1[7])[1] )[0];
        $Completerequests=trim(explode(":",$das1[8])[1]);
        $Failedrequests=str_replace('<tr ><td >','', trim(explode(":",$das1[9])[1]));
        if($ilosc==18) {
            $Totaltransferred =trim(explode(" ",explode(":", $das1[10])[1])[0]);
            $HTMLtransferred = explode(":", $das1[11])[1];
            $Requestspersecond = trim(explode(":", $das1[12])[1]);
            $Transferrate = explode(" ", explode(":", $das1[13])[1])[0];
            $Non2xxresponses = 0;
        }else
        {
            $Non2xxresponses =trim(explode(":", $das1[10])[1]);
            $Totaltransferred = trim(explode(" ",explode(":", $das1[11])[1])[0]);
            $HTMLtransferred = explode(":", $das1[12])[1];
            $Requestspersecond = trim(explode(":", $das1[13])[1]);
            $Transferrate = explode(" ", explode(":", $das1[14])[1])[0];
        }



        $connect=$timeVariables[1];
        $connect=explode(":", $connect);
        $connect=preg_split('/\s+/', $connect[1]);

        $connectMin=$connect[1];
        $connectAvg=$connect[3];
        $connectMax=$connect[5];

        $processing=$timeVariables[2];
        $processing=explode(":", $processing);
        $processing=preg_split('/\s+/', $processing[1]);

        $processingMin=$processing[1];
        $processingAvg=$processing[3];
        $processingMax=$processing[5];


        $total=$timeVariables[3];
        $total=explode(":", $total);
        $total=preg_split('/\s+/', $total[1]);

        $totalMin=$total[1];
        $totalAvg=$total[3];
        $totalMax=$total[5];


        //dodanie zmiennych do bazy danch
        $date = new\DateTime('now');
        $test  = new Test();
        $test
            ->setAdress($adress)
            ->setAb(trim($output))
            ->setDate($date)
            ->setDocumentLength($DocumentLength)
            ->setTimetakenfortests($Timetakenfortests)
            ->setCompleterequests($Completerequests)
            ->setFailedrequests($Failedrequests)
            ->setTotaltransferred($Totaltransferred)
            ->setHTMLtransferred(explode(" ",$HTMLtransferred)[0])
            ->setNon2xxresponses($Non2xxresponses)
            ->setRequestspersecond($Requestspersecond)
            ->setTransferrate($Transferrate)
            ->setConnectMin($connectMin)
            ->setConnectAvg($connectAvg)
            ->setConnectMax($connectMax)
            ->setProcessingMin($processingMin)
            ->setProcessingAvg($processingAvg)
            ->setProcessingMax($processingMax)
            ->setTotalMin($totalMin)
            ->setTotalAvg($totalAvg)
            ->setTotalMax($totalMax);

        $em = $this->getDoctrine()->getManager();

        $em->persist($test);
        $em->flush();

        $this->addFlash(
            'notice',
            'Test Dodany');

        return $this->redirectToRoute('stress_details',array(
            'adress' => $adress
        ));
    }
}
