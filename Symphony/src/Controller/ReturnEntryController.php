<?php

namespace App\Controller;

use App\Entity\ReturnEntry;
use App\Form\ReturnEntryType;
use App\Repository\ReturnEntryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/returnEntry')]
final class ReturnEntryController extends AbstractController
{
    #[IsGranted("ROLE_USER")]
    #[Route(name: 'app_return_entry_index', methods: ['GET'])]
    public function index(Request $request, ReturnEntryRepository $returnEntryRepository): Response
    {
        $filters = [
            'id' => $request->query->get('id'),
            'returnedAt' => $request->query->get('returnedAt'),
        ];

        $page = max(1, (int) $request->query->get('page', 1));
        $limit = max(1, (int) $request->query->get('itemsPerPage', 10));

        $paginator = $returnEntryRepository->findByFilters($filters, $page, $limit);

        return $this->render('return_entry/index.html.twig', [
            'return_entries' => $paginator['items'],
            'totalPages' => $paginator['totalPages'],
            'currentPage' => $page,
            'itemsPerPage' => $limit,
            'filters' => $filters,
        ]);
    }

    #[IsGranted("ROLE_ADMIN")]
    #[Route('/new', name: 'app_return_entry_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $returnEntry = new ReturnEntry();
        $form = $this->createForm(ReturnEntryType::class, $returnEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($returnEntry);
            $entityManager->flush();

            return $this->redirectToRoute('app_return_entry_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('return_entry/new.html.twig', [
            'return_entry' => $returnEntry,
            'form' => $form,
        ]);
    }

    #[IsGranted("ROLE_USER")]
    #[Route('/{id}', name: 'app_return_entry_show', methods: ['GET'])]
    public function show(ReturnEntry $returnEntry): Response
    {
        return $this->render('return_entry/show.html.twig', [
            'return_entry' => $returnEntry,
        ]);
    }

    #[IsGranted("ROLE_ADMIN")]
    #[Route('/{id}/edit', name: 'app_return_entry_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReturnEntry $returnEntry, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReturnEntryType::class, $returnEntry);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_return_entry_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('return_entry/edit.html.twig', [
            'return_entry' => $returnEntry,
            'form' => $form,
        ]);
    }

    #[IsGranted("ROLE_ADMIN")]
    #[Route('/{id}', name: 'app_return_entry_delete', methods: ['POST'])]
    public function delete(Request $request, ReturnEntry $returnEntry, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$returnEntry->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($returnEntry);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_return_entry_index', [], Response::HTTP_SEE_OTHER);
    }
}
