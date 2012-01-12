<?php
namespace SoSMS;
use SimpleXMLElement;
use SoSMS\Exception as SoSMSException;

/**
 * SoSMS balance class.
 *
 * @package		SoSMS
 * @author		Tink! <contato@tink.com.br>
 * @copyright	(c) 2012 Tink!
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class Balance extends Record
{
    protected $_value;

    public function fromXml($xml)
    {
        $target = (isset($this)) ? $this : new Balance();

        $xml = new SimpleXMLElement($xml);
        if($xml->error) {
            throw new SoSMSException($xml);
        } else {
            $target->value = $xml->value[0];
        }

        return $target;
    }
}
?>
