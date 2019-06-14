<?php
/**
 * Created by PhpStorm.
 * User: K2
 * Date: 7-6-2019
 * Time: 11:38
 */

namespace AppBundle\Controller;

use AppBundle\Form\AccountType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use symfony\Component\Form\Form;
use symfony\Component\Form\FormError;

class IjsmakerController extends Controller
{
    /**
     * @Route("/ijsmaker", name="ijsmaker")
     */
    public function indexAction()
    {
        return $this->render('ijsmaker/index.html.twig', array(
            'link' => 'home'
        ));
    }

    /**
     * @Route("/wijzigwachtwoord", name="wijzigWachtwoord")
     */
    public function wijzigWachtwoordAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $passwordEncoder = $this->get('security.password_encoder');
            $oldPassword = $form->get('oldPassword')->getData();
            $plainPassword = $form->get('plainPassword')->getData();

            if($passwordEncoder->isPasswordValid($user, $oldPassword))
            {
                $newEncodedPassword = $passwordEncoder->encodePassword($user, $plainPassword);
                $user->setPassword($newEncodedPassword);

                $em->persist($user);
                $em->flush();

                $this->addFlash('notice', 'Uw wachtwoord is gewijzigd');

                return $this->redirectToRoute('ijsmaker');
            }
            else
            {
                $form->addError(new FormError('Oude wachtwoord is niet correct!'));
            }
        }
            return $this->render('ijsmaker/editPassword.html.twig', array(
            'form' => $form->createView(),
            'link' => 'home'
            ));
    }
//
//    /**
//     * @Route("/resetwachtwoord", name="resetWachtwoord")
//     */
//    public function resetWachtwoordAction(Request $request)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $user = $this->getUser();
//        $form = $this->createForm(AccountType::class, $user);
//
//        $form->handleRequest($request);
//        if($form->isSubmitted() && $form->isValid())
//        {
//            $passwordEncoder = $this->get('security.password_encoder');
//            $oldPassword = $form->get('oldPassword')->getData();
//            $plainPassword = $form->get('plainPassword')->getData();
//
//            if($passwordEncoder->isPasswordValid($user, $oldPassword))
//            {
//                $newEncodedPassword = $passwordEncoder->encodePassword($user, $plainPassword);
//                $user->setPassword($newEncodedPassword);
//
//                $em->persist($user);
//                $em->flush();
//
//                $this->addFlash('notice', 'Uw wachtwoord is gewijzigd');
//
//                return $this->redirectToRoute('ijsmaker_index');
//            }
//            else
//            {
//                $form->addError(new FormError('Oude wachtwoord is niet correct!'));
//            }
//        }
//
//        return $this->render('ijsmaker/editPassword.html.twig', array(
//            'form' => $form->createView(),
//            'link' => 'home'
//        ));
//    }
}