<?php

/**
 * This file is part of the pd-admin pd-widget package.
 *
 * @package     pd-widget
 * @license     LICENSE
 * @author      Ramazan APAYDIN <apaydin541@gmail.com>
 * @link        https://github.com/appaydin/pd-widget
 */

namespace Pd\WidgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Widget Private User Data.
 *
 * @ORM\Entity(repositoryClass="Pd\WidgetBundle\Repository\WidgetUserRepository")
 * @ORM\Table(name="widget_user")
 *
 * @author Ramazan APAYDIN <apaydin541@gmail.com>
 */
class WidgetUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $config;

    /**
     * @ORM\OneToOne(targetEntity="UserInterface")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", unique=true, onDelete="CASCADE")
     */
    private $owner;

    /**
     * Get id.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set config.
     *
     * @param array $config
     *
     * @return WidgetUser
     */
    public function setConfig($config): self
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Get config.
     */
    public function getConfig(): ?array
    {
        return $this->config;
    }

    /**
     * Add Widget Config.
     *
     * @param string $widgetId
     * @param array $config
     *
     * @return $this
     */
    public function addWidgetConfig(string $widgetId, array $config = []): self
    {
        $this->config[$widgetId] = array_merge($this->config[$widgetId] ?? [], $config);

        return $this;
    }

    /**
     * Remove Widget Config.
     *
     * @param string $widgetId
     * @param array $config
     *
     * @return $this
     */
    public function removeWidgetConfig(string $widgetId, array $config = []): self
    {
        foreach ($config as $id => $content) {
            if (isset($this->config[$widgetId][$id])) {
                unset($this->config[$widgetId][$id]);
            }
        }

        return $this;
    }

    /**
     * Set owner.
     *
     * @param UserInterface|null $owner
     *
     * @return $this
     */
    public function setOwner($owner = null): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner.
     */
    public function getOwner(): ?UserInterface
    {
        return $this->owner;
    }
}
