<?php

class Response
{
    private $code;
    private $headers;
    private $body;
    private $format;

    public function __construct($code = '200', $headers = null, $body = null, $format = 'json')
    {
        $this->code = $code;
        $this->headers = $headers;
        $this->body = $body;
        $this->format = $format;
    }

    public function generate()
    {

        switch ($this->format)
        {
            case 'json':

                if (!empty($this->body))
                {
                    $this->headers['Content-Type'] = "application/json";
                    $this->body = json_encode($this->body);
                }
                break;
            case 'xml':
                if (!empty($this->body))
                {
                    $this->headers['Content-Type'] = "text/xml";
                }
                break;
            case 'unsupported':
                if ($this->body != null)
                {
                    $this->code = '406';
                    $this->body = null;
                }
        }

        http_response_code($this->code);
        if (isset($this->headers))
        {
            foreach ($this->headers as $key => $value)
            {
                header($key . ': ' . $value);
            }
        }
        if (!empty($this->body))
        {
            echo $this->body;
        }
    }

    private function xml_encode($mixed, $domElement=null, $DOMDocument=null)
    {
        if (is_null($DOMDocument))
        {
            $DOMDocument =new DOMDocument;
            $DOMDocument->formatOutput = true;
            $this->xml_encode($mixed, $DOMDocument, $DOMDocument);
            echo $DOMDocument->saveXML();
        }
        else
        {
            if (is_array($mixed))
            {
                foreach ($mixed as $index => $mixedElement)
                {
                    if (is_int($index))
                    {
                        if ($index === 0)
                        {
                            $node = $domElement;
                        }
                        else
                        {
                            $node = $DOMDocument->createElement($domElement->tagName);
                            $domElement->parentNode->appendChild($node);
                        }
                    }
                    else
                    {
                        $plural = $DOMDocument->createElement($index);
                        $domElement->appendChild($plural);
                        $node = $plural;
                        if (!(rtrim($index, 's') === $index))
                        {
                            $singular = $DOMDocument->createElement(rtrim($index, 's'));
                            $plural->appendChild($singular);
                            $node = $singular;
                        }
                    }

                    $this->xml_encode($mixedElement, $node, $DOMDocument);
                }
            }
            else
            {
                $domElement->appendChild($DOMDocument->createTextNode($mixed));
            }
        }
    }

}