<?php

/**
 * @Author Chiarillo Massimo
 */

namespace Yandex\TranslatorBundle\Model;

class Key
{
    protected $id;

    protected $value;

    protected $requests;

    protected $enabled = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param  mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @param  ArrayCollection $requests
     * @return $this
     */
    public function setRequests(ArrayCollection $requests)
    {
        $this->requests = $requests;

        return $this;
    }

    public function addRequest(Request $request)
    {
        $this->requests->add($request);

        return $this;
    }

    public function removeRequest(Request $request)
    {
        $this->requests->removeElement($request);

        return $this;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }
}

