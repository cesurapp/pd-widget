<?php

/**
 * This file is part of the pdAdmin pdWidget package.
 *
 * @package     pdWidget
 *
 * @author      Ramazan APAYDIN <iletisim@ramazanapaydin.com>
 * @copyright   Copyright (c) 2018 Ramazan APAYDIN
 * @license     LICENSE
 *
 * @link        https://github.com/rmznpydn/pd-widget
 */

namespace Pd\WidgetBundle\Builder;

/**
 * Item Builder.
 *
 * @author  Ramazan Apaydın <iletisim@ramazanapaydin.com>
 */
class Item implements ItemInterface
{
    /**
     * @var mixed
     */
    private $id;

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var string
     */
    private $content = '';

    /**
     * @var null
     */
    private $template = '';

    /**
     * @var callable
     */
    private $data = null;

    /**
     * @var int
     */
    private $order = null;

    /**
     * @var array;
     */
    private $role = [];

    /**
     * @var string
     */
    private $group = '';

    /**
     * @var bool
     */
    private $active = false;

    /**
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template)
    {
        $this->template = $template;

        return $this;
    }

    public function getData()
    {
        if (null !== $this->data) {
            $data = $this->data;

            return $data();
        }

        return false;
    }

    public function setData(callable $data)
    {
        $this->data = $data;

        return $this;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder(int $order)
    {
        $this->order = $order;

        return $this;
    }

    public function getRole(): array
    {
        return $this->role;
    }

    public function setRole(array $role)
    {
        $this->role = $role;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $status)
    {
        $this->active = $status;

        return $this;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function setGroup(string $name)
    {
        $this->group = $name;

        return $this;
    }
}
