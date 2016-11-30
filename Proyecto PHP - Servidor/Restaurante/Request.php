<?php

class Request
{
    private $url_elements;
    private $query_string;
    private $verb;
    private $body_parameters;
    private $format;
    private $accept;

    public function __construct($verb, $url_elements, $query_string, $body, $content_type, $accept)
    {
        $this->verb = $verb;
        $this->url_elements = $url_elements;
        $this->query_string = $query_string;
        $this->parseBody($body, $content_type);

        switch ($accept)
        {
            case 'application/json':
            case '*/*':
            case null:
                $this->accept = 'json';
                break;
            case 'application/xml':
            case 'text/xml':
                $this->accept = 'xml';
                break;
            default:
                $this->accept = 'unsupported';
                break;
        }


        return true;
    }

    private function parseBody($body, $content_type)
    {
        $parameters = array();

        switch ($content_type)
        {
            case "application/json":
                $this->format = "json";
                $parameters = json_decode($body);
                break;
            case "application/x-www-form-urlencoded":
                $this->format = "html";
                parse_str($body, $parameters);
                break;
            default:
                break;
        }
        $this->body_parameters = $parameters;

    }

    public function getUrlElements()
    {
        return $this->url_elements;
    }

    public function setUrlElements($url_elements)
    {
        $this->url_elements = $url_elements;
    }

    public function getQueryString()
    {
        return $this->query_string;
    }

    public function setQueryString($query_string)
    {
        $this->query_string = $query_string;
    }

    public function getVerb()
    {
        return $this->verb;
    }

    public function setVerb($verb)
    {
        $this->verb = $verb;
    }

    public function getBodyParameters()
    {
        return $this->body_parameters;
    }

    public function setBodyParameters($body_parameters)
    {
        $this->body_parameters = $body_parameters;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format)
    {
        $this->format = $format;
    }

    public function getAccept()
    {
        return $this->accept;
    }

    public function setAccept($accept)
    {
        $this->accept = $accept;
    }
}