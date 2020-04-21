<?php


namespace Capusta\SDK\Model\Request\Project;


use Capusta\SDK\Model\Request\AbstractRequestSerializer;

class CreateProjectSerializer extends AbstractRequestSerializer
{
    /**
     * @inheritDoc
     */
    public function getSerializedData()
    {
        /** @var CreateProjectRequest $projectRequest */
        $projectRequest = $this->request;

        return [
            'email' => $projectRequest->getEmail(),
            'projectLink' => $projectRequest->getProjectLink(),
            'callbackUrl' => $projectRequest->getCallbackUrl(),
            'failUrl' => $projectRequest->getFailUrl(),
            'successUrl' => $projectRequest->getSuccessUrl()
        ];
    }
}
