<?php

namespace App\Entity\Fidelity;


use App\Entity\Fidelity\Base\BasePersonDocument;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * PersonDocument
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class PersonDocument extends BasePersonDocument
{
    //region Columns
    /**
     * @var string
     *
     * @ORM\Column(name="file", type="text", nullable=false)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="file_type", type="string", length=255, nullable=false)
     */
    private $fileType;

    /**
     * @var string
     *
     * @ORM\Column(name="mime_type", type="string", length=255, nullable=false)
     */
    private $mimeType;


    /**
     * @var Person
     *
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $person;

    /**
     * @var PersonDocumentType
     *
     * @ORM\ManyToOne(targetEntity="PersonDocumentType")
     * @ORM\JoinColumn(onDelete="RESTRICT", nullable=false)
     */
    private $personDocumentType;
    //endregion

    //region Getters
    /**
     * @return string
     * @Groups({"read-person_document"})
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @return string
     * @Groups({"read-person_document"})
     */
    public function getFileType(): string
    {
        return $this->fileType;
    }

    /**
     * @return string
     * @Groups({"read-person_document-min","read-person_document"})
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @return Person
     * @Groups({"read-person_document-relations","read-person_document-person"})
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @return PersonDocumentType
     * @Groups({"read-person_document-relations","read-person_document-person_document_type"})
     */
    public function getPersonDocumentType(): PersonDocumentType
    {
        return $this->personDocumentType;
    }
    //endregion

    //region Setters
    /**
     * @param string $file
     * @return PersonDocument
     * @Groups({"write-person_document"})
     */
    public function setFile(string $file): PersonDocument
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @param string $fileType
     * @return PersonDocument
     * @Groups({"write-person_document"})
     */
    public function setFileType(string $fileType): PersonDocument
    {
        $this->fileType = $fileType;
        return $this;
    }

    /**
     * @param string $mimeType
     * @return PersonDocument
     * @Groups({"write-person_document"})
     */
    public function setMimeType(string $mimeType): PersonDocument
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @param Person $person
     * @return PersonDocument
     */
    public function setPerson(Person $person): PersonDocument
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param PersonDocumentType $personDocumentType
     * @return PersonDocument
     */
    public function setPersonDocumentType(PersonDocumentType $personDocumentType): PersonDocument
    {
        $this->personDocumentType = $personDocumentType;
        return $this;
    }
    //endregion
//autogenerategettersetter
}
