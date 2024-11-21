<?php

namespace App\Controller;

use App\Entity\Employees;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\EmployeesRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EmployeesType;
use Doctrine\ORM\EntityManagerInterface;


class EmployeesController extends AbstractController
{
    #[Route('/employees', name: 'app_employees')]
    public function index(EmployeesRepository $employee): Response
    {
        return $this->render('employees/index.html.twig', [
            'employees' => $employee->findAll(),
        ]);
    }

    #[Route('/employees/add', name: 'app_employees_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $employee = new Employees();
        $form = $this->createForm(EmployeesType::class, $employee);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $employee = $form->getData();

            // Dice a Doctrine che vuoi salvare o aggiornare l'entità $employee nel database.
            // Doctrine prepara il processo di persistenza, ma non esegue ancora l'operazione.
            $entityManager->persist($employee);

            // Salva nel database
            $entityManager->flush();

            // Aggiunge un messaggio "flash", che è un messaggio temporaneo mostrato solo nella prossima richiesta HTTP.
            $this->addFlash('success', 'Your new employee have been updated');

            return $this->redirectToRoute('app_employees');

        }

        return $this->render('employees/add.html.twig', [
            'form' => $form->createView(),  // Passa il form come una vista
        ]);
        
    }

    #[Route('/employees/{employee}', name: 'app_employees_show_information')]
    public function showOne(Employees $employee): Response
    {
        return $this->render('employees/show_information.html.twig', [
            'employee' => $employee,
        ]);
    }
}
