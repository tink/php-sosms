<?php
namespace SoSMS;

/**
 * SoSMS exception.
 *
 * @package		SoSMS
 * @author		Tink! <contato@tink.com.br>
 * @copyright	(c) 2012 Tink!
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class Exception extends \Exception
{
    /**
     * Generates an exception given an SoSMS error XML
     * @param xml
     * @throws SoSMS\Exception
     **/
    public function __construct($xml)
    {
        if(is_string($xml)) {
          parent::__construct($xml);
        } else {
          $error_messages = '';
          foreach($xml->error as $error) {
            $error_messages .= $error;
          }
          parent::__construct(utf8_decode($error_messages));
        }
    }
}
?>
