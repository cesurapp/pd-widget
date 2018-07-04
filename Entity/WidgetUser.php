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

namespace Pd\WidgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Pd\WidgetBundle\Repository\WidgetUserRepository")
 * @ORM\Table(name="widget_user")
 *
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
     *
     * @return int
     */
    public function getId()
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
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Get config.
     *
     * @return array
     */
    public function getConfig()
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
    public function addWidgetConfig(string $widgetId, array $config = [])
    {
        $this->config[$widgetId] = array_merge($this->config[$widgetId] ?? [], $config);

        return $this;
    }

    /**
     * Remove Widget Config.
     *
     * @param string $widgetId
     * @param array $ids
     *
     * @return $this
     */
    public function removeWidgetConfig(string $widgetId, array $config = [])
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
     * @return WidgetUser
     */
    public function setOwner($owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner.
     *
     * @return UserInterface|null
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
