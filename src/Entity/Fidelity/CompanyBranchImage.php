<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseCompanyBranchImage;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * CompanyBranchImage
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CompanyBranchImage extends BaseCompanyBranchImage
{
    /**
     * @ORM\ManyToOne(targetEntity="CompanyBranch")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=true)
     */
    private ?CompanyBranch $companyBranch;

    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="text", nullable=false)
     */
    private string $cover = '';

    /**
     * @ORM\Column(name="logo", type="text", nullable=false)
     */
    private string $logo = '';

    /**
     * @ORM\Column(name="thumbnail", type="text", nullable=false)
     */
    private $thumbnail = '';

    /**
     * @return CompanyBranch|null
     * @Groups({"read-company_branch_image-relations","read-company_branch_image-company_branch"})
     */
    public function getCompanyBranch(): ?CompanyBranch
    {
        return $this->companyBranch;
    }

    /**
     * @param CompanyBranch|null $companyBranch
     * @return CompanyBranchImage
     */
    public function setCompanyBranch(?CompanyBranch $companyBranch): CompanyBranchImage
    {
        $this->companyBranch = $companyBranch;
        return $this;
    }

    /**
     * @return string
     * @Groups({"read-company_branch_image"})
     */
    public function getCover(): string
    {
        return $this->cover;
    }

    /**
     * @param string $cover
     * @return CompanyBranchImage
     */
    public function setCover(string $cover): CompanyBranchImage
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * @return string
     * @Groups({"read-company_branch_image"})
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     * @return CompanyBranchImage
     */
    public function setLogo(string $logo): CompanyBranchImage
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return string
     * @Groups({"read-company_branch_image-min","read-company_branch_image"})
     */
    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    /**
     * @param string $thumbnail
     * @return CompanyBranchImage
     */
    public function setThumbnail(string $thumbnail): CompanyBranchImage
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }


}
