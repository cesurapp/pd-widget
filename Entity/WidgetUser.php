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
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
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
     * @ORM\JoinColumn(referencedColumnName="id", unique=true, onDelete="CASCADE")
     */
    private $owner;

    /**
     * Get id.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setConfig(array $config): self
    {
        $this->config = $config;

        return $this;
    }

    public function getConfig(): ?array
    {
        return $this->config;
    }

    public function addWidgetConfig(string $widgetId, array $config = []): self
    {
        $this->config[$widgetId] = array_merge($this->config[$widgetId] ?? [], $config);

        return $this;
    }

    public function removeWidgetConfig(string $widgetId, array $config = []): self
    {
        foreach ($config as $id => $content) {
            if (isset($this->config[$widgetId][$id])) {
                unset($this->config[$widgetId][$id]);
            }
        }

        return $this;
    }

    public function getOwner(): ?UserInterface
    {
        return $this->owner;
    }

    public function setOwner($owner = null): self
    {
        $this->owner = $owner;

        return $this;
    }
}
