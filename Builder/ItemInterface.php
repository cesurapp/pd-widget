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
    public function getId();

    /**
     * Get Item Name.
     */
    public function getName(): string;

    /**
     * Set Item Name.
     */
    public function setName(string $name): self;

    /**
     * Get Item Description.
     */
    public function getDescription(): string;

    /**
     * Set Item Description.
     */
    public function setDescription(string $description): self;

    /**
     * Get Item Content.
     */
    public function getContent(): string;

    /**
     * Set Item Content.
     */
    public function setContent(string $content): self;

    /**
     * Get Item Template.
     */
    public function getTemplate(): string;

    /**
     * Set Item Template.
     */
    public function setTemplate(string $template): self;

    /**
     * Get Content Data.
     */
    public function getData();

    /**
     * Set Content Data.
     */
    public function setData(callable $data): self;

    public function getConfig(): ?array;

    public function setConfig(array $config): self;

    public function getConfigProcess(Request $request): ?array;

    public function setConfigProcess(callable $process): self;

    /**
     * Get Order Number.
     */
    public function getOrder(): ?int;

    /**
     * Set Order Number.
     */
    public function setOrder(int $order): self;

    /**
     * Get Access Role.
     */
    public function getRole(): array;

    /**
     * Set Access Role.
     */
    public function setRole(array $role): self;

    /**
     * Get Item Status.
     */
    public function isActive(): bool;

    /**
     * Set Item Status.
     */
    public function setActive(bool $status): self;

    /**
     * Get Item Group.
     */
    public function getGroup(): string;

    /**
     * Set Item Group Name.
     */
    public function setGroup(string $name): self;

    public function getCacheTime(): int|bool;

    public function setCacheTime(bool|int $time): self;
}
