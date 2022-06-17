<?php

namespace App\Entity\Fidelity;

use App\Entity\Fidelity\Base\BaseCompanyBranchTerminalAuthToken;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CompanyBranchTerminalAuthToken
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CompanyBranchTerminalAuthToken extends BaseCompanyBranchTerminalAuthToken
{
    /**
     * @var string
     *
     * @ORM\Column(name="main_role", type="string", length=255, nullable=false)
     */
    private string $mainRole;
    /**
     * @var DateTime
     *
     * @ORM\Column(name="expires_at", type="datetime", nullable=false)
     */
    private DateTime $expiresAt;
    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=false)
     * @Serializer\Groups({"default"})
     */
    private $token;
    /**
     * @var string
     *
     * @ORM\Column(name="roles_json", type="text", nullable=false)
     */
    private $rolesJson;
    /**
     * @var string
     *
     * @ORM\Column(name="payload", type="text", nullable=false)
     */
    private $payload;
    /**
     * @var string
     *
     * @ORM\Column(name="ip_address", type="string", length=255, nullable=false)
     */
    private $ipAddress;
    /**
     * @var string
     *
     * @ORM\Column(name="user_agent", type="string", length=255, nullable=false)
     */
    private $userAgent;
    /**
     * @var bool
     *
     * @ORM\Column(name="is_valid", type="boolean", nullable=false, options={"default"="1"})
     * @Assert\Type("string")
     */
    private $isValid = true;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Fidelity\CompanyBranchTerminal")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     * @Serializer\MaxDepth(1)
     */
    private CompanyBranchTerminal $companyBranchTerminal;


    public function setSysAdmin()
    {
        if ($this->id === null) {
            if ($this->getCreatedBy() === null) {
                $this->setCreatedBy(Users::ref(container_param_get('sys_web_id'))); // sys_pos_id
            }
        } else {
            $this->setUpdatedBy(Users::ref(container_param_get('sys_web_id'))); // sys_pos_id
        }
    }
}
