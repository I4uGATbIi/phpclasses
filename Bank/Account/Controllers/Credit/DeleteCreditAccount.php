<?php

namespace Bank\Account\Controllers\Credit;

use Bank\Account\CreditAccount;
use Bank\Services\Database;
use Bank\Services\Persistance\CantSaveException;
use Bank\Services\ControllerInterface;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityNotFoundException;

class DeleteCreditAccount implements ControllerInterface
{

    /**
     * @var CreditAccount
     */
    private $account;

    /**
     * @var \Katzgrau\KLogger\Logger
     */
    private $logger;

    /**
     * View constructor.
     * @param CreditAccount $account
     * @param \Katzgrau\KLogger\Logger $logger
     */
    public function __construct(
        CreditAccount $account,
        \Katzgrau\KLogger\Logger $logger
    )
    {
        $this->account = $account;
        $this->logger = $logger;
    }

    /**
     * @param $request
     * @param $response
     * @return mixed|string
     * @throws \Exception
     */
    public function execute($request, $response)
    {
        try {

            $this->account = Database::GetEntityManager()->getRepository(CreditAccount::class)
                ->find($request->id);
            if ($this->account->CheckForClosing()) {
                Database::GetEntityManager()->remove($this->account);
                Database::GetEntityManager()->flush();
                $answer = "Account closed!";//$response->redirect("/account/" . $this->account->getId());
            } else {
                $answer = "You cannot close account with negative balance";
            }
            $html = <<<HTML
<form>
    <label>{$answer}</label>
	<button type="submit" formaction="/">Home</button>
</form>

HTML;

            return $html;
        } catch (CantSaveException $e) {

            $this->logger->debug(
                $e->getMessage(), $e->getTrace());

            return "Sorry, the product can't be saved";
        } catch (\Bank\Services\SystemException $e) {

            $this->logger->debug(
                $e->getMessage(), $e->getTrace());

            return "Oops, something went wrong, Our team is looking for solution";
        }
    }
}