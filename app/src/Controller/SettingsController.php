<?php
/**
 * Task controller.
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use App\Form\Type\ChangePasswordType;
use App\Security\LoginFormAuthenticator;
use App\Service\UserServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class TaskController.
 */

class SettingsController extends AbstractController
{
    /**
     * Task service.
     */
    private UserServiceInterface $userService;

    /**
     * Translator.
     */
    private TranslatorInterface $translator;

    /**
     * Constructor.
     *
     * @param UserServiceInterface $userService User service
     * @param TranslatorInterface  $translator  Translator
     */
    public function __construct(UserServiceInterface $userService, TranslatorInterface $translator)
    {
        $this->userService = $userService;
        $this->translator = $translator;
    }

    /**
     * Index action.
     *
     * @param Request $request HTTP Request
     *
     * @return Response HTTP response
     */
    #[Route('settings/{id}', name: 'settings_index', methods: 'GET')]
    public function index(): Response
    {
        return $this->render('settings/index.html.twig');
    }

    /**
     * Edit action.
     *
     * @param Request $request HTTP request
     * @param User    $user    User entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/edit', name: 'settings_edit', requirements: ['id' => '[1-9]\d*'], methods: 'GET|PUT')]
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user, [
            'method' => 'PUT',
            'action' => $this->generateUrl('settings_edit', ['id' => $user->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->save($user);

            $this->addFlash(
                'success',
                $this->translator->trans('message.edited_successfully')
            );

            return $this->redirectToRoute('settings_index', ['id' => $user->getId()]);
        }

        return $this->render('settings/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    /**
     * Edit action.
     *
     * @param Request $request HTTP request
     * @param User    $user    User entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/change_password', name: 'settings_change_password', requirements: ['id' => '[1-9]\d*'], methods: 'GET|PUT')]
    public function change_password(Request $request, User $user, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChangePasswordType::class, $user, [
            'method' => 'PUT',
            'action' => $this->generateUrl('settings_change_password', ['id' => $user->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'success',
                $this->translator->trans('message.password_changed_successfully')
            );

            return $this->redirectToRoute('settings_index', ['id' => $user->getId()]);
        }

        return $this->render('settings/change_password.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}