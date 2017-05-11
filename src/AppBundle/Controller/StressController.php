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
            WHERE t.adress = :adress'
        )->setParameter('adress', $adress);

        $tests_result=$query->getResult();

        return $this->render('stress/details.html.twig',array(
            'tests' => $tests_result
        ));

    }

    /**
     * @Route("/delete/{id}", name="stress_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
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
        $output = shell_exec('\xampp\apache\bin\ab.exe -n 10 -c 2 -w http://'.$adress.'/');
        $output = str_replace("<p>", '', $output);
        $output = str_replace("This is ApacheBench, Version 2.3 <i>&lt;\$Revision: 1757674 \$&gt;</i><br>", '', $output);
        $output = str_replace("Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/<br>", '', $output);
        $output = str_replace("Licensed to The Apache Software Foundation, http://www.apache.org/<br>", '', $output);
        $output = str_replace("</p>", '', $output);
        $output = str_replace("..done", '', $output);
        //die($output);

        $date = new\DateTime('now');

        $test  = new Test();

        $test
            ->setAdress($adress)
            ->setAb($output)
            ->setDate($date);

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
