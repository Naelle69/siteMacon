<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisForm; 
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AvisController extends AbstractController
{
    #[Route('/mes-avis', name: 'user_avis')]
    public function userAvis(
        Request $request,
        EntityManagerInterface $em,
        PaginatorInterface $paginator,
        AvisRepository $avisRepository
    ): Response {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $avis = new Avis();
        $avis->setUser($user);

        $form = $this->createForm(AvisForm::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($avis);
            $em->flush();
            $this->addFlash('success', 'Votre avis a bien été enregistré.');
            return $this->redirectToRoute('user_avis');
        }

        // Récupère uniquement les avis de l'utilisateur connecté
        $avisQuery = $avisRepository->createQueryBuilder('a')
            ->where('a.user = :user')
            ->setParameter('user', $user)
            ->orderBy('a.id', 'DESC')
            ->getQuery();

        $pagination = $paginator->paginate(
            $avisQuery,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('avis/user_avis.html.twig', [
            'pagination' => $pagination,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/avis/delete/{id}', name: 'avis_delete', methods: ['POST'])]
    public function deleteAvis(Avis $avis, EntityManagerInterface $em): RedirectResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if ($avis->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas supprimer cet avis.');
        }

        $em->remove($avis);
        $em->flush();

        $this->addFlash('success', 'Avis supprimé avec succès.');

        return $this->redirectToRoute('user_avis');
    }

    #[Route('/avis/delete-all', name: 'avis_delete_all', methods: ['POST'])]
    public function deleteAllAvis(EntityManagerInterface $em): RedirectResponse
    {
        $user = $this->getUser();

        foreach ($user->getAvis() as $avis) {
            $em->remove($avis);
        }

        $em->flush();

        $this->addFlash('success', 'Tous vos avis ont été supprimés.');

        return $this->redirectToRoute('user_avis');
    }
}