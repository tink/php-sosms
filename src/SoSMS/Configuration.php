<?php
namespace SoSMS;

require_once 'Record.php';

use SoSMS\Exception as SoSMSException;

/**
 * SoSMS configuration class.
 *
 * @package		SoSMS
 * @author		Tink! <contato@tink.com.br>
 * @copyright	(c) 2012 Tink!
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class Configuration extends Record
{
    protected $_authToken;

    /**
     * Load the given data array to the record.
     *
     * @param string $authToken
     */
    public function __construct($authToken)
    {
        $this->authToken = $authToken;
    }


    /**
     * Verify that the configuration is complete.
     *
     * @throws SoSMS\Exception
     */
    public function verify()
    {
        if (!$this->authToken) {
            throw new SoSMSException('Cannot initialize the SoSMS client without an AuthToken being set to the configuration.');
        }
    }
}
