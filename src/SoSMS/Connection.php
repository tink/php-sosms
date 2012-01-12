<?php
namespace SoSMS;

/**
 * SoSMS connection class.
 *
 * @package		SoSMS
 * @author		Tink! <contato@tink.com.br>
 * @copyright	(c) 2012 Tink!
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class Connection
{
    const SERVICE_URL = 'http://sosms.com.br/api/';
    protected $configuration = null;
    protected $headers = array();

    /**
     * Build the object with the sosms Configuration.
     *
     * @param SoSMS\Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;

        $this->addHeader(array(
          'Accept: text/xml, application/xml'
        ));
    }

    /**
     * Add a header to the connection.
     *
     * @param string header
     */
    public function addHeader($header)
    {
        $this->headers += (array)$header;
    }

    /**
      * Returns the XML of account credits service
      * @return string
      **/
    public function getBalance()
    {
        $curl = curl_init();

        $serviceUrl = self::SERVICE_URL . 'users/credits.xml?auth_token=' . $this->configuration->authToken;
        curl_setopt($curl, CURLOPT_URL, $serviceUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $return = curl_exec($curl);
        curl_close($curl);

        return $return;
    }

    /**
      * Returns the XML of message service
      * @param id
      * @return string
      **/
    public function getMessage($id)
    {
        $curl = curl_init();

        $serviceUrl = self::SERVICE_URL . 'messages/' . $id . '.xml?auth_token=' . $this->configuration->authToken;
        curl_setopt($curl, CURLOPT_URL, $serviceUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $return = curl_exec($curl);
        curl_close($curl);

        return $return;
    }

    /**
      * Posts a new message returning the response XML
      * @param text
      * @param contacts
      * @return string
      **/
    public function sendMessage($text, $contacts)
    {
        $curl = curl_init();

        $serviceUrl = self::SERVICE_URL . 'messages.xml?auth_token=' . $this->configuration->authToken;
        $fields = "message[text]=" . $text;
        $fields .= "&message[contacts]=" . $contacts;
        curl_setopt($curl, CURLOPT_URL, $serviceUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, utf8_encode($fields));
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $return = curl_exec($curl);
        curl_close($curl);
        return $return;
    }
}
?>
