<?php
/**
 * Created by PhpStorm.
 * User: K2
 * Date: 17-5-2019
 * Time: 09:54
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Fruit;
use AppBundle\Entity\Recept;
use AppBundle\Entity\User;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use symfony\Component\Form\Form;

class AdminController extends Controller
{

    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/user", name="user")
     */
    public function userAction()
    {
        return $this->render('user/index.html.twig');
    }

    /**
     * Lists all fruit entities.
     *
     * @Route("/fruit", name="fruit_homepage")
     * @Method("GET")
     */
    public function FruitPageAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fruits = $em->getRepository('AppBundle:Fruit')->findAll();

        return $this->render('fruit/index.html.twig', array(
            'fruits' => $fruits,
        ));
    }

    /**
     * Creates a new fruit entity.
     *
     * @Route("/new/fruit", name="new_fruit")
     * @Method({"GET", "POST"})
     */
    public function newFruitAction(Request $request)
    {
        $fruit = new Fruit();
        $form = $this->createForm('AppBundle\Form\FruitType', $fruit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fruit);
            $em->flush();

            return $this->redirectToRoute('show_fruit', array('id' => $fruit->getId()));
        }

        return $this->render('fruit/new.html.twig', array(
            'fruit' => $fruit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fruit entity.
     *
     * @Route("/fruit/show/{id}", name="show_fruit")
     * @Method("GET")
     */
    public function showFruitAction(Fruit $fruit)
    {
        $deleteForm = $this->createDeleteFruitForm($fruit);

        return $this->render('fruit/show.html.twig', array(
            'fruit' => $fruit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fruit entity.
     *
     * @Route("/fruit/edit/{id}", name="edit_fruit")
     * @Method({"GET", "POST"})
     */
    public function editFruitAction(Request $request, Fruit $fruit)
    {
        $deleteForm = $this->createDeleteFruitForm($fruit);
        $editForm = $this->createForm('AppBundle\Form\FruitType', $fruit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('edit_fruit', array('id' => $fruit->getId()));
        }

        return $this->render('fruit/edit.html.twig', array(
            'fruit' => $fruit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fruit entity.
     *
     * @Route("/fruit/delete/{id}", name="delete_fruit")
     * @Method("DELETE")
     */
    public function deleteFruitAction(Request $request, $id)
    {
        $fruit = $this->getDoctrine()->getRepository(Fruit::class)->find($id);
//        $form = $this->createDeleteForm($fruit);
//        $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fruit);
            $em->flush();
//        }

        return $this->redirectToRoute('fruit_homepage');
    }

    /**
     * Creates a form to delete a fruit entity.
     *
     * @param Fruit $fruit The fruit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteFruitForm(Fruit $fruit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_fruit', array('id' => $fruit->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     * Lists all recept entities.
     *
     * @Route("/recept", name="recept_index")
     * @Method("GET")
     */
    public function indexReceptAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recepts = $em->getRepository('AppBundle:Recept')->findAll();

        return $this->render('recept/index.html.twig', array(
            'recepts' => $recepts,
        ));
    }

    /**
     * Creates a new recept entity.
     *
     * @Route("recept/new", name="new_recept")
     * @Method({"GET", "POST"})
     */
    public function newReceptAction(Request $request)
    {
        $recept = new Recept();
        $form = $this->createForm('AppBundle\Form\ReceptType', $recept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recept);
            $em->flush();

            return $this->redirectToRoute('show_recept', array('id' => $recept->getId()));
        }

        return $this->render('recept/new.html.twig', array(
            'recept' => $recept,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a recept entity.
     *
     * @Route("recept/show/{id}", name="show_recept")
     * @Method("GET")
     */
    public function showReceptAction(Recept $recept)
    {
        $deleteForm = $this->createDeleteReceptForm($recept);

        return $this->render('recept/show.html.twig', array(
            'recept' => $recept,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing recept entity.
     *
     * @Route("recept/edit/{id}", name="edit_recept")
     * @Method({"GET", "POST"})
     */
    public function editReceptAction(Request $request, Recept $recept)
    {
        $deleteForm = $this->createDeleteForm($recept);
        $editForm = $this->createForm('AppBundle\Form\ReceptType', $recept);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('edit_recept', array('id' => $recept->getId()));
        }

        return $this->render('recept/edit.html.twig', array(
            'recept' => $recept,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a recept entity.
     *
     * @Route("/recept/delete/{id}", name="delete_recept")
     * @Method("DELETE")
     */
    public function deleteReceptAction(Request $request, Recept $recept)
    {
        $form = $this->createDeleteForm($recept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($recept);
            $em->flush();
        }

        return $this->redirectToRoute('recept_index');
    }

    /**
     * Creates a form to delete a recept entity.
     *
     * @param Recept $recept The recept entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteReceptForm(Recept $recept)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_recept', array('id' => $recept->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     * @Route("/resetwachtwoord", name="resetWachtwoord")
     */
    public function resetWachtwoordAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(['username'=>'ijsmaker']);

            $passwordEncoder = $this->get('security.password_encoder');
            $plainPassword = 'qwerty';


                $newEncodedPassword = $passwordEncoder->encodePassword($user, $plainPassword);
                $user->setPassword($newEncodedPassword);
            try{
                $em->persist($user);
                $em->flush();

                $this->addFlash('notice', 'Uw wachtwoord is gereset');


            }
            catch(Exception $e)
            {
                $this->addFlash('notice', 'Oude wachtwoord is niet correct!');

            }
            return $this->redirectToRoute('admin');


    }

}