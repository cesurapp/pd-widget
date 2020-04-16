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
     * @param string $name
     *
     * @return ItemInterface
     */
    public function setName(string $name): self;

    /**
     * Get Item Description.
     */
    public function getDescription(): string;

    /**
     * Set Item Description.
     *
     * @param string $description
     *
     * @return ItemInterface
     */
    public function setDescription(string $description): self;

    /**
     * Get Item Content.
     */
    public function getContent(): string;

    /**
     * Set Item Content.
     *
     * @param string $content
     *
     * @return ItemInterface
     */
    public function setContent(string $content): self;

    /**
     * Get Item Template.
     */
    public function getTemplate(): string;

    /**
     * Set Item Template.
     *
     * @param string $template
     *
     * @return ItemInterface
     */
    public function setTemplate(string $template): self;

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
    public function setData(callable $data): self;

    /**
     * @return array|null
     */
    public function getConfig(): ?array;

    /**
     * @param array $config
     *
     * @return ItemInterface
     */
    public function setConfig(array $config): self;

    /**
     * @param Request $request
     *
     * @return array
     */
    public function getConfigProcess(Request $request): ?array;

    /**
     * @param callable $process
     *
     * @return ItemInterface
     */
    public function setConfigProcess(callable $process): self;

    /**
     * Get Order Number.
     *
     * @return int|null
     */
    public function getOrder(): ?int;

    /**
     * Set Order Number.
     *
     * @param int $order
     *
     * @return ItemInterface
     */
    public function setOrder(int $order): self;

    /**
     * Get Access Role.
     */
    public function getRole(): array;

    /**
     * Set Access Role.
     *
     * @param array $role
     *
     * @return ItemInterface
     */
    public function setRole(array $role): self;

    /**
     * Get Item Status.
     */
    public function isActive(): bool;

    /**
     * Set Item Status.
     *
     * @param bool $status
     *
     * @return ItemInterface
     */
    public function setActive(bool $status): self;

    /**
     * Get Item Group.
     */
    public function getGroup(): string;

    /**
     * Set Item Group Name.
     *
     * @param string $name
     *
     * @return ItemInterface
     */
    public function setGroup(string $name): self;

    /**
     * @return bool|int
     */
    public function getCacheTime();

    /**
     * @param $time int|bool
     *
     * @return ItemInterface
     */
    public function setCacheTime($time): self;
}
