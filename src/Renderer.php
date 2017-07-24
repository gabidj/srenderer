<?php

class Renderer
{
    protected $template = '';

    public function setFile($filename)
    {
        if (file_exists($filename)) {
            $this->template = file_get_contents($filename);
            return true;
        }
        // else throw exception or whatever
        return false;
    }

    public function setVar($key, $value)
    {
        // rc = replace count
        $rc = 0;
        $this->template = str_replace('{'.$key.'}', $value, $this->template, $rc);
        return $rc;
    }

    public function render(array $data, $subKey='')
    {
        if ($subKey != '') {
            $subKey .= '.';
        }
        if (!is_array($data)) {
            trigger_error("data is not an array", E_WARNING)
            return false;
        }

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $this->render($value, $subKey . $key);
            } else {
                $this->setVar($key, $value);
            }
        }
        return $this->template;
    }

    public function print()
    {
        echo $this->template;
    }
}
