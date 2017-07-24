<?php

class SRenderer
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

    public function render(array $data)
    {
        foreach ($data as $key => $value) {
            $this->setVar($key, $value);
        }
        return $this->template;
    }

    public function print()
    {
        echo $this->template;
    }
}
