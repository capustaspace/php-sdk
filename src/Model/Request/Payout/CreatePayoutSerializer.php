<?php


namespace Capusta\SDK\Model\Request\Payout;


use Capusta\SDK\Model\Request\AbstractRequestSerializer;

class CreatePayoutSerializer extends AbstractRequestSerializer
{
    /**
     * @inheritDoc
     */
    public function getSerializedData()
    {
        /** @var CreatePayoutRequest $payoutRequest */
        $payoutRequest = $this->request;
        $id = $payoutRequest->getId();
        $amount = $payoutRequest->getAmount();
        $description = $payoutRequest->getDescription();
        $pan = $payoutRequest->getPan();
        $projectCode = $payoutRequest->getProjectCode();
        $projectId = $payoutRequest->getProjectId();
        $serializedCreatePayout = [];


        if ($id) {
            $serializedCreatePayout['id'] = $id;
        }

        $serializedCreatePayout['amount'] = [
            'currency' => $amount->getCurrency(),
            'amount' => $amount->getAmount(),
        ];
        if ($description) {
            $serializedCreatePayout['description'] = $description;
        }
        if ($projectId) {
            $serializedCreatePayout['projectId'] = $projectId;
        }
        if ($projectCode) {
            $serializedCreatePayout['projectCode'] = $projectCode;
        }

        $serializedCreatePayout['pan'] = $pan;

        return $serializedCreatePayout;
    }
}
