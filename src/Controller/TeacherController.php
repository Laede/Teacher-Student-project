<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Form\TeacherType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/teacher")
 */
class TeacherController extends Controller
{
    /**
     * @Route("/", name="teacher_index", methods="GET")
     */
    public function index(): Response
    {
        $teachers = $this->getDoctrine()
            ->getRepository(Teacher::class)
            ->findAll();

        return $this->render('teacher/index.html.twig', ['teachers' => $teachers]);
    }

    /**
     * @Route("/new", name="teacher_new", methods="GET|POST")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $teacher = new Teacher();
        $form = $this->createForm(TeacherType::class, $teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($teacher,$teacher->getPlainPassword());
            $teacher->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($teacher);
            $em->flush();

            return $this->redirectToRoute('teacher_index');
        }

        return $this->render('teacher/new.html.twig', [
            'teacher' => $teacher,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="teacher_show", methods="GET")
     */
    public function show(Teacher $teacher): Response
    {
        return $this->render('teacher/show.html.twig', ['teacher' => $teacher]);
    }

    /**
     * @Route("/{id}/edit", name="teacher_edit", methods="GET|POST")
     */
    public function edit(Request $request, Teacher $teacher): Response
    {
        $form = $this->createForm(TeacherType::class, $teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('teacher_edit', ['id' => $teacher->getId()]);
        }

        return $this->render('teacher/edit.html.twig', [
            'teacher' => $teacher,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="teacher_delete", methods="DELETE")
     */
    public function delete(Request $request, Teacher $teacher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$teacher->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($teacher);
            $em->flush();
        }

        return $this->redirectToRoute('teacher_index');
    }
}
