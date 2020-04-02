<?php

namespace Playbloom\Satisfy\Controller;

use Playbloom\Satisfy\Http\ProcessResponse;
use Playbloom\Satisfy\Runner\SatisBuildRunner;
use Symfony\Component\HttpFoundation\Response;

class SatisController extends AbstractProtectedController
{
    public function buildAction(): Response
    {
        $this->checkAccess();

        return $this->render('@PlaybloomSatisfy/satis_build.html.twig');
    }

    public function buildRepositoryAction(string $repositoryId): Response
    {
        $this->checkAccess();

        return $this->render('@PlaybloomSatisfy/satis_build.html.twig', ['repositoryId' => $repositoryId]);
    }

    public function buildRunAction(): Response
    {
        $this->checkAccess();

        $runner = $this->container->get(SatisBuildRunner::class);
        $output = $runner->run();

        return ProcessResponse::createFromOutput($output);
    }

    public function buildRunRepositoryAction(string $repositoryId): Response
    {
        $this->checkAccess();

        $runner = $this->container->get(SatisBuildRunner::class);
        $output = $runner->run($repositoryId);

        return ProcessResponse::createFromOutput($output);
    }
}
