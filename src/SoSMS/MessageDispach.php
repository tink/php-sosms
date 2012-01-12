<?php
namespace SoSMS;

use SimpleXMLElement;

/**
 * SoSMS message dispach class.
 *
 * @package		SoSMS
 * @author		Tink! <contato@tink.com.br>
 * @copyright	(c) 2012 Tink!
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class MessageDispach extends Record
{
    protected $_status;
    protected $_phoneNumber;

    public function fromXml($xml)
    {
        $target = (isset($this)) ? $this : new MessageDispach();

        $xml = new SimpleXMLElement($xml);
        $target->status = $xml->status;
        $target->phoneNumber = $xml->{"phone-number"};

        return $target;
    }
}
?>
