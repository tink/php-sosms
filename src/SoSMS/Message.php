<?php
namespace SoSMS;
use SimpleXMLElement;

/**
 * SoSMS message class.
 *
 * @package		SoSMS
 * @author		Tink! <contato@tink.com.br>
 * @copyright	(c) 2012 Tink!
 * @license		http://www.opensource.org/licenses/mit-license.php
 */
class Message extends Record
{
    protected $_id;
    protected $_text;
    protected $_dispaches;

    public function fromXml($xml)
    {
        $target = (isset($this)) ? $this : new Message();

        $xml = new SimpleXMLElement($xml);
        $target->id = $xml->id;
        $target->text = $xml->text;
        $target->dispaches = array();
        foreach($xml->{"message-dispaches"}->{"message-dispach"} as $dispach) {
            array_push($target->dispaches, MessageDispach::fromXml($dispach->asXml()));
        }

        return $target;
    }
}
?>
