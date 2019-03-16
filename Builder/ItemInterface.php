<?php

/**
 * This file is part of the pd-admin pd-widget package.
 *
 * @package     pd-widget
 *
 * @license     LICENSE
 * @author      Kerem APAYDIN <kerem@apaydin.me>
 *
 * @link        https://github.com/appaydin/pd-widget
 */

namespace Pd\WidgetBundle\Builder;

use Symfony\Component\HttpFoundation\Request;

/**
 * Widget Builder Interface.
 *
 * @author Kerem APAYDIN <kerem@apaydin.me>
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
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set Item Name.
     *
     * @param string $name
     *
     * @return ItemInterface
     */
    public function setName(string $name);

    /**
     * Get Item Description.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Set Item Description.
     *
     * @param string $description
     *
     * @return ItemInterface
     */
    public function setDescription(string $description);

    /**
     * Get Item Content.
     *
     * @return string
     */
    public function getContent(): string;

    /**
     * Set Item Content.
     *
     * @param string $content
     *
     * @return ItemInterface
     */
    public function setContent(string $content);

    /**
     * Get Item Template.
     *
     * @return string
     */
    public function getTemplate(): string;

    /**
     * Set Item Template.
     *
     * @param string $template
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
     * @param callable $data
     *
     * @return ItemInterface
     */
    public function setData(callable $data);

    /**
     * @return array|null
     */
    public function getConfig();

    /**
     * @param array $config
     *
     * @return ItemInterface
     */
    public function setConfig(array $config);

    /**
     * @return array
     */
    public function getConfigProcess(Request $request);

    /**
     * @param callable $process
     *
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
     * @param int $order
     *
     * @return ItemInterface
     */
    public function setOrder(int $order);

    /**
     * Get Access Role.
     *
     * @return array
     */
    public function getRole(): array;

    /**
     * Set Access Role.
     *
     * @param array $role
     *
     * @return ItemInterface
     */
    public function setRole(array $role);

    /**
     * Get Item Status.
     *
     * @return bool
     */
    public function isActive(): bool;

    /**
     * Set Item Status.
     *
     * @param bool $status
     *
     * @return ItemInterface
     */
    public function setActive(bool $status);

    /**
     * Get Item Group.
     *
     * @return string
     */
    public function getGroup(): string;

    /**
     * Set Item Group Name.
     *
     * @param string $name
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
