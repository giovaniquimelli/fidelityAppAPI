<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BaseMailingTemplate;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * MailingTemplate
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class MailingTemplate extends BaseMailingTemplate
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="text", nullable=false)
     */
    private $template;

    /**
     * @var string
     *
     * @ORM\Column(name="text_template", type="text", nullable=false)
     */
    private $textTemplate;


    //region Getters

    /**
     * @return string
     * @Groups({"read-mailing_template"})
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     * @Groups({"read-mailing_template"})
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @return string
     * @Groups({"read-mailing_template"})
     */
    public function getTextTemplate(): string
    {
        return $this->textTemplate;
    }
    //endregion

    //region Setters
    /**
     * @param string $name
     * @return MailingTemplate
     * @Groups({"write-mailing_template"})
     */
    public function setName(string $name): MailingTemplate
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $template
     * @return MailingTemplate
     * @Groups({"write-mailing_template"})
     */
    public function setTemplate(string $template): MailingTemplate
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @param string $textTemplate
     * @return MailingTemplate
     * @Groups({"write-mailing_template"})
     */
    public function setTextTemplate(string $textTemplate): MailingTemplate
    {
        $this->textTemplate = $textTemplate;
        return $this;
    }
    //endregion
}
