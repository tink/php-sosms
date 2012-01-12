<?php
namespace SoSMS;

use Exception;

require_once realpath(__DIR__.'/Record.php');
require_once realpath(__DIR__.'/Configuration.php');
require_once realpath(__DIR__.'/Connection.php');
require_once realpath(__DIR__.'/Version.php');
require_once realpath(__DIR__.'/Exception.php');
require_once realpath(__DIR__.'/Message.php');
require_once realpath(__DIR__.'/MessageDispach.php');
require_once realpath(__DIR__.'/Balance.php');

/**
 * SoSMS client class.
 *
 * @package		SoSMS
 * @author		Tink! <contato@tink.com.br>
 * @copyright	(c) 2012 Tink!
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class Client
{
    protected $configuration;
    protected $connection;

    /**
     * Build the Client with the SoSMS Configuration.
     *
     * @throws SoSMS\Exception
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $configuration->verify();

        $this->configuration = $configuration;
        $this->connection = new Connection($configuration);
    }

    /**
     * Returns the balance with the ammout of credits remaining in the account
     *
     * @throws SoSMS\Exception
     * @return SoSMS\Balance
     */
    public function getBalance()
    {
        $xml = $this->connection->getBalance();
        return Balance::fromXml($xml);
    }

    /**
     * Returns the message with the given Id
     *
     * @param id
     *
     * @throws SoSMS\Exception
     *
     * @return SoSMS\Message
     */
    public function getMessage($id)
    {
        $xml = $this->connection->getMessage($id);
        return Message::fromXml($xml);
    }

    /**
     * Send a message to contacts
     *
     * @param text The text message. Should be 140 chars at max.
     * @param contacts A string representing the contacts list in the format: "FirstContact:1188888888,SecondContact:2299999999". The name and the phone number should be separated by ':', and contacts by ';'.
     *
     * @throws SoSMS\Exception
     *
     * @return SoSMS\Message
     */
    public function sendMEssage($text, $contacts)
    {
        $xml = $this->connection->sendMessage($text, $contacts);
        return Message::fromXml($xml);
    }
}
?>
