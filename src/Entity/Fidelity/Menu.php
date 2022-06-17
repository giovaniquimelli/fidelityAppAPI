<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseMenu;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Menu
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Menu extends BaseMenu
{
    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255, nullable=false)
     */
    private $text;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tooltip", type="string", length=255, nullable=true)
     */
    private $tooltip;

    /**
     * @var string|null
     *
     * @ORM\Column(name="icon_class", type="string", length=255, nullable=true)
     */
    private $iconClass;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string|null
     *
     * @ORM\Column(name="route", type="string", length=255, nullable=true)
     */
    private $route;

    /**
     * @var string|null
     *
     * @ORM\Column(name="attrs", type="string", length=255, nullable=true)
     */
    private $attrs;

    /**
     * @var string|null
     *
     * @ORM\Column(name="badge_text", type="string", length=255, nullable=true)
     */
    private $badgeText;

    /**
     * @var string|null
     *
     * @ORM\Column(name="badge_class", type="string", length=255, nullable=true)
     */
    private $badgeClass;


    /**
     * @var int
     *
     * @ORM\Column(name="order", type="integer", nullable=false)
     */
    private $order = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="system_id", type="integer", nullable=false, options={"default"="1"})
     */
    private $systemId = '1';

    /**
     * @var bool
     *
     * @ORM\Column(name="master", type="boolean", nullable=false)
     */
    private $master = false;

    /**
     * @var Menu
     *
     * @ORM\ManyToOne(targetEntity="Menu")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $menu;

    /**
     * @var AuthPermission
     *
     * @ORM\ManyToOne(targetEntity="AuthPermission")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $authPermission;


    //region Getters

    /**
     * @return string
     * @Groups({"read-menu"})
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string|null
     * @Groups({"read-menu"})
     */
    public function getTooltip(): ?string
    {
        return $this->tooltip;
    }

    /**
     * @return string|null
     * @Groups({"read-menu"})
     */
    public function getIconClass(): ?string
    {
        return $this->iconClass;
    }

    /**
     * @return string|null
     * @Groups({"read-menu"})
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return string|null
     * @Groups({"read-menu"})
     */
    public function getRoute(): ?string
    {
        return $this->route;
    }

    /**
     * @return string|null
     * @Groups({"read-menu"})
     */
    public function getAttrs(): ?string
    {
        return $this->attrs;
    }

    /**
     * @return string|null
     * @Groups({"read-menu"})
     */
    public function getBadgeText(): ?string
    {
        return $this->badgeText;
    }

    /**
     * @return string|null
     * @Groups({"read-menu"})
     */
    public function getBadgeClass(): ?string
    {
        return $this->badgeClass;
    }

    /**
     * @return int
     * @Groups({"read-menu"})
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @return int
     * @Groups({"read-menu"})
     */
    public function getSystemId(): int
    {
        return $this->systemId;
    }

    /**
     * @return bool
     * @Groups({"read-menu"})
     */
    public function getMaster(): bool
    {
        return $this->master;
    }

    /**
     * @return Menu
     * @Groups({"read-menu-relations","read-menu-menu"})
     */
    public function getMenu(): Menu
    {
        return $this->menu;
    }

    /**
     * @return AuthPermission
     * @Groups({"read-menu-relations","read-menu-auth_permission"})
     */
    public function getAuthPermission(): AuthPermission
    {
        return $this->authPermission;
    }
    //endregion

    //region Setters
    /**
     * @param string $text
     * @return Menu
     * @Groups({"write-menu"})
     */
    public function setText(string $text): Menu
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param string|null $tooltip
     * @return Menu
     * @Groups({"write-menu"})
     */
    public function setTooltip(?string $tooltip): Menu
    {
        $this->tooltip = $tooltip;
        return $this;
    }

    /**
     * @param string|null $iconClass
     * @return Menu
     * @Groups({"write-menu"})
     */
    public function setIconClass(?string $iconClass): Menu
    {
        $this->iconClass = $iconClass;
        return $this;
    }

    /**
     * @param string|null $url
     * @return Menu
     * @Groups({"write-menu"})
     */
    public function setUrl(?string $url): Menu
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string|null $route
     * @return Menu
     * @Groups({"write-menu"})
     */
    public function setRoute(?string $route): Menu
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @param string|null $attrs
     * @return Menu
     * @Groups({"write-menu"})
     */
    public function setAttrs(?string $attrs): Menu
    {
        $this->attrs = $attrs;
        return $this;
    }

    /**
     * @param string|null $badgeText
     * @return Menu
     * @Groups({"write-menu"})
     */
    public function setBadgeText(?string $badgeText): Menu
    {
        $this->badgeText = $badgeText;
        return $this;
    }

    /**
     * @param string|null $badgeClass
     * @return Menu
     * @Groups({"write-menu"})
     */
    public function setBadgeClass(?string $badgeClass): Menu
    {
        $this->badgeClass = $badgeClass;
        return $this;
    }

    /**
     * @param int $order
     * @return Menu
     * @Groups({"write-menu"})
     */
    public function setOrder(int $order): Menu
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @param int $systemId
     * @return Menu
     * @Groups({"write-menu"})
     */
    public function setSystemId(int $systemId): Menu
    {
        $this->systemId = $systemId;
        return $this;
    }

    /**
     * @param bool $master
     * @return Menu
     * @Groups({"write-menu"})
     */
    public function setMaster(bool $master): Menu
    {
        $this->master = $master;
        return $this;
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function setMenu(Menu $menu): Menu
    {
        $this->menu = $menu;
        return $this;
    }

    /**
     * @param AuthPermission $authPermission
     * @return Menu
     */
    public function setAuthPermission(AuthPermission $authPermission): Menu
    {
        $this->authPermission = $authPermission;
        return $this;
    }
    //endregion
}
