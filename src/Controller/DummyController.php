<?php

/*
 * This file is part of the functionnal-testing package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;

class DummyController extends Controller
{
    /**
     * @Route("/dummy")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function formAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, [
                'constraints' => [new Email()],
            ])
            ->add('name')
        ->getForm();
        $form->handleRequest($request);
//        sleep(2);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Message envoyé');
        }

        return $this->render('dummy/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
