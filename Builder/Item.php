<?php

/**
 * This file is part of the pd-admin pd-widget package.
 *
 * @package     pd-widget
 * @license     LICENSE
 * @author      Ramazan APAYDIN <apaydin541@gmail.com>
 * @link        https://github.com/appaydin/pd-widget
 */

namespace Pd\WidgetBundle\Builder;

use Symfony\Component\HttpFoundation\Request;

/**
 * Widget Item Builder.
 *
 * @author Ramazan APAYDIN <apaydin541@gmail.com>
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
    private $data;

    /**
     * @var array
     */
    private $config;

    /**
     * @var callable
     */
    private $configProcess;

    /**
     * @var int
     */
    private $order;

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
     * @var int|bool
     */
    private $cacheExpires;

    /**
     * @param mixed $id
     * @param int $cacheExpires
     */
    public function __construct($id, $cacheExpires = 3600)
    {
        $this->id = $id;
        $this->cacheExpires = $cacheExpires;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ItemInterface
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): ItemInterface
    {
        $this->description = $description;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): ItemInterface
    {
        $this->content = $content;

        return $this;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function setTemplate(string $template): ItemInterface
    {
        $this->template = $template;

        return $this;
    }

    public function getData()
    {
        if (null !== $this->data) {
            $data = $this->data;

            return $data($this->config);
        }

        return false;
    }

    public function setData(callable $data): ItemInterface
    {
        $this->data = $data;

        return $this;
    }

    public function getConfig(): ?array
    {
        return $this->config;
    }

    public function setConfig(array $config): ItemInterface
    {
        $this->config = $config;

        return $this;
    }

    public function getConfigProcess(Request $request): ?array
    {
        if (null !== $this->configProcess) {
            $data = $this->configProcess;

            return $data($request);
        }

        return null;
    }

    public function setConfigProcess(callable $process): ItemInterface
    {
        $this->configProcess = $process;

        return $this;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(int $order): ItemInterface
    {
        $this->order = $order;

        return $this;
    }

    public function getRole(): array
    {
        return $this->role;
    }

    public function setRole(array $role): ItemInterface
    {
        $this->role = $role;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $status): ItemInterface
    {
        $this->active = $status;

        return $this;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function setGroup(string $name): ItemInterface
    {
        $this->group = $name;

        return $this;
    }

    public function getCacheTime()
    {
        return $this->cacheExpires;
    }

    public function setCacheTime($cacheExpires): ItemInterface
    {
        $this->cacheExpires = $cacheExpires;

        return $this;
    }
}
