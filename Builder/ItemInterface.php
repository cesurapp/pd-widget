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
 * Widget Builder Interface.
 *
 * @author Ramazan APAYDIN <apaydin541@gmail.com>
 */
interface ItemInterface
{
    /**
     * Get Unique Item ID.
     *
     * @return mixed
     */
    public function getId();

    /**
     * Get Item Name.
     */
    public function getName(): string;

    /**
     * Set Item Name.
     *
     * @return ItemInterface
     */
    public function setName(string $name);

    /**
     * Get Item Description.
     */
    public function getDescription(): string;

    /**
     * Set Item Description.
     *
     * @return ItemInterface
     */
    public function setDescription(string $description);

    /**
     * Get Item Content.
     */
    public function getContent(): string;

    /**
     * Set Item Content.
     *
     * @return ItemInterface
     */
    public function setContent(string $content);

    /**
     * Get Item Template.
     */
    public function getTemplate(): string;

    /**
     * Set Item Template.
     *
     * @return ItemInterface
     */
    public function setTemplate(string $template);

    /**
     * Get Content Data.
     *
     * @return mixed
     */
    public function getData();

    /**
     * Set Content Data.
     *
     * @return ItemInterface
     */
    public function setData(callable $data);

    /**
     * @return array|null
     */
    public function getConfig();

    /**
     * @return ItemInterface
     */
    public function setConfig(array $config);

    /**
     * @return array
     */
    public function getConfigProcess(Request $request);

    /**
     * @return ItemInterface
     */
    public function setConfigProcess(callable $process);

    /**
     * Get Order Number.
     *
     * @return int|null
     */
    public function getOrder();

    /**
     * Set Order Number.
     *
     * @return ItemInterface
     */
    public function setOrder(int $order);

    /**
     * Get Access Role.
     */
    public function getRole(): array;

    /**
     * Set Access Role.
     *
     * @return ItemInterface
     */
    public function setRole(array $role);

    /**
     * Get Item Status.
     */
    public function isActive(): bool;

    /**
     * Set Item Status.
     *
     * @return ItemInterface
     */
    public function setActive(bool $status);

    /**
     * Get Item Group.
     */
    public function getGroup(): string;

    /**
     * Set Item Group Name.
     *
     * @return ItemInterface
     */
    public function setGroup(string $name);

    /**
     * @return bool|int
     */
    public function getCacheTime();

    /**
     * @param $time int|bool
     *
     * @return ItemInterface
     */
    public function setCacheTime($time);
}
